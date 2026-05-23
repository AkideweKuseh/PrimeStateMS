<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Activity.php';
require_once __DIR__ . '/../../core/Helper.php';

$activityModel = new Activity();
$activities = $activityModel->getAll($_SESSION['user_id']); // This returns a PDOStatement
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">ACTIVITY LOG</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Review operational updates, viewing bookings, and payment records.</p>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist activity card list -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-8 relative z-10">
        <div class="space-y-8">
            <?php 
            if ($activities->rowCount() > 0):
                $currentDate = '';
                while ($activity = $activities->fetch(PDO::FETCH_ASSOC)):
                    $date = date('d M Y', strtotime($activity['created_at']));
                    
                    // Group by Date
                    if ($date != $currentDate):
                        $currentDate = $date;
            ?>
            <div class="relative z-15">
                <div class="sticky top-0 bg-white dark:bg-[#151517] py-2">
                    <span class="inline-block px-3 py-1.5 border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-800 dark:text-slate-200 font-display text-[9px] font-bold tracking-widest uppercase rounded-none">
                        <?php echo $date; ?>
                    </span>
                </div>
            </div>
            <?php endif; 
            
            $icon = 'info';
            $iconColor = 'text-blue-500';
            
            if ($activity['type'] == 'booking') {
                $icon = 'schedule';
                $iconColor = 'text-orange-500';
            } elseif ($activity['type'] == 'payment') {
                $icon = 'payments';
                $iconColor = 'text-green-500';
            } elseif ($activity['type'] == 'auth') {
                $icon = 'lock';
                $iconColor = 'text-slate-405';
            }
            ?>
            
            <div class="flex gap-4 group">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center shrink-0 rounded-none transition-transform group-hover:scale-105 duration-300">
                        <span class="material-symbols-outlined text-lg <?php echo $iconColor; ?>"><?php echo $icon; ?></span>
                    </div>
                    <!-- Line connector -->
                    <div class="w-px h-full bg-slate-200 dark:bg-white/5 my-2 group-last:hidden"></div>
                </div>
                <div class="pb-8 flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <p class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider"><?php echo $activity['type']; ?> Activity</p>
                        <span class="text-[9px] text-slate-400 font-mono flex items-center uppercase tracking-wider">
                            <span class="material-symbols-outlined text-[11px] mr-1">schedule</span>
                            <?php echo date('h:i A', strtotime($activity['created_at'])); ?>
                        </span>
                    </div>
                    <p class="text-xs text-slate-650 dark:text-slate-350 uppercase tracking-wide leading-relaxed bg-slate-50 dark:bg-slate-900/30 border border-slate-200 dark:border-white/5 p-4 mt-3 rounded-none">
                        <?php echo htmlspecialchars($activity['message']); ?>
                    </p>
                </div>
            </div>
            <?php 
                endwhile;
            else:
            ?>
            <div class="text-center py-16">
                <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3 animate-pulse">history</span>
                <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No activity logs recorded.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
