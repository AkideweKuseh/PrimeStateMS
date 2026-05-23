<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

Auth::requireLogin();
$userModel = new User();
$user = $userModel->readOne(Auth::id());
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10 max-w-2xl mx-auto">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">PROFILE CONFIG</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Configure profile parameters, contact details, and security passwords.</p>
    </div>
</div>

<div class="relative z-10 max-w-2xl mx-auto">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark Form Card -->
    <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-8 rounded-none relative z-10 shadow-xl">
        <form action="<?php echo BASE_URL; ?>controllers/UserController.php?action=updateProfile" method="POST">
            <!-- Avatar Section -->
            <div class="flex items-center gap-5 mb-8 pb-6 border-b border-slate-200 dark:border-white/5">
                <div class="relative">
                    <div class="h-20 w-20 border border-slate-200 dark:border-white/10 bg-primary/20 text-yellow-750 dark:text-primary flex items-center justify-center text-2xl font-mono font-bold rounded-none">
                        <?php echo strtoupper(substr($user['full_name'], 0, 2)); ?>
                    </div>
                </div>
                <div>
                    <h3 class="font-display font-bold text-sm text-slate-900 dark:text-white uppercase tracking-wide"><?php echo $user['full_name']; ?></h3>
                    <p class="text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mt-1"><?php echo $user['role']; ?></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Full Name -->
                <div class="col-span-2">
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Full Name</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-405 text-lg">person</span>
                        <input type="text" 
                               name="full_name" 
                               value="<?php echo htmlspecialchars($user['full_name']); ?>" 
                               required 
                               class="w-full pl-10 pr-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors uppercase">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-405 text-lg">mail</span>
                        <input type="email" 
                               name="email" 
                               value="<?php echo htmlspecialchars($user['email']); ?>" 
                               required 
                               class="w-full pl-10 pr-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono">
                    </div>
                </div>

                <!-- Phone -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Phone Number</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-405 text-lg">phone</span>
                        <input type="tel" 
                               name="phone" 
                               value="<?php echo htmlspecialchars($user['phone']); ?>" 
                               required 
                               class="w-full pl-10 pr-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono">
                    </div>
                </div>
            </div>

            <hr class="border-slate-200 dark:border-white/5 my-8">

            <div class="mb-6">
                <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-2">Change Password</h3>
                <p class="text-[9px] font-bold tracking-wider text-slate-400 dark:text-slate-500 uppercase mb-5">Leave fields blank if you do not want to alter credentials.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">New Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-405 text-lg">lock</span>
                            <input type="password" 
                                   name="password" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono" 
                                   placeholder="Min. 6 characters">
                        </div>
                    </div>
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Confirm Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-405 text-lg">lock</span>
                            <input type="password" 
                                   name="confirm_password" 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono" 
                                   placeholder="Confirm new password">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-white/5 flex justify-end">
                <button type="submit" 
                        class="px-8 py-3.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
