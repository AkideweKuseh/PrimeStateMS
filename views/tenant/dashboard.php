<?php
require_once __DIR__ . '/../layouts/tenant-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../models/Rent.php';
require_once __DIR__ . '/../../models/Maintenance.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';

$userId = Auth::id();
$tenantModel = new Tenant();
$tenant = $tenantModel->readByUserId($userId);

if (!$tenant) {
    echo "<div class='p-6 text-center'><h2 class='text-xl font-bold'>No active lease found.</h2><p class='mt-2'>Please contact management if you believe this is an error.</p></div>";
    require_once __DIR__ . '/../layouts/admin-footer.php';
    exit;
}

$rentModel = new Rent();
$rents = $rentModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);

$maintenanceModel = new Maintenance();
$requests = $maintenanceModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);

$totalBalance = 0;
foreach ($rents as $r) {
    $totalBalance += $r['balance'];
}
?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tenant Dashboard</h1>
    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Property: <span class="font-semibold"><?php echo $tenant['property_title']; ?></span> (<?php echo $tenant['property_address']; ?>)</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white dark:bg-[#1a1625] rounded-xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Balance Due</p>
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1"><?php echo Helper::formatCurrency($totalBalance); ?></h3>
        <a href="rent.php" class="text-xs text-primary font-medium hover:underline mt-2 inline-block">View details</a>
    </div>
    <div class="bg-white dark:bg-[#1a1625] rounded-xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Lease Ends</p>
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1"><?php echo date('M d, Y', strtotime($tenant['lease_end'])); ?></h3>
        <p class="text-xs text-slate-400 mt-2">Renewals available</p>
    </div>
    <div class="bg-white dark:bg-[#1a1625] rounded-xl p-5 shadow-sm border border-slate-100 dark:border-slate-800">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Maintenance</p>
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1"><?php 
            $activeCount = 0;
            foreach ($requests as $req) if ($req['status'] !== 'completed') $activeCount++;
            echo $activeCount;
        ?></h3>
        <a href="maintenance.php" class="text-xs text-primary font-medium hover:underline mt-2 inline-block">Request service</a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Rent History -->
    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Recent Rent Payments</h3>
        <div class="space-y-4">
            <?php foreach (array_slice($rents, 0, 3) as $r): ?>
            <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg">
                <div>
                    <p class="text-sm font-medium text-slate-900 dark:text-white"><?php echo Helper::formatCurrency($r['amount']); ?></p>
                    <p class="text-xs text-slate-500"><?php echo $r['payment_date'] ? date('M d, Y', strtotime($r['payment_date'])) : 'Pending'; ?></p>
                </div>
                <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase <?php echo $r['status'] == 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                    <?php echo $r['status']; ?>
                </span>
            </div>
            <?php endforeach; ?>
            <?php if (empty($rents)): ?>
            <p class="text-sm text-slate-500 text-center py-4">No rent records found.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Maintenance Status -->
    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Maintenance Requests</h3>
        <div class="space-y-4">
            <?php foreach (array_slice($requests, 0, 3) as $req): ?>
            <div class="p-3 border border-slate-100 dark:border-slate-800 rounded-lg">
                <div class="flex justify-between items-start mb-2">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white truncate"><?php echo $req['issue_description']; ?></p>
                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase <?php echo $req['status'] == 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                        <?php echo str_replace('_', ' ', $req['status']); ?>
                    </span>
                </div>
                <p class="text-xs text-slate-500"><?php echo date('M d, Y', strtotime($req['request_date'])); ?></p>
            </div>
            <?php endforeach; ?>
            <?php if (empty($requests)): ?>
            <p class="text-sm text-slate-500 text-center py-4">No maintenance requests.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
