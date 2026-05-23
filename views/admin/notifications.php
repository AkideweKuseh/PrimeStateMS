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

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">NOTIFICATIONS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Review operational updates, alert logs, and system events.</p>
    </div>
    
    <?php if ($notifications->rowCount() > 0): ?>
    <div class="flex gap-2">
        <form method="POST" action="">
            <button type="submit" 
                    name="mark_all_read" 
                    class="px-5 py-2.5 bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white text-slate-700 dark:text-slate-300 font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">done_all</span>
                Mark all as read
            </button>
        </form>
    </div>
    <?php endif; ?>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist notifications cards list -->
    <div class="space-y-4 relative z-10">
        <?php 
        if ($notifications->rowCount() > 0):
            while ($notification = $notifications->fetch(PDO::FETCH_ASSOC)):
                $icon = 'info';
                $borderClass = 'border-l-[4px] border-l-blue-500';
                $iconColor = 'text-blue-500';
                if ($notification['type'] == 'success') { $icon = 'check_circle'; $borderClass = 'border-l-[4px] border-l-green-500'; $iconColor = 'text-green-500'; }
                if ($notification['type'] == 'warning') { $icon = 'warning'; $borderClass = 'border-l-[4px] border-l-primary'; $iconColor = 'text-primary'; }
                if ($notification['type'] == 'error') { $icon = 'error'; $borderClass = 'border-l-[4px] border-l-red-500'; $iconColor = 'text-red-500'; }
        ?>
        <div class="flex gap-4 p-5 bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none hover:border-slate-950 dark:hover:border-white transition duration-300 group relative <?php echo $borderClass; ?>">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 border border-slate-200 dark:border-white/10 flex items-center justify-center rounded-none bg-slate-50 dark:bg-slate-900/50">
                    <span class="material-symbols-outlined <?php echo $iconColor; ?>"><?php echo $icon; ?></span>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start flex-wrap gap-2">
                    <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $notification['title']; ?></h3>
                    <div class="flex items-center gap-3">
                        <span class="text-[9px] font-mono text-slate-400"><?php echo Helper::timeAgo($notification['created_at']); ?></span>
                        
                        <!-- Mark as Read Button -->
                        <form method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <input type="hidden" name="mark_read_id" value="<?php echo $notification['id']; ?>">
                            <button type="submit" 
                                    class="text-xs text-slate-400 hover:text-primary transition-colors p-1 flex items-center justify-center border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white rounded-none" 
                                    title="Mark as read">
                                <span class="material-symbols-outlined text-sm leading-none">check</span>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-xs text-slate-650 dark:text-slate-350 mt-1 uppercase tracking-wide"><?php echo $notification['message']; ?></p>
                <?php if ($notification['link']): ?>
                <a href="<?php echo BASE_URL . $notification['link']; ?>" 
                   class="inline-flex items-center mt-3 text-[9px] font-display font-bold tracking-widest uppercase text-primary hover:text-[#d9c441] transition-colors gap-1.5">
                    View Details
                    <span class="material-symbols-outlined text-[10px]">arrow_forward</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-16 text-center">
            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">notifications_off</span>
            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No new notifications in log.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
