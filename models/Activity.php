<?php
require_once __DIR__ . '/../config/Database.php';

class Activity {
    private $conn;
    private $table_name = "activities";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Log an activity
    public function log($user_id, $message, $type = 'info') {
        $query = "INSERT INTO " . $this->table_name . " (user_id, message, type) VALUES (:user_id, :message, :type)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":type", $type);

        return $stmt->execute();
    }

    // Get recent activities for a user
    public function getRecent($user_id, $limit = 5) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    
    // Get all activities for a user (Paginated)
    public function getAll($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }
}
?>
