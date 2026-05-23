<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Payment.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

if (!isset($_GET['id'])) {
    Helper::redirect('views/client/payments.php');
}

$paymentModel = new Payment();
$payment = $paymentModel->readOne($_GET['id']);

// Basic Access Control
if (!$payment || $payment['id'] == null) {
    Helper::flash('error', 'Receipt not found.');
    Helper::redirect('views/client/payments.php');
}
?>

<!-- Minimalist Back Link -->
<div class="mb-6 relative z-10">
    <a href="<?php echo BASE_URL; ?>views/client/payments.php" 
       class="inline-flex items-center gap-2 font-display text-[10px] font-bold tracking-widest uppercase text-slate-500 hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Back to Payments
    </a>
</div>

<div class="max-w-2xl mx-auto bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10 overflow-hidden shadow-2xl">
    <!-- Receipt Header -->
    <div class="bg-slate-50 dark:bg-slate-800/30 p-8 text-center border-b border-slate-200 dark:border-white/5">
        <div class="w-12 h-12 border border-green-500/20 bg-green-500/10 text-green-600 dark:text-green-400 flex items-center justify-center mx-auto mb-4 rounded-none">
            <span class="material-symbols-outlined text-xl font-bold">check</span>
        </div>
        <h1 class="font-display font-black text-xl text-slate-900 dark:text-white uppercase tracking-tight mb-1">Payment Successful</h1>
        <p class="text-[9px] font-bold tracking-wider text-slate-400 uppercase">Transaction ID: <span class="font-mono text-slate-900 dark:text-white"><?php echo $payment['transaction_reference']; ?></span></p>
        <h2 class="font-mono font-bold text-3xl text-slate-900 dark:text-white mt-4"><?php echo Helper::formatCurrency($payment['amount']); ?></h2>
    </div>

    <!-- Receipt Details -->
    <div class="p-8 space-y-5">
        <div class="flex justify-between items-center pb-3 border-b border-slate-100 dark:border-white/5 text-xs">
            <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">Payment Date</span>
            <span class="font-mono font-bold text-slate-900 dark:text-white"><?php echo Helper::formatDate($payment['payment_date']); ?></span>
        </div>
        <div class="flex justify-between items-center pb-3 border-b border-slate-100 dark:border-white/5 text-xs">
            <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">Payment Method</span>
            <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-900 dark:text-white"><?php echo $payment['payment_method']; ?></span>
        </div>
        <div class="flex justify-between items-center pb-3 border-b border-slate-100 dark:border-white/5 text-xs">
            <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">Status</span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30">
                <?php echo $payment['payment_status']; ?>
            </span>
        </div>
        
        <!-- Property Info -->
        <div class="pt-4">
            <h3 class="font-display font-black text-xs text-slate-900 dark:text-white uppercase tracking-wider mb-4">Property Specifications</h3>
            <div class="flex flex-col sm:flex-row items-start gap-4">
                <div class="w-20 h-20 border border-slate-200 dark:border-white/10 bg-slate-900 overflow-hidden">
                    <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $payment['main_image'] ?? 'default.jpg'; ?>" 
                         alt="Property" 
                         class="w-full h-full object-cover"
                         onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=150&q=80'">
                </div>
                <div>
                    <h4 class="font-display font-bold text-xs text-slate-900 dark:text-white uppercase tracking-wide"><?php echo $payment['property_title']; ?></h4>
                    <p class="text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 flex items-center gap-1 mt-1 mb-2">
                        <span class="material-symbols-outlined text-[10px]">location_on</span>
                        <?php echo $payment['address'] . ', ' . $payment['city']; ?>
                    </p>
                    <p class="text-[9px] font-mono text-slate-450 dark:text-slate-500 uppercase">
                        Reservation: <?php echo Helper::formatDate($payment['start_date']); ?> - <?php echo Helper::formatDate($payment['end_date']); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="p-6 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-200 dark:border-white/5 flex flex-wrap items-center justify-center gap-4">
        <button onclick="window.print()" 
                class="px-5 py-2.5 bg-charcoal dark:bg-white text-white dark:text-black hover:bg-black dark:hover:bg-slate-100 border border-slate-950 dark:border-white font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">print</span>
            Print Invoice
        </button>
        <a href="mailto:support@primeestate.com" 
           class="px-5 py-2.5 border border-slate-205 dark:border-white/10 hover:border-slate-950 dark:hover:border-white text-slate-700 dark:text-slate-350 font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">help</span>
            Need Support?
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
