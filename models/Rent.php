<?php
require_once __DIR__ . '/../config/Database.php';

class Rent {
    private $conn;
    private $table_name = "rent";

    public $id;
    public $tenant_id;
    public $property_id;
    public $amount;
    public $payment_date;
    public $balance;
    public $status;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create a new rent record
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                (tenant_id, property_id, amount, balance, status) 
                VALUES (:tenant_id, :property_id, :amount, :balance, :status)";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $tenant_id = htmlspecialchars(strip_tags($data['tenant_id']));
        $property_id = htmlspecialchars(strip_tags($data['property_id']));
        $amount = htmlspecialchars(strip_tags($data['amount']));
        $balance = htmlspecialchars(strip_tags($data['balance']));
        $status = htmlspecialchars(strip_tags($data['status'] ?? 'pending'));

        // Bind
        $stmt->bindParam(":tenant_id", $tenant_id);
        $stmt->bindParam(":property_id", $property_id);
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":balance", $balance);
        $stmt->bindParam(":status", $status);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Get all rent records with tenant and property details
    public function readAll() {
        $query = "SELECT r.*, u.full_name as tenant_name, p.title as property_title 
                  FROM " . $this->table_name . " r
                  JOIN tenants t ON r.tenant_id = t.id
                  JOIN users u ON t.user_id = u.id
                  JOIN properties p ON r.property_id = p.id
                  ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get rent record by ID
    public function readOne($id) {
        $query = "SELECT r.*, u.full_name as tenant_name, p.title as property_title 
                  FROM " . $this->table_name . " r
                  JOIN tenants t ON r.tenant_id = t.id
                  JOIN users u ON t.user_id = u.id
                  JOIN properties p ON r.property_id = p.id
                  WHERE r.id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get rent records by Tenant ID
    public function readByTenantId($tenant_id) {
        $query = "SELECT r.*, p.title as property_title 
                  FROM " . $this->table_name . " r
                  JOIN properties p ON r.property_id = p.id
                  WHERE r.tenant_id = :tenant_id
                  ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tenant_id", $tenant_id);
        $stmt->execute();
        return $stmt;
    }

    // Update rent payment
    public function updatePayment($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET payment_date = :payment_date, 
                      balance = :balance, 
                      status = :status 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $payment_date = htmlspecialchars(strip_tags($data['payment_date']));
        $balance = htmlspecialchars(strip_tags($data['balance']));
        $status = htmlspecialchars(strip_tags($data['status']));

        $stmt->bindParam(":payment_date", $payment_date);
        $stmt->bindParam(":balance", $balance);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get total revenue from rent
    public function getTotalRevenue() {
        $query = "SELECT SUM(amount - balance) as total FROM " . $this->table_name . " WHERE status = 'paid'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
?>
