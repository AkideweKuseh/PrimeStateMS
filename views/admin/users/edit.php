<?php
require_once __DIR__ . '/../../layouts/admin-sidebar.php';
require_once __DIR__ . '/../../../models/User.php';
require_once __DIR__ . '/../../../core/Helper.php';

$id = $_GET['id'] ?? null;
$userModel = new User();
$user = $userModel->readOne($id);

if (!$user) {
    Helper::redirect('views/admin/users/index.php');
    exit;
}
?>

<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="index.php" class="p-2 bg-white dark:bg-[#1a1625] rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:text-primary transition">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit User: <?php echo $user['full_name']; ?></h1>
    </div>

    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-8">
        <form action="<?php echo BASE_URL; ?>controllers/UserController.php?action=update" method="POST" class="space-y-6">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Full Name</label>
                <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email Address</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Phone Number</label>
                <input type="text" name="phone" value="<?php echo $user['phone']; ?>" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Role</label>
                <select name="role" required class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-primary focus:border-primary">
                    <option value="client" <?php echo $user['role'] == 'client' ? 'selected' : ''; ?>>Client</option>
                    <option value="manager" <?php echo $user['role'] == 'manager' ? 'selected' : ''; ?>>Property Manager</option>
                    <option value="tenant" <?php echo $user['role'] == 'tenant' ? 'selected' : ''; ?>>Tenant</option>
                    <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>

            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold shadow-md shadow-primary/20 hover:bg-primary-light transition">
                    Update User Account
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
