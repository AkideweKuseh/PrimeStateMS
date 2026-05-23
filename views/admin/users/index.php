<?php
require_once __DIR__ . '/../../layouts/admin-sidebar.php';
require_once __DIR__ . '/../../../models/User.php';
require_once __DIR__ . '/../../../core/Helper.php';

$userModel = new User();
$users = $userModel->readAll();
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">USER ACCOUNTS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Configure credentials, roles, and profiles for administrators, managers, tenants, and clients.</p>
    </div>
    <a href="create.php" 
       class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
        <span class="material-symbols-outlined text-sm font-bold">person_add</span>
        Add User Account
    </a>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist users table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">User Details</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Role</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php while($u = $users->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-9 w-9 rounded-none border border-slate-200 dark:border-white/10 object-cover" 
                                     src="https://ui-avatars.com/api/?name=<?php echo urlencode($u['full_name']); ?>&background=111111&color=EAD44C" 
                                     alt="<?php echo $u['full_name']; ?>">
                                <div class="ml-3">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $u['full_name']; ?></div>
                                    <div class="text-[9px] font-mono text-slate-400 dark:text-slate-500 mt-1"><?php echo $u['email']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo match($u['role']) {
                                    'admin' => 'bg-red-500/10 text-red-750 border-red-200 dark:text-red-400 dark:border-red-800/30',
                                    'manager' => 'bg-blue-500/10 text-blue-750 border-blue-200 dark:text-blue-400 dark:border-blue-800/30',
                                    'tenant' => 'bg-purple-500/10 text-purple-750 border-purple-200 dark:text-purple-400 dark:border-purple-800/30',
                                    default => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:border-white/10'
                                };
                            ?>">
                                <?php echo $u['role']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 text-[9px] font-bold uppercase tracking-wider text-green-600 dark:text-green-400">
                                <span class="w-1.5 h-1.5 rounded-none bg-green-600 dark:bg-green-400"></span>
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <a href="edit.php?id=<?php echo $u['id']; ?>" 
                               class="px-3.5 py-1.5 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300 font-display text-[9px] font-bold tracking-widest uppercase">
                                Edit User
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
