<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Rent.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../core/Helper.php';

$rentModel = new Rent();
$rent_records = $rentModel->readAll();
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">RENT COLLECTION</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Monitor billing ledgers, outstanding balances, and record incoming resident payments.</p>
    </div>
    <a href="record-rent.php" 
       class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
        <span class="material-symbols-outlined text-sm font-bold">add</span>
        Record Payment
    </a>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist rent table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Tenant / Asset</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Amount Due</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Balance</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php while($r = $rent_records->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $r['tenant_name']; ?></div>
                            <div class="text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mt-1"><?php echo $r['property_title']; ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-900 dark:text-white font-bold font-mono">
                            <?php echo Helper::formatCurrency($r['amount']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-mono font-bold <?php echo $r['balance'] > 0 ? 'text-red-650 dark:text-red-400' : 'text-slate-500'; ?>">
                            <?php echo Helper::formatCurrency($r['balance']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo match($r['status']) {
                                    'paid' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                    'overdue' => 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30',
                                    default => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20'
                                };
                            ?>">
                                <?php echo $r['status']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <a href="edit-rent.php?id=<?php echo $r['id']; ?>" 
                               class="px-3.5 py-1.5 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300 font-display text-[9px] font-bold tracking-widest uppercase">
                                Edit
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($rent_records->rowCount() == 0): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">receipt_long</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No rent statements created.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
