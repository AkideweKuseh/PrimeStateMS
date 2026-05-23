<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../core/Helper.php';
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">SYSTEM SETTINGS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Configure global application variables, site identity, and administrator credentials.</p>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Tabs Navigation -->
    <div class="mb-8 border-b border-slate-200 dark:border-white/10 print:hidden relative z-10">
        <nav class="-mb-px flex flex-wrap gap-2" aria-label="Tabs" id="settingsTabs">
            <button onclick="switchTab('general')" id="tab-general" 
                    class="tab-btn px-6 py-3 border border-b-0 border-slate-250 bg-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">settings</span> General Settings
            </button>
            <button onclick="switchTab('admins')" id="tab-admins" 
                    class="tab-btn px-6 py-3 border border-b-0 border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white bg-white dark:bg-[#151517] font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">manage_accounts</span> Admin Management
            </button>
        </nav>
    </div>

    <!-- General Settings Content -->
    <div id="content-general" class="tab-content block relative z-10">
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-8 rounded-none max-w-2xl">
            <h2 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-6">Site Identity & Configuration</h2>
            
            <form action="<?php echo BASE_URL; ?>controllers/SettingController.php?action=updateSettings" method="POST" enctype="multipart/form-data" class="space-y-6">
                
                <!-- Logo Upload -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-2 block">Site Logo</label>
                    <div class="flex items-center gap-5 flex-wrap">
                        <div class="h-16 w-16 bg-slate-50 dark:bg-slate-900 rounded-none flex items-center justify-center overflow-hidden border border-slate-200 dark:border-white/10">
                            <?php if (!empty($settings['site_logo'])): ?>
                                <img src="<?php echo BASE_URL; ?>uploads/settings/<?php echo $settings['site_logo']; ?>" alt="Logo" class="h-full w-full object-contain">
                            <?php else: ?>
                                <span class="material-symbols-outlined text-slate-400 text-xl">image</span>
                            <?php endif; ?>
                        </div>
                        <input type="file" 
                               name="site_logo" 
                               accept="image/*" 
                               class="block w-full sm:w-auto text-xs text-slate-500
                                   file:mr-4 file:py-2.5 file:px-5
                                   file:rounded-none file:border file:border-slate-950 dark:file:border-white
                                   file:text-[10px] file:font-display file:font-bold file:tracking-widest file:uppercase
                                   file:bg-charcoal file:text-white
                                   dark:file:bg-white dark:file:text-black
                                   hover:file:bg-black dark:hover:file:bg-slate-100 transition duration-300">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Site Name -->
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Site Name</label>
                        <input type="text" 
                               name="site_name" 
                               value="<?php echo $settings['site_name'] ?? ''; ?>" 
                               class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase">
                    </div>
                    
                    <!-- Site Email -->
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Contact Email</label>
                        <input type="email" 
                               name="site_email" 
                               value="<?php echo $settings['site_email'] ?? ''; ?>" 
                               class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono">
                    </div>

                    <!-- Currency Code -->
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Currency Code</label>
                        <input type="text" 
                               name="currency_code" 
                               value="<?php echo $settings['currency_code'] ?? 'GHS'; ?>" 
                               class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono uppercase" 
                               placeholder="USD, GHS">
                    </div>

                    <!-- Currency Symbol -->
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Currency Symbol</label>
                        <input type="text" 
                               name="currency_symbol" 
                               value="<?php echo $settings['currency_symbol'] ?? '₵'; ?>" 
                               class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors" 
                               placeholder="$, ₵">
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-200 dark:border-white/5">
                    <button type="submit" 
                            class="px-8 py-3.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Admin Management Content -->
    <div id="content-admins" class="tab-content hidden relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Create Admin Form -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none sticky top-6">
                    <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-5">Add Administrator</h3>
                    <form action="<?php echo BASE_URL; ?>controllers/SettingController.php?action=createAdmin" method="POST" class="space-y-5">
                        <div>
                            <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Full Name</label>
                            <input type="text" 
                                   name="full_name" 
                                   required 
                                   class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase">
                        </div>
                        <div>
                            <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Email Address</label>
                            <input type="email" 
                                   name="email" 
                                   required 
                                   class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono">
                        </div>
                        <div>
                            <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Password</label>
                            <input type="password" 
                                   name="password" 
                                   required 
                                   minlength="6" 
                                   class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                                   placeholder="••••••••">
                            <p class="text-[9px] text-slate-400 dark:text-slate-500 uppercase mt-1">Must be at least 6 characters.</p>
                        </div>
                        <button type="submit" 
                                class="w-full px-5 py-3 bg-charcoal dark:bg-white text-white dark:text-black hover:bg-black dark:hover:bg-slate-100 border border-slate-950 dark:border-white font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">person_add</span>
                            Create Admin
                        </button>
                    </form>
                </div>
            </div>

            <!-- Admin List -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30">
                        <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight">Existing Administrators</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                            <thead class="bg-slate-50 dark:bg-slate-800/50">
                                <tr>
                                    <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Admin Name</th>
                                    <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Email</th>
                                    <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Created</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                                <?php while($admin = $admins->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-9 w-9 border border-slate-200 dark:border-white/10 bg-primary/20 text-yellow-750 dark:text-primary flex items-center justify-center text-[10px] font-mono font-bold mr-3 rounded-none">
                                                <?php echo strtoupper(substr($admin['full_name'], 0, 2)); ?>
                                            </div>
                                            <span class="text-xs font-bold text-slate-900 dark:text-white uppercase flex items-center">
                                                <?php echo $admin['full_name']; ?>
                                                <?php if($admin['id'] == Auth::id()): ?>
                                                    <span class="ml-2 text-[8px] bg-green-500/10 text-green-700 border border-green-200 dark:text-green-400 dark:border-green-800/30 px-2 py-0.5 rounded-none font-bold">ACTIVE</span>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 dark:text-slate-400 font-mono">
                                        <?php echo $admin['email']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs text-slate-500 dark:text-slate-400 font-mono">
                                        <?php echo Helper::formatDate($admin['created_at']); ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabName) {
    // Hide all contents
    document.querySelectorAll('.tab-content').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Show selected content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Reset tabs styles
    const tabs = document.querySelectorAll('nav .tab-btn');
    tabs.forEach(tab => {
        tab.classList.remove('bg-primary', 'text-black', 'border-slate-250');
        tab.classList.add('text-slate-500', 'bg-white', 'dark:bg-[#151517]', 'border-slate-200', 'dark:border-white/10');
    });
    
    // Activate selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.remove('text-slate-500', 'bg-white', 'dark:bg-[#151517]', 'border-slate-200', 'dark:border-white/10');
    activeTab.classList.add('bg-primary', 'text-black', 'border-slate-250');
}
</script>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
