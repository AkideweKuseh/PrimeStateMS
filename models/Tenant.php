<?php
require_once __DIR__ . '/../config/Database.php';

class Tenant {
    private $conn;
    private $table_name = "tenants";

    public $id;
    public $user_id;
    public $property_id;
    public $contact_info;
    public $lease_start;
    public $lease_end;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Create a new tenant record
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                (user_id, property_id, contact_info, lease_start, lease_end) 
                VALUES (:user_id, :property_id, :contact_info, :lease_start, :lease_end)";

        $stmt = $this->conn->prepare($query);

        // Sanitize
        $user_id = htmlspecialchars(strip_tags($data['user_id']));
        $property_id = htmlspecialchars(strip_tags($data['property_id']));
        $contact_info = htmlspecialchars(strip_tags($data['contact_info']));
        $lease_start = htmlspecialchars(strip_tags($data['lease_start']));
        $lease_end = htmlspecialchars(strip_tags($data['lease_end']));

        // Bind
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":property_id", $property_id);
        $stmt->bindParam(":contact_info", $contact_info);
        $stmt->bindParam(":lease_start", $lease_start);
        $stmt->bindParam(":lease_end", $lease_end);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Get all tenants with user and property details
    public function readAll() {
        $query = "SELECT t.*, u.full_name as user_name, u.email as user_email, p.title as property_title 
                  FROM " . $this->table_name . " t
                  JOIN users u ON t.user_id = u.id
                  JOIN properties p ON t.property_id = p.id
                  ORDER BY t.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get tenant by ID
    public function readOne($id) {
        $query = "SELECT t.*, u.full_name as user_name, u.email as user_email, p.title as property_title 
                  FROM " . $this->table_name . " t
                  JOIN users u ON t.user_id = u.id
                  JOIN properties p ON t.property_id = p.id
                  WHERE t.id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get tenant by User ID
    public function readByUserId($user_id) {
        $query = "SELECT t.*, p.title as property_title, p.address as property_address 
                  FROM " . $this->table_name . " t
                  JOIN properties p ON t.property_id = p.id
                  WHERE t.user_id = :user_id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update tenant record
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET contact_info = :contact_info, 
                      lease_start = :lease_start, 
                      lease_end = :lease_end 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $contact_info = htmlspecialchars(strip_tags($data['contact_info']));
        $lease_start = htmlspecialchars(strip_tags($data['lease_start']));
        $lease_end = htmlspecialchars(strip_tags($data['lease_end']));

        $stmt->bindParam(":contact_info", $contact_info);
        $stmt->bindParam(":lease_start", $lease_start);
        $stmt->bindParam(":lease_end", $lease_end);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete tenant record
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
