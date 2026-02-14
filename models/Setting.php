<?php
require_once __DIR__ . '/../config/Database.php';

class Setting {
    private $conn;
    private $table_name = "settings";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get all settings as an associative array
    public function getAllAsArray() {
        $query = "SELECT setting_key, setting_value FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $settings = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    // Update a specific setting
    public function update($key, $value) {
        $query = "INSERT INTO " . $this->table_name . " (setting_key, setting_value) VALUES (:key, :value) 
                  ON DUPLICATE KEY UPDATE setting_value = :value";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':key', $key);
        $stmt->bindParam(':value', $value);
        return $stmt->execute();
    }
    
    // Get single setting
    public function get($key, $default = null) {
        $query = "SELECT setting_value FROM " . $this->table_name . " WHERE setting_key = :key LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':key', $key);
        $stmt->execute();
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $row['setting_value'];
        }
        return $default;
    }
}
?>
