<?php
require_once __DIR__ . '/../config/Database.php';

class Booking {
    private $conn;
    private $table_name = "bookings";

    public $id;
    public $property_id;
    public $client_id;
    public $booking_date;
    public $start_date;
    public $end_date;
    public $total_amount;
    public $payment_status;
    public $booking_status;
    public $notes;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create booking
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                (property_id, client_id, booking_date, start_date, end_date, total_amount, notes) 
                VALUES (:property_id, :client_id, CURDATE(), :start_date, :end_date, :total_amount, :notes)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":property_id", $this->property_id);
        $stmt->bindParam(":client_id", $this->client_id);
        $stmt->bindParam(":start_date", $this->start_date);
        $stmt->bindParam(":end_date", $this->end_date);
        $stmt->bindParam(":total_amount", $this->total_amount);
        $stmt->bindParam(":notes", $this->notes);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read client bookings
    public function readByClient($client_id) {
        $query = "SELECT b.*, p.title, p.address, p.city, p.main_image 
                  FROM " . $this->table_name . " b
                  JOIN properties p ON b.property_id = p.id
                  WHERE b.client_id = :client_id
                  ORDER BY b.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":client_id", $client_id);
        $stmt->execute();
        return $stmt;
    }
    
    // Read all bookings (Admin)    // Get all bookings
    public function readAll($filters = []) {
        $query = "SELECT b.*, p.title, p.price, p.main_image, u.full_name as client_name, u.email as client_email, u.phone as client_phone 
                  FROM " . $this->table_name . " b
                  JOIN properties p ON b.property_id = p.id
                  JOIN users u ON b.client_id = u.id
                  WHERE 1=1";

        // Apply filters
        if (!empty($filters['status'])) {
            $query .= " AND b.booking_status = :status";
        }
        if (!empty($filters['start_date'])) {
            $query .= " AND b.booking_date >= :start_date";
        }
        if (!empty($filters['end_date'])) {
            $query .= " AND b.booking_date <= :end_date";
        }
        
        $query .= " ORDER BY b.created_at DESC";

        $stmt = $this->conn->prepare($query);

        if (!empty($filters['status'])) {
            $stmt->bindParam(':status', $filters['status']);
        }
        if (!empty($filters['start_date'])) {
            $stmt->bindParam(':start_date', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $stmt->bindParam(':end_date', $filters['end_date']);
        }

        $stmt->execute();
        return $stmt;
    }

    // Update booking status
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . " 
                  SET booking_status = :status, 
                      updated_at = NOW() 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read single booking details
    public function readOne($id) {
        $query = "SELECT b.*, 
                         p.title, p.price, p.address, p.city, p.main_image,
                         u.full_name as client_name, u.email as client_email, u.phone as client_phone
                  FROM " . $this->table_name . " b
                  JOIN properties p ON b.property_id = p.id
                  JOIN users u ON b.client_id = u.id
                  WHERE b.id = :id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Confirm booking
    public function confirm($id) {
        $query = "UPDATE " . $this->table_name . " 
                  SET booking_status = 'confirmed', 
                      updated_at = NOW() 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Check if user already has an active booking for this property
    public function isBookedByUser($property_id, $client_id) {
        $query = "SELECT id FROM " . $this->table_name . " 
                  WHERE property_id = :property_id 
                  AND client_id = :client_id 
                  AND booking_status IN ('pending', 'confirmed')
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":property_id", $property_id);
        $stmt->bindParam(":client_id", $client_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }


    // Get booking details for a user and property
    public function getUserBooking($property_id, $client_id) {
        $query = "SELECT id, booking_date, start_date, end_date, booking_status FROM " . $this->table_name . " 
                  WHERE property_id = :property_id 
                  AND client_id = :client_id 
                  AND booking_status IN ('pending', 'confirmed')
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":property_id", $property_id);
        $stmt->bindParam(":client_id", $client_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete booking (Client side, only if pending/cancelled)
    public function delete($id, $client_id) {
        // First check if booking exists and belongs to client and is not confirmed
        $checkQuery = "SELECT id, booking_status FROM " . $this->table_name . " 
                       WHERE id = :id AND client_id = :client_id LIMIT 1";
        
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(":id", $id);
        $checkStmt->bindParam(":client_id", $client_id);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() > 0) {
            $row = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            // Allow deletion if status is pending or cancelled
            if ($row['booking_status'] === 'confirmed') {
                return false; // Cannot delete confirmed bookings
            }

            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND client_id = :client_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":client_id", $client_id);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }
}
?>
