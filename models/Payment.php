<?php
require_once __DIR__ . '/../config/Database.php';

class Payment {
    private $conn;
    private $table_name = "payments";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create a new payment record
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                (booking_id, amount, payment_method, transaction_reference, payment_status, payment_date, recorded_by, notes) 
                VALUES (:booking_id, :amount, :payment_method, :transaction_reference, :payment_status, NOW(), :recorded_by, :notes)";

        $stmt = $this->conn->prepare($query);

        // Assign to variables for bindParam
        $booking_id = $data['booking_id'];
        $amount = $data['amount'];
        $payment_method = $data['payment_method'];
        $transaction_reference = $data['transaction_id'];
        $payment_status = $data['status'];
        $recorded_by = $data['user_id'];
        $notes = $data['notes'] ?? null;

        // Sanitize and bind
        $stmt->bindValue(":booking_id", $booking_id);
        $stmt->bindValue(":amount", $amount);
        $stmt->bindValue(":payment_method", $payment_method);
        $stmt->bindValue(":transaction_reference", $transaction_reference); 
        $stmt->bindValue(":payment_status", $payment_status); 
        $stmt->bindValue(":recorded_by", $recorded_by);
        $stmt->bindValue(":notes", $notes);
        
        try {
            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Payment Create Error: " . implode(" ", $stmt->errorInfo()));
                return false;
            }
        } catch (PDOException $e) {
            error_log("Payment Create Exception: " . $e->getMessage());
            return false;
        }
    }

    // Get payment by booking ID
    public function readByBooking($booking_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE booking_id = :booking_id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":booking_id", $booking_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all payments for a user
    public function readByUser($user_id) {
        $query = "SELECT p.*, b.booking_date, prop.title as property_title, prop.main_image
                  FROM " . $this->table_name . " p
                  JOIN bookings b ON p.booking_id = b.id
                  JOIN properties prop ON b.property_id = prop.id
                  WHERE p.user_id = :user_id OR b.client_id = :user_id
                  ORDER BY p.created_at DESC";
        
        // Note: The payment table schema update removed user_id, so we join via booking
        $query = "SELECT p.*, b.booking_date, prop.title as property_title, prop.main_image
                  FROM " . $this->table_name . " p
                  JOIN bookings b ON p.booking_id = b.id
                  JOIN properties prop ON b.property_id = prop.id
                  WHERE b.client_id = :user_id
                  ORDER BY p.payment_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }

    // Get single payment details
    public function readOne($id) {
        $query = "SELECT p.*, b.booking_date, b.start_date, b.end_date, 
                         prop.title as property_title, prop.address, prop.city, prop.main_image,
                         u.full_name as client_name, u.email as client_email, u.phone as client_phone
                  FROM " . $this->table_name . " p
                  JOIN bookings b ON p.booking_id = b.id
                  JOIN properties prop ON b.property_id = prop.id
                  JOIN users u ON b.client_id = u.id
                  WHERE p.id = :id LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get total revenue (sum of completed payments)
    public function getTotalRevenue() {
        $query = "SELECT SUM(amount) as total FROM " . $this->table_name . " WHERE payment_status = 'completed'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    // Get revenue for a specific month
    public function getMonthlyRevenue($month, $year) {
        $query = "SELECT SUM(amount) as total FROM " . $this->table_name . " 
                  WHERE payment_status = 'completed' 
                  AND MONTH(payment_date) = :month 
                  AND YEAR(payment_date) = :year";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":month", $month);
        $stmt->bindParam(":year", $year);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    // Get total payments for a specific user
    public function getTotalPaymentsByUser($user_id) {
        $query = "SELECT SUM(amount) as total FROM " . $this->table_name . " 
                  WHERE recorded_by = :user_id AND payment_status = 'completed'";
        
        // Also check if user is the client of the booking (safer)
        $query = "SELECT SUM(p.amount) as total 
                  FROM " . $this->table_name . " p
                  JOIN bookings b ON p.booking_id = b.id
                  WHERE (b.client_id = :user_id OR p.recorded_by = :user_id) 
                  AND p.payment_status = 'completed'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    // Read all payments (Admin)
    public function readAll() {
        $query = "SELECT p.*, b.booking_date, 
                         prop.title as property_title, 
                         u.full_name as client_name, u.email as client_email
                  FROM " . $this->table_name . " p
                  JOIN bookings b ON p.booking_id = b.id
                  JOIN properties prop ON b.property_id = prop.id
                  JOIN users u ON b.client_id = u.id
                  ORDER BY p.payment_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
