<?php
require_once __DIR__ . '/../config/Database.php';

class Payment {
    private $conn;
    private $table_name = "payments";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Record payment
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                (booking_id, amount, payment_method, transaction_reference, payment_status, payment_date, recorded_by) 
                VALUES (:booking_id, :amount, :payment_method, :transaction_reference, :payment_status, CURDATE(), :recorded_by)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":booking_id", $data['booking_id']);
        $stmt->bindParam(":amount", $data['amount']);
        $stmt->bindParam(":payment_method", $data['payment_method']);
        $stmt->bindParam(":transaction_reference", $data['transaction_reference']);
        $stmt->bindParam(":payment_status", $data['payment_status']);
        $stmt->bindParam(":recorded_by", $data['recorded_by']);

        if ($stmt->execute()) {
            // Update booking status
            $this->updateBookingStatus($data['booking_id'], 'completed');
            return true;
        }
        return false;
    }
    
    private function updateBookingStatus($booking_id, $status) {
         $query = "UPDATE bookings SET payment_status = :status WHERE id = :id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindParam(":status", $status);
         $stmt->bindParam(":id", $booking_id);
         $stmt->execute();
    }
}
?>
