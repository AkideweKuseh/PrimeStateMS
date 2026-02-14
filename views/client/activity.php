<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Activity.php';
require_once __DIR__ . '/../../core/Helper.php';

$activityModel = new Activity();
$activities = $activityModel->getAll($_SESSION['user_id']); // This returns a PDOStatement
?>

<!-- Headers -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Activity Log</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">View your recent interactions and system events.</p>
    </div>
</div>

<!-- Activity List -->
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700">
    <div class="p-6">
        <div class="space-y-8">
            <?php 
            if ($activities->rowCount() > 0):
                $currentDate = '';
                while ($activity = $activities->fetch(PDO::FETCH_ASSOC)):
                    $date = date('F d, Y', strtotime($activity['created_at']));
                    
                    // Group by Date
                    if ($date != $currentDate):
                        $currentDate = $date;
            ?>
            <div class="relative">
                <div class="sticky top-0 z-10 bg-white dark:bg-slate-800 py-2">
                    <span class="px-3 py-1 text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-700 rounded-full">
                        <?php echo $date; ?>
                    </span>
                </div>
            </div>
            <?php endif; 
            
            $icon = 'info';
            $bgColor = 'bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400';
            
            if ($activity['type'] == 'booking') {
                $icon = 'schedule';
                $bgColor = 'bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400';
            } elseif ($activity['type'] == 'payment') {
                $icon = 'payments';
                $bgColor = 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400';
            } elseif ($activity['type'] == 'auth') {
                $icon = 'lock';
                $bgColor = 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400';
            }
            ?>
            
            <div class="flex gap-4 group">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full <?php echo $bgColor; ?> flex items-center justify-center shrink-0 shadow-sm group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-lg"><?php echo $icon; ?></span>
                    </div>
                    <!-- Line connector (hide for last item in group ideally, but strictly requires lookahead) -->
                    <div class="w-px h-full bg-slate-100 dark:bg-slate-700 my-2 group-last:hidden"></div>
                </div>
                <div class="pb-8 flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo ucfirst($activity['type']); ?> Activity</p>
                        <span class="text-xs text-slate-400 flex items-center">
                            <span class="material-symbols-outlined text-[14px] mr-1">schedule</span>
                            <?php echo date('h:i A', strtotime($activity['created_at'])); ?>
                        </span>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mt-1 bg-slate-50 dark:bg-slate-700/50 p-3 rounded-lg border border-slate-100 dark:border-slate-700/50">
                        <?php echo $activity['message']; ?>
                    </p>
                </div>
            </div>
            <?php 
                endwhile;
            else:
            ?>
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl text-slate-400">history</span>
                </div>
                <h3 class="text-lg font-medium text-slate-900 dark:text-white">No Activity Yet</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-1">Your recent interactions will appear here.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</div> 
</div>
</body>
</html>
