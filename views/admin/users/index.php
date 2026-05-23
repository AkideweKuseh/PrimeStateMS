<?php
require_once __DIR__ . '/../../layouts/admin-sidebar.php';
require_once __DIR__ . '/../../../models/User.php';
require_once __DIR__ . '/../../../core/Helper.php';

$userModel = new User();
$users = $userModel->readAll();
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">User Management</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage accounts for admins, managers, and clients.</p>
    </div>
    <a href="create.php" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">person_add</span>
        Add User
    </a>
</div>

<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                <?php while($u = $users->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=<?php echo urlencode($u['full_name']); ?>&background=random" alt="">
                            <div class="ml-3">
                                <div class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $u['full_name']; ?></div>
                                <div class="text-xs text-slate-500"><?php echo $u['email']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?php 
                            echo match($u['role']) {
                                'admin' => 'bg-red-100 text-red-800',
                                'manager' => 'bg-blue-100 text-blue-800',
                                'tenant' => 'bg-purple-100 text-purple-800',
                                default => 'bg-slate-100 text-slate-800'
                            };
                        ?>">
                            <?php echo $u['role']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="flex items-center gap-1.5 text-xs text-green-600 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Active
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="edit.php?id=<?php echo $u['id']; ?>" class="text-primary hover:text-primary-light">Edit</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
