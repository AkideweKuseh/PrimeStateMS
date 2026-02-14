<?php
require_once __DIR__ . '/../config/Database.php';

class SavedProperty {
    private $conn;
    private $table_name = "saved_properties";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Save a property
    public function create($user_id, $property_id) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, property_id) VALUES (:user_id, :property_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":property_id", $property_id);
        
        try {
            return $stmt->execute();
        } catch(PDOException $e) {
            // Likely duplicate entry, which is fine
            return false;
        }
    }

    // Unsave a property
    public function delete($user_id, $property_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :user_id AND property_id = :property_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":property_id", $property_id);
        return $stmt->execute();
    }

    // Check if property is saved by user
    public function isSaved($user_id, $property_id) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE user_id = :user_id AND property_id = :property_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":property_id", $property_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Get array of saved property IDs for a user (for efficient checking)
    public function getSavedPropertyIds($user_id) {
        $query = "SELECT property_id FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Get all saved properties for a user
    public function readByUser($user_id) {
        $query = "SELECT p.*, sp.created_at as saved_at 
                  FROM properties p
                  JOIN " . $this->table_name . " sp ON p.id = sp.property_id
                  WHERE sp.user_id = :user_id
                  ORDER BY sp.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }
}
?>
