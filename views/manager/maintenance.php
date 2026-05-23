<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Maintenance.php';
require_once __DIR__ . '/../../core/Helper.php';

$maintenanceModel = new Maintenance();
$requests = $maintenanceModel->readAll();
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Maintenance Requests</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage facility issues and repair schedules.</p>
    </div>
</div>

<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property/Tenant</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Issue Description</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                <?php while($req = $requests->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $req['property_title']; ?></div>
                        <div class="text-xs text-slate-500"><?php echo $req['tenant_name']; ?></div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-slate-600 dark:text-slate-400 max-w-xs truncate" title="<?php echo $req['issue_description']; ?>">
                            <?php echo $req['issue_description']; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                        <?php echo date('M d, Y', strtotime($req['request_date'])); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase <?php 
                            echo match($req['status']) {
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'in_progress' => 'bg-blue-100 text-blue-800',
                                'completed' => 'bg-green-100 text-green-800',
                                default => 'bg-slate-100 text-slate-800'
                            };
                        ?>">
                            <?php echo str_replace('_', ' ', $req['status']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form action="<?php echo BASE_URL; ?>controllers/MaintenanceController.php?action=updateStatus" method="POST" class="inline-flex items-center gap-2">
                            <input type="hidden" name="id" value="<?php echo $req['id']; ?>">
                            <select name="status" onchange="this.form.submit()" class="text-xs rounded border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800">
                                <option value="pending" <?php echo $req['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="in_progress" <?php echo $req['status'] == 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                                <option value="completed" <?php echo $req['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if($requests->rowCount() == 0): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">No maintenance requests found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
