<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Maintenance.php';
require_once __DIR__ . '/../../core/Helper.php';

$maintenanceModel = new Maintenance();
$requests = $maintenanceModel->readAll();
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">MAINTENANCE TICKETS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Configure facility schedules, repair work orders, and resolution timelines.</p>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist maintenance table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Asset / Resident</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Issue Description</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Configure Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php while($req = $requests->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $req['property_title']; ?></div>
                            <div class="text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mt-1"><?php echo $req['tenant_name']; ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs text-slate-650 dark:text-slate-350 max-w-xs truncate uppercase tracking-wide font-bold" title="<?php echo $req['issue_description']; ?>">
                                <?php echo $req['issue_description']; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                            <?php echo date('d M Y', strtotime($req['request_date'])); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo match($req['status']) {
                                    'pending' => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20',
                                    'in_progress' => 'bg-blue-500/10 text-blue-700 border-blue-200 dark:text-blue-400 dark:border-blue-800/30',
                                    'completed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                    default => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-800 dark:text-slate-350 dark:border-white/10'
                                };
                            ?>">
                                <?php echo str_replace('_', ' ', $req['status']); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <form action="<?php echo BASE_URL; ?>controllers/MaintenanceController.php?action=updateStatus" method="POST" class="inline-flex items-center gap-2">
                                <input type="hidden" name="id" value="<?php echo $req['id']; ?>">
                                <select name="status" 
                                        onchange="this.form.submit()" 
                                        class="rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-[9px] font-display font-bold tracking-widest px-2.5 py-1.5 uppercase transition-colors">
                                    <option value="pending" <?php echo $req['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="in_progress" <?php echo $req['status'] == 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                                    <option value="completed" <?php echo $req['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($requests->rowCount() == 0): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">build</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No requests submitted.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
