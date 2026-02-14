<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/Database.php';

$database = new Database();
$db = $database->getConnection();

try {
    // Create settings table
    $sql = "CREATE TABLE IF NOT EXISTS settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(255) NOT NULL UNIQUE,
        setting_value TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $db->exec($sql);
    echo "Settings table created successfully.\n";

    // Default Settings
    $defaults = [
        'site_name' => 'Prime Estate',
        'site_email' => 'contact@primeestate.com',
        'currency_code' => 'GHS',
        'currency_symbol' => '₵',
        'site_logo' => 'default_logo.png' // We'll handle file uploads later
    ];

    $stmt = $db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value) ON DUPLICATE KEY UPDATE setting_key = setting_key");
    
    foreach ($defaults as $key => $value) {
        $stmt->bindParam(':key', $key);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
    }
    echo "Default settings inserted.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
