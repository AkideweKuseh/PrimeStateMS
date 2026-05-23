<?php
require_once __DIR__ . '/../../layouts/admin-sidebar.php';
require_once __DIR__ . '/../../../core/Helper.php';
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10 max-w-2xl mx-auto">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">ADD NEW USER</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Configure credentials and assign operational roles.</p>
    </div>
    <a href="index.php" 
       class="px-5 py-2.5 bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white text-slate-700 dark:text-slate-300 font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Back to List
    </a>
</div>

<div class="relative z-10 max-w-2xl mx-auto">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark Form Card -->
    <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-8 rounded-none relative z-10">
        <form action="<?php echo BASE_URL; ?>controllers/AuthController.php?action=register" method="POST" class="space-y-6">
            <div>
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Full Name</label>
                <input type="text" 
                       name="full_name" 
                       required 
                       class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase" 
                       placeholder="Enter full name">
            </div>

            <div>
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Email Address</label>
                <input type="email" 
                       name="email" 
                       required 
                       class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                       placeholder="email@example.com">
            </div>

            <div>
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Phone Number</label>
                <input type="text" 
                       name="phone" 
                       class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                       placeholder="+233...">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Password</label>
                    <input type="password" 
                           name="password" 
                           required 
                           class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                           placeholder="••••••••">
                </div>
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Confirm Password</label>
                    <input type="password" 
                           name="confirm_password" 
                           required 
                           class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                           placeholder="••••••••">
                </div>
            </div>

            <div>
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Assign Role</label>
                <select name="role" 
                        required 
                        class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider">
                    <option value="client">Client (General User)</option>
                    <option value="manager">Property Manager</option>
                    <option value="tenant">Tenant (Active Resident)</option>
                    <option value="admin">System Administrator</option>
                </select>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-white/5">
                <button type="submit" 
                        class="w-full px-8 py-3.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
