<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Payment.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

$paymentModel = new Payment();
$payments = $paymentModel->readByUser(Auth::id());
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">TRANSACTION ARCHIVE</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Review past transaction ledgers, receipts, and payment settlements.</p>
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
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Transaction Ref</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property Asset</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Clear Date</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Method</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Amount Paid</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Receipt</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php 
                    if($payments->rowCount() > 0):
                        while($row = $payments->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-mono font-bold text-slate-900 dark:text-white uppercase">
                            <?php echo $row['transaction_reference'] ?? 'N/A'; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 border border-slate-200 dark:border-white/10 overflow-hidden bg-slate-900">
                                    <img class="h-full w-full object-cover" 
                                         src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $row['main_image'] ?? 'default.jpg'; ?>" 
                                         alt=""
                                         onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=60&q=80'">
                                </div>
                                <div class="ml-3">
                                    <span class="block text-xs font-bold text-slate-900 dark:text-white uppercase truncate max-w-[150px]" title="<?php echo $row['property_title']; ?>">
                                        <?php echo $row['property_title']; ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                            <?php echo Helper::formatDate($row['payment_date']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-mono uppercase">
                            <?php echo $row['payment_method']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-900 dark:text-white font-mono">
                            <?php echo Helper::formatCurrency($row['amount']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo match($row['payment_status']) {
                                    'completed', 'verified' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                    'failed' => 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30',
                                    default => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20'
                                };
                            ?>">
                                <?php echo $row['payment_status']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <a href="<?php echo BASE_URL; ?>views/client/payment-receipt.php?id=<?php echo $row['id']; ?>" 
                               class="inline-flex items-center gap-1 text-[9px] font-display font-bold tracking-widest uppercase text-primary hover:text-[#d9c441] transition-colors">
                                <span class="material-symbols-outlined text-sm leading-none font-bold">receipt_long</span>
                                Invoice
                            </a>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">payments</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No payment transaction history recorded.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
