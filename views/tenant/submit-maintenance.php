<?php
require_once __DIR__ . '/../layouts/tenant-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';

$userId = Auth::id();
$tenantModel = new Tenant();
$tenant = $tenantModel->readByUserId($userId);

if (!$tenant) {
    Helper::redirect('views/tenant/dashboard.php');
    exit;
}
?>

<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="maintenance.php" class="p-2 bg-white dark:bg-[#1a1625] rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary transition">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Submit Maintenance Request</h1>
    </div>

    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-8">
        <form action="<?php echo BASE_URL; ?>controllers/MaintenanceController.php?action=submit" method="POST" class="space-y-6">
            <input type="hidden" name="tenant_id" value="<?php echo $tenant['id']; ?>">
            <input type="hidden" name="property_id" value="<?php echo $tenant['property_id']; ?>">

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Issue Description</label>
                <textarea name="issue_description" required rows="5" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary placeholder-slate-400" placeholder="Please describe the issue in detail (e.g., Leaking faucet in the kitchen sink)..."></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold shadow-md shadow-primary/20 hover:bg-primary-light transition flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">send</span>
                    Submit Request
                </button>
                <p class="text-xs text-slate-400 mt-4 text-center">Maintenance staff will be notified and will contact you shortly.</p>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
