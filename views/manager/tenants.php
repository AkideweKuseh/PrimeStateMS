<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../core/Helper.php';

$tenantModel = new Tenant();
$tenants = $tenantModel->readAll();
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tenant Management</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage active residents and their lease terms.</p>
    </div>
    <!-- In a real app, we might have an "Assign Tenant" button here too -->
</div>

<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tenant Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Lease Period</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                <?php while($t = $tenants->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                        <?php echo $t['user_name']; ?>
                        <div class="text-xs text-slate-500"><?php echo $t['user_email']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">
                        <?php echo $t['property_title']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        <?php echo date('M d, Y', strtotime($t['lease_start'])); ?> - <?php echo date('M d, Y', strtotime($t['lease_end'])); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?php echo BASE_URL; ?>controllers/TenantController.php?action=delete&id=<?php echo $t['id']; ?>" class="text-red-600 hover:text-red-900 ml-3" onclick="return confirm('Remove tenant record? Property will remain occupied.')">Remove</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if($tenants->rowCount() == 0): ?>
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">No active tenants found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
