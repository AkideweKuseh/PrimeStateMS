<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Payment.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

$paymentModel = new Payment();
$payments = $paymentModel->readByUser(Auth::id());
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Payment History</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">View your past transactions and receipts.</p>
    </div>
</div>

<!-- Payments Table -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
    <div class="overflow-x-auto custom-scrollbar flex-1 rounded-xl">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Transaction ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Method</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-[#1a1625] divide-y divide-slate-100 dark:divide-slate-800">
                <?php 
                if($payments->rowCount() > 0):
                    while($row = $payments->fetch(PDO::FETCH_ASSOC)): 
                ?>
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white font-mono">
                        <?php echo $row['transaction_reference'] ?? 'N/A'; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8">
                                <img class="h-8 w-8 rounded object-cover" src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $row['main_image'] ?? 'default.jpg'; ?>" alt="">
                            </div>
                            <div class="ml-3">
                                <span class="block text-sm font-medium text-slate-900 dark:text-white truncate max-w-[150px]" title="<?php echo $row['property_title']; ?>">
                                    <?php echo $row['property_title']; ?>
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                        <?php echo Helper::formatDate($row['payment_date']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                        <?php echo ucfirst($row['payment_method']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                        <?php echo Helper::formatCurrency($row['amount']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                            <?php echo ucfirst($row['payment_status']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?php echo BASE_URL; ?>views/client/payment-receipt.php?id=<?php echo $row['id']; ?>" class="text-primary hover:text-primary-dark transition-colors flex items-center justify-end gap-1">
                            <span class="material-symbols-outlined text-lg">receipt_long</span>
                            View
                        </a>
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
                            <p class="mb-4">No payment history found.</p>
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
