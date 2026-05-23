<?php
require_once __DIR__ . '/../layouts/tenant-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../models/Rent.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';

$userId = Auth::id();
$tenantModel = new Tenant();
$tenant = $tenantModel->readByUserId($userId);

if (!$tenant) {
    Helper::redirect('views/tenant/dashboard.php');
    exit;
}

$rentModel = new Rent();
$rents = $rentModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);

$totalBalance = 0;
foreach ($rents as $r) {
    $totalBalance += $r['balance'];
}
?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">My Rent & Payments</h1>
    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Property: <span class="font-semibold"><?php echo $tenant['property_title']; ?></span></p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-primary rounded-2xl p-8 text-white shadow-xl shadow-primary/20">
        <p class="text-sm font-medium opacity-80 uppercase tracking-wider mb-2">Current Balance Due</p>
        <h2 class="text-4xl font-bold"><?php echo Helper::formatCurrency($totalBalance); ?></h2>
        <?php if ($totalBalance > 0): ?>
        <p class="mt-4 text-xs bg-white/20 inline-block px-3 py-1 rounded-full">Please settle your balance to avoid late fees.</p>
        <?php else: ?>
        <p class="mt-4 text-xs bg-white/20 inline-block px-3 py-1 rounded-full">All payments are up to date. Thank you!</p>
        <?php endif; ?>
    </div>
    
    <div class="bg-white dark:bg-[#1a1625] rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Payment Instructions</h3>
        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
            Rent is due on the 1st of every month. You can pay via:
        </p>
        <ul class="space-y-2">
            <li class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300">
                <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                Mobile Money (MTN/AirtelTigo)
            </li>
            <li class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300">
                <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                Bank Transfer (GCB/EcoBank)
            </li>
            <li class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-300">
                <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                In-person at the management office
            </li>
        </ul>
    </div>
</div>

<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="p-6 border-b border-slate-50 dark:border-slate-800/50">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Payment History</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Balance</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                <?php foreach ($rents as $r): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">
                        <?php echo $r['payment_date'] ? date('M d, Y', strtotime($r['payment_date'])) : 'N/A'; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900 dark:text-white">
                        <?php echo Helper::formatCurrency($r['amount']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm <?php echo $r['balance'] > 0 ? 'text-red-600 font-bold' : 'text-slate-500'; ?>">
                        <?php echo Helper::formatCurrency($r['balance']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase <?php 
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
                </tr>
                <?php endforeach; ?>
                <?php if (empty($rents)): ?>
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">No rent records found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
