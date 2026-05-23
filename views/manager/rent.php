<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Rent.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../core/Helper.php';

$rentModel = new Rent();
$rent_records = $rentModel->readAll();
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Rent Tracking</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Monitor payments and balances for all properties.</p>
    </div>
    <a href="record-rent.php" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">add</span>
        Record Payment
    </a>
</div>

<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tenant/Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Amount Due</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Balance</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                <?php while($r = $rent_records->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $r['tenant_name']; ?></div>
                        <div class="text-xs text-slate-500"><?php echo $r['property_title']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 dark:text-white font-semibold">
                        <?php echo Helper::formatCurrency($r['amount']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm <?php echo $r['balance'] > 0 ? 'text-red-600 font-bold' : 'text-slate-500'; ?>">
                        <?php echo Helper::formatCurrency($r['balance']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase <?php 
                            echo match($r['status']) {
                                'paid' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'overdue' => 'bg-red-100 text-red-800',
                                default => 'bg-slate-100 text-slate-800'
                            };
                        ?>">
                            <?php echo $r['status']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="edit-rent.php?id=<?php echo $r['id']; ?>" class="text-primary hover:text-primary-light">Edit</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if($rent_records->rowCount() == 0): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">No rent records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
