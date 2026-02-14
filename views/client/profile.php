<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

Auth::requireLogin();
$userModel = new User();
$user = $userModel->readOne(Auth::id());
?>

<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Profile Settings</h1>
    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage your account information and security.</p>
</div>

<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 max-w-2xl">
    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
        <h2 class="text-lg font-bold text-slate-900 dark:text-white">Personal Information</h2>
    </div>
    
    <div class="p-6">
        <form action="<?php echo BASE_URL; ?>controllers/UserController.php?action=updateProfile" method="POST">
            <!-- Avatar Section (Visual Only for now) -->
            <div class="flex items-center gap-4 mb-8">
                <div class="relative">
                    <img class="w-20 h-20 rounded-full object-cover border-4 border-slate-50 dark:border-slate-800 shadow-md" src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['full_name']); ?>&background=random" alt="Avatar">
                    <button type="button" class="absolute bottom-0 right-0 bg-white dark:bg-slate-700 p-1.5 rounded-full border border-slate-200 dark:border-slate-600 shadow-sm text-slate-500 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </button>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white"><?php echo $user['full_name']; ?></h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400"><?php echo ucfirst($user['role']); ?></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Full Name -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Full Name</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">person</span>
                        <input type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">mail</span>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                    </div>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Phone Number</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">phone</span>
                        <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                    </div>
                </div>
            </div>

            <hr class="border-slate-200 dark:border-slate-800 my-8">

            <div class="mb-6">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Change Password</h3>
                <p class="text-sm text-slate-500 mb-4">Leave blank if you don't want to change your password.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">New Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">lock</span>
                            <input type="password" name="password" class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white" placeholder="Min. 6 characters">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Confirm New Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">lock</span>
                            <input type="password" name="confirm_password" class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white" placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-medium py-2.5 px-6 rounded-lg shadow-lg shadow-primary/20 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
