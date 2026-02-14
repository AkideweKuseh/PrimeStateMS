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

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Payments</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Track and manage all client payments.</p>
    </div>
    <div class="flex gap-2">
        <button onclick="window.print()" class="px-4 py-2 bg-white dark:bg-[#1a1625] border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 transition flex items-center gap-2">
            <span class="material-symbols-outlined text-base">print</span>
            Print Report
        </button>
    </div>
</div>

<!-- Payments Table -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
    <div class="overflow-x-auto custom-scrollbar flex-1 rounded-xl">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Transaction Info</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Method</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-[#1a1625] divide-y divide-slate-100 dark:divide-slate-800">
                <?php 
                if($payments->rowCount() > 0):
                    while($payment = $payments->fetch(PDO::FETCH_ASSOC)): 
                ?>
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="block text-sm font-mono font-medium text-slate-900 dark:text-slate-200">
                            <?php echo $payment['transaction_reference']; ?>
                        </span>
                        <span class="text-xs text-slate-400">ID: #<?php echo $payment['id']; ?></span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $payment['client_name']; ?></span>
                            <span class="text-xs text-slate-500"><?php echo $payment['client_email']; ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="block text-sm text-slate-600 dark:text-slate-300 truncate max-w-[150px]" title="<?php echo $payment['property_title']; ?>">
                            <?php echo $payment['property_title']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900 dark:text-white">
                        <?php echo Helper::formatCurrency($payment['amount']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300 uppercase tracking-wider text-xs">
                        <?php echo $payment['payment_method']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php 
                            $statusClass = match($payment['payment_status']) {
                                'completed', 'verified' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                                'failed' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300'
                            };
                        ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusClass; ?>">
                            <?php echo ucfirst($payment['payment_status']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-slate-500 dark:text-slate-400">
                        <?php echo Helper::formatDate($payment['payment_date']); ?>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else:
                ?>
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-500">
                            <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">payments</span>
                            <p class="mb-4">No payment records found.</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
