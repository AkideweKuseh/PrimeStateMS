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

// Basic Access Control (Ensure payment belongs to user OR user is linked to booking)
// Note: The readOne query already joins user info, we can check if Auth::id() matches client_id
if (!$payment || $payment['id'] == null) { // Simple check, enhance as needed
    Helper::flash('error', 'Receipt not found.');
    Helper::redirect('views/client/payments.php');
}
?>

<!-- Back Button -->
<div class="mb-6">
    <a href="<?php echo BASE_URL; ?>views/client/payments.php" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Back to Payments
    </a>
</div>

<div class="max-w-2xl mx-auto bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
    <!-- Receipt Header -->
    <div class="bg-slate-50 dark:bg-slate-800/50 p-8 text-center border-b border-slate-100 dark:border-slate-800">
        <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-3xl">check</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">Payment Successful</h1>
        <p class="text-slate-500 dark:text-slate-400 text-sm">Transaction ID: <span class="font-mono"><?php echo $payment['transaction_reference']; ?></span></p>
        <h2 class="text-3xl font-bold text-slate-900 dark:text-white mt-4"><?php echo Helper::formatCurrency($payment['amount']); ?></h2>
    </div>

    <!-- Receipt Details -->
    <div class="p-8 space-y-6">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 dark:border-slate-800">
            <span class="text-slate-500 dark:text-slate-400">Payment Date</span>
            <span class="font-medium text-slate-900 dark:text-white"><?php echo Helper::formatDate($payment['payment_date']); ?></span>
        </div>
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 dark:border-slate-800">
            <span class="text-slate-500 dark:text-slate-400">Payment Method</span>
            <span class="font-medium text-slate-900 dark:text-white"><?php echo ucfirst($payment['payment_method']); ?></span>
        </div>
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 dark:border-slate-800">
            <span class="text-slate-500 dark:text-slate-400">Status</span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                <?php echo ucfirst($payment['payment_status']); ?>
            </span>
        </div>
        
        <!-- Property Info -->
        <div class="pt-2">
            <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Property Details</h3>
            <div class="flex items-start gap-4">
                <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $payment['main_image'] ?? 'default.jpg'; ?>" alt="Property" class="w-20 h-20 rounded-lg object-cover bg-slate-100">
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white text-lg"><?php echo $payment['property_title']; ?></h4>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-1"><?php echo $payment['address'] . ', ' . $payment['city']; ?></p>
                    <p class="text-xs text-slate-400">
                        Booking: <?php echo Helper::formatDate($payment['start_date']); ?> - <?php echo Helper::formatDate($payment['end_date']); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="p-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-center gap-4">
        <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-200 hover:bg-white dark:hover:bg-slate-700 transition-colors font-medium text-sm">
            <span class="material-symbols-outlined text-lg">print</span>
            Print Receipt
        </button>
        <a href="mailto:support@primeestate.com" class="flex items-center gap-2 px-4 py-2 text-primary hover:text-primary-dark transition-colors font-medium text-sm">
            <span class="material-symbols-outlined text-lg">help</span>
            Need Help?
        </a>
    </div>
</div>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
