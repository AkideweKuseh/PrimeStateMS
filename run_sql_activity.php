<?php
require_once 'config/config.php';
require_once 'config/Database.php';

$database = new Database();
$db = $database->getConnection();

$sql = file_get_contents('sql/create_activity_notification_tables.sql');

try {
    $db->exec($sql);
    echo "Tables 'activities' and 'notifications' created successfully.\n";
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage() . "\n";
}
?>
