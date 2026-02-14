<?php 
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../models/Notification.php';

$notificationModel = new Notification();

// Handle Form Submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mark_all_read'])) {
        $notificationModel->markAllAsRead($_SESSION['user_id']);
        Helper::setFlash('success', 'All notifications marked as read.');
        Helper::redirect('views/client/notifications.php');
    }
    
    if (isset($_POST['mark_read_id'])) {
        $notificationModel->markAsRead($_POST['mark_read_id']);
        Helper::setFlash('success', 'Notification marked as read.');
        Helper::redirect('views/client/notifications.php');
    }
}

require_once __DIR__ . '/../layouts/client-sidebar.php'; 

$notifications = $notificationModel->getUnread($_SESSION['user_id']);
?>

<!-- Headers -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Notifications</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Stay updated with your latest alerts.</p>
    </div>
    
    <?php if ($notifications->rowCount() > 0): ?>
    <form method="POST">
        <button type="submit" name="mark_all_read" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition">
            <span class="material-symbols-outlined text-base">done_all</span>
            Mark all as read
        </button>
    </form>
    <?php endif; ?>
</div>

<!-- Notification List -->
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
    <div class="p-6 space-y-4">
        <?php 
        if ($notifications->rowCount() > 0):
            while ($notification = $notifications->fetch(PDO::FETCH_ASSOC)):
                $icon = 'notifications';
                $bgClass = 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400';
                
                if ($notification['type'] == 'success') { $icon = 'check_circle'; $bgClass = 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400'; }
                if ($notification['type'] == 'warning') { $icon = 'warning'; $bgClass = 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-400'; }
                if ($notification['type'] == 'error') { $icon = 'error'; $bgClass = 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400'; }
        ?>
        <div class="flex gap-4 p-4 rounded-lg bg-slate-50 dark:bg-slate-700/30 border border-slate-100 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors group">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full <?php echo $bgClass; ?> flex items-center justify-center">
                    <span class="material-symbols-outlined"><?php echo $icon; ?></span>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo $notification['title']; ?></h3>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-400 whitespace-nowrap"><?php echo Helper::timeAgo($notification['created_at']); ?></span>
                        <form method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <input type="hidden" name="mark_read_id" value="<?php echo $notification['id']; ?>">
                            <button type="submit" class="text-xs text-slate-400 hover:text-primary transition-colors" title="Mark as read">
                                <span class="material-symbols-outlined text-lg">check</span>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-1"><?php echo $notification['message']; ?></p>
                <?php if ($notification['link']): ?>
                <a href="<?php echo BASE_URL . $notification['link']; ?>" class="inline-flex items-center mt-2 text-xs font-medium text-primary hover:text-primary-light transition-colors">
                    View Details <span class="material-symbols-outlined text-[16px] ml-1">arrow_forward</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl text-slate-400">notifications_off</span>
            </div>
            <h3 class="text-lg font-medium text-slate-900 dark:text-white">No New Notifications</h3>
            <p class="text-slate-500 dark:text-slate-400 mt-1">You're all caught up!</p>
        </div>
        <?php endif; ?>
    </div>
</div>

</div> 
</div>
</body>
</html>
