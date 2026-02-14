<?php 
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../models/Notification.php';

$notificationModel = new Notification();

// Handle Form Submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mark_all_read'])) {
        $notificationModel->markAllAsRead($_SESSION['user_id']);
         // Refresh to see changes
        header("Location: " . BASE_URL . "views/admin/notifications.php");
        exit;
    }
    
    if (isset($_POST['mark_read_id'])) {
        $notificationModel->markAsRead($_POST['mark_read_id']);
        // Refresh to see changes
        header("Location: " . BASE_URL . "views/admin/notifications.php");
        exit;
    }
}

require_once __DIR__ . '/../layouts/admin-sidebar.php'; 

$notifications = $notificationModel->getUnread($_SESSION['user_id']);
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Notifications</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Stay updated with the latest events.</p>
    </div>
    
    <?php if ($notifications->rowCount() > 0): ?>
    <div class="flex gap-2">
        <form method="POST" action="">
            <button type="submit" name="mark_all_read" class="px-4 py-2 bg-white dark:bg-[#1a1625] border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 transition flex items-center gap-2">
                <span class="material-symbols-outlined text-base">done_all</span>
                Mark all as read
            </button>
        </form>
    </div>
    <?php endif; ?>
</div>

<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
    <div class="p-6 space-y-4">
        <?php 
        if ($notifications->rowCount() > 0):
            while ($notification = $notifications->fetch(PDO::FETCH_ASSOC)):
                $icon = 'info';
                $bgClass = 'bg-blue-100 text-blue-600';
                if ($notification['type'] == 'success') { $icon = 'check_circle'; $bgClass = 'bg-green-100 text-green-600'; }
                if ($notification['type'] == 'warning') { $icon = 'warning'; $bgClass = 'bg-yellow-100 text-yellow-600'; }
                if ($notification['type'] == 'error') { $icon = 'error'; $bgClass = 'bg-red-100 text-red-600'; }
        ?>
        <div class="flex gap-4 p-4 rounded-lg bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 group relative">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full <?php echo $bgClass; ?> dark:bg-opacity-20 flex items-center justify-center">
                    <span class="material-symbols-outlined"><?php echo $icon; ?></span>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo $notification['title']; ?></h3>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-400"><?php echo Helper::timeAgo($notification['created_at']); ?></span>
                        <!-- Mark as Read Button (Visible on Hover) -->
                        <form method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <input type="hidden" name="mark_read_id" value="<?php echo $notification['id']; ?>">
                            <button type="submit" class="text-xs text-slate-400 hover:text-primary transition-colors p-1" title="Mark as read">
                                <span class="material-symbols-outlined text-lg">check</span>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-1"><?php echo $notification['message']; ?></p>
                <?php if ($notification['link']): ?>
                <a href="<?php echo BASE_URL . $notification['link']; ?>" class="inline-block mt-2 text-xs font-medium text-primary hover:underline">View Details</a>
                <?php endif; ?>
            </div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div class="text-center py-12 text-slate-500 dark:text-slate-400">
            <span class="material-symbols-outlined text-4xl mb-3 opacity-50">notifications_off</span>
            <p>No new notifications.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

</div> 
</div>
</body>
</html>
