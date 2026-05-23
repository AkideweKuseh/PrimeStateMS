<?php
require_once __DIR__ . '/../layouts/tenant-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../models/Maintenance.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';

$userId = Auth::id();
$tenantModel = new Tenant();
$tenant = $tenantModel->readByUserId($userId);

if (!$tenant) {
    Helper::redirect('views/tenant/dashboard.php');
    exit;
}

$maintenanceModel = new Maintenance();
$requests = $maintenanceModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Maintenance Requests</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Submit and track issues for your unit.</p>
    </div>
    <a href="submit-maintenance.php" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">add</span>
        New Request
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($requests as $req): ?>
    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
        <div class="flex justify-between items-start mb-4">
            <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase <?php 
                echo match($req['status']) {
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'in_progress' => 'bg-blue-100 text-blue-800',
                    'completed' => 'bg-green-100 text-green-800',
                    default => 'bg-slate-100 text-slate-800'
                };
            ?>">
                <?php echo str_replace('_', ' ', $req['status']); ?>
            </span>
            <span class="text-xs text-slate-400"><?php echo date('M d, Y', strtotime($req['request_date'])); ?></span>
        </div>
        <p class="text-slate-700 dark:text-slate-300 text-sm mb-4"><?php echo $req['issue_description']; ?></p>
        <?php if ($req['status'] === 'completed'): ?>
        <div class="pt-4 border-t border-slate-50 dark:border-slate-800/50 flex items-center gap-2 text-green-600 text-xs font-semibold">
            <span class="material-symbols-outlined text-sm">check_circle</span>
            Resolved
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>

    <?php if (empty($requests)): ?>
    <div class="col-span-full py-12 text-center bg-white dark:bg-[#1a1625] rounded-xl border border-dashed border-slate-200 dark:border-slate-800">
        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">build</span>
        <p class="text-slate-500">You haven't submitted any maintenance requests yet.</p>
        <a href="submit-maintenance.php" class="text-primary font-semibold text-sm mt-2 inline-block">Submit your first request</a>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
