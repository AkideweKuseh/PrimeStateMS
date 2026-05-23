<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../core/Helper.php';

$tenantModel = new Tenant();
$tenants = $tenantModel->readAll();
?>

<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="rent.php" class="p-2 bg-white dark:bg-[#1a1625] rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary transition">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Record Rent Payment</h1>
    </div>

    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-8">
        <form action="<?php echo BASE_URL; ?>controllers/RentController.php?action=record" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Select Tenant</label>
                <select name="tenant_id" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary">
                    <option value="">-- Choose Tenant --</option>
                    <?php while($t = $tenants->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo $t['id']; ?>" data-property="<?php echo $t['property_id']; ?>">
                        <?php echo $t['user_name']; ?> - <?php echo $t['property_title']; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
                <!-- Hidden property_id to be populated by JS or handled in controller if we fetch by tenant_id -->
                <input type="hidden" name="property_id" id="property_id">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Rent Amount</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">GH₵</span>
                        <input type="number" step="0.01" name="amount" required class="w-full pl-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary" placeholder="0.00">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Balance Remaining</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">GH₵</span>
                        <input type="number" step="0.01" name="balance" class="w-full pl-12 rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary" placeholder="0.00">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" value="paid" class="text-primary focus:ring-primary">
                        <span class="text-sm text-slate-600 dark:text-slate-400">Paid</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" value="pending" checked class="text-primary focus:ring-primary">
                        <span class="text-sm text-slate-600 dark:text-slate-400">Pending</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" value="overdue" class="text-primary focus:ring-primary">
                        <span class="text-sm text-slate-600 dark:text-slate-400">Overdue</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold shadow-md shadow-primary/20 hover:bg-primary-light transition">
                    Save Rent Record
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('select[name="tenant_id"]').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('property_id').value = selectedOption.getAttribute('data-property');
    });
</script>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
