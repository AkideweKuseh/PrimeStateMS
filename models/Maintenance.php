<?php
require_once __DIR__ . '/../config/Database.php';

class Maintenance {
    private $conn;
    private $table_name = "maintenance";

    public $id;
    public $tenant_id;
    public $property_id;
    public $issue_description;
    public $request_date;
    public $status;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create a new maintenance request
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                (tenant_id, property_id, issue_description, request_date, status) 
                VALUES (:tenant_id, :property_id, :issue_description, :request_date, :status)";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $tenant_id = htmlspecialchars(strip_tags($data['tenant_id']));
        $property_id = htmlspecialchars(strip_tags($data['property_id']));
        $issue_description = htmlspecialchars(strip_tags($data['issue_description']));
        $request_date = htmlspecialchars(strip_tags($data['request_date']));
        $status = htmlspecialchars(strip_tags($data['status'] ?? 'pending'));

        // Bind
        $stmt->bindParam(":tenant_id", $tenant_id);
        $stmt->bindParam(":property_id", $property_id);
        $stmt->bindParam(":issue_description", $issue_description);
        $stmt->bindParam(":request_date", $request_date);
        $stmt->bindParam(":status", $status);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Get all maintenance requests with tenant and property details
    public function readAll() {
        $query = "SELECT m.*, u.full_name as tenant_name, p.title as property_title 
                  FROM " . $this->table_name . " m
                  JOIN tenants t ON m.tenant_id = t.id
                  JOIN users u ON t.user_id = u.id
                  JOIN properties p ON m.property_id = p.id
                  ORDER BY m.request_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get requests by Tenant ID
    public function readByTenantId($tenant_id) {
        $query = "SELECT m.*, p.title as property_title 
                  FROM " . $this->table_name . " m
                  JOIN properties p ON m.property_id = p.id
                  WHERE m.tenant_id = :tenant_id
                  ORDER BY m.request_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tenant_id", $tenant_id);
        $stmt->execute();
        return $stmt;
    }

    // Update request status
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $status = htmlspecialchars(strip_tags($status));
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Count requests by status
    public function countByStatus($status) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE status = :status";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
}
?>
