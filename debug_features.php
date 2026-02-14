<?php
require_once 'config/config.php';
require_once 'models/Activity.php';
require_once 'models/Notification.php';
require_once 'models/Property.php';
require_once 'models/Booking.php';

// Mock Session
$_SESSION['user_id'] = 3; // Mike Blaze
$_SESSION['user_name'] = 'Mike Blaze';

echo "--- Testing Activity ---\n";
$activity = new Activity();
$activity->log(3, "Debug activity log", "auth");
echo "Logged activity.\n";

$recent = $activity->getRecent(3, 1);
if ($row = $recent->fetch(PDO::FETCH_ASSOC)) {
    echo "Fetched recent activity: " . $row['message'] . "\n";
} else {
    echo "Failed to fetch activity.\n";
}

echo "\n--- Testing Notifications ---\n";
$notification = new Notification();
$notification->create(3, "Debug Notification", "This is a test.", "info");
echo "Created notification.\n";

$unread = $notification->getUnread(3);
echo "Unread count: " . $unread->rowCount() . "\n";
if ($row = $unread->fetch(PDO::FETCH_ASSOC)) {
    echo "First unread: " . $row['title'] . "\n";
}

echo "\n--- Testing Report Data Fetching ---\n";
$property = new Property();
$count = $property->read()->rowCount();
echo "Properties count for report: $count\n";

$booking = new Booking();
$bCount = $booking->readAll()->rowCount();
echo "Bookings count for report: $bCount\n";

?>
