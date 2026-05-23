<?php 
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../core/Helper.php';

// Safe Redirect if accessed directly without Controller data
if (!isset($payments)) {
    header("Location: " . BASE_URL . "controllers/PaymentController.php?action=index");
    exit;
}

require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">FINANCIAL LEDGER</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Track system cashflow, client collections, and verified payments.</p>
    </div>
    <div class="flex gap-2">
        <button onclick="window.print()" 
                class="px-5 py-2.5 bg-charcoal dark:bg-white text-white dark:text-black hover:bg-black dark:hover:bg-slate-100 border border-slate-950 dark:border-white font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">print</span>
            Print Report
        </button>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist payments table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Transaction Info</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Client</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Amount</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Method</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php 
                    if($payments->rowCount() > 0):
                        while($payment = $payments->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="block text-xs font-mono font-bold text-slate-900 dark:text-white uppercase">
                                <?php echo $payment['transaction_reference']; ?>
                            </span>
                            <span class="text-[9px] text-slate-400 font-mono">ID: #<?php echo $payment['id']; ?></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $payment['client_name']; ?></span>
                                <span class="text-[9px] font-mono text-slate-450 dark:text-slate-550 lowercase tracking-normal mt-0.5"><?php echo $payment['client_email']; ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="block text-xs text-slate-650 dark:text-slate-350 truncate max-w-[150px] uppercase font-bold" title="<?php echo $payment['property_title']; ?>">
                                <?php echo $payment['property_title']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-900 dark:text-white font-mono">
                            <?php echo Helper::formatCurrency($payment['amount']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-650 dark:text-slate-350 uppercase tracking-wider font-mono">
                            <?php echo $payment['payment_method']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo match($payment['payment_status']) {
                                    'completed', 'verified' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                    'failed' => 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30',
                                    default => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20'
                                };
                            ?>">
                                <?php echo $payment['payment_status']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs text-slate-500 dark:text-slate-400 font-mono">
                            <?php echo Helper::formatDate($payment['payment_date']); ?>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">payments</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No payment transactions recorded.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
