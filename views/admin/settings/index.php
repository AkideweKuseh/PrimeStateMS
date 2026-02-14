<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../core/Helper.php';
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Settings</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage system configurations and administrators.</p>
    </div>
</div>

<?php 
$flash = Helper::getFlash();
if ($flash): 
?>
<div id="toast" class="fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 <?php echo $flash['type'] === 'success' ? 'bg-green-500' : 'bg-red-500'; ?> text-white animate-slide-in">
    <span class="material-symbols-outlined"><?php echo $flash['type'] === 'success' ? 'check_circle' : 'error'; ?></span>
    <span><?php echo $flash['message']; ?></span>
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('toast');
        if (toast) {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }
    }, 3000);
</script>
<?php endif; ?>

<!-- Tabs Navigation -->
<div class="border-b border-slate-200 dark:border-slate-700 mb-6">
    <nav class="flex space-x-8" aria-label="Tabs" id="settingsTabs">
        <button onclick="switchTab('general')" id="tab-general" class="border-primary text-primary whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
            General Settings
        </button>
        <button onclick="switchTab('admins')" id="tab-admins" class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
            Admin Management
        </button>
    </nav>
</div>

<!-- General Settings Content -->
<div id="content-general" class="tab-content transition-opacity duration-300">
    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 max-w-2xl">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Site Identity & Configuration</h2>
        
        <form action="<?php echo BASE_URL; ?>controllers/SettingController.php?action=updateSettings" method="POST" enctype="multipart/form-data" class="space-y-6">
            
            <!-- Logo Upload -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Site Logo</label>
                <div class="flex items-center gap-4">
                    <div class="h-16 w-16 bg-slate-100 dark:bg-slate-800 rounded-lg flex items-center justify-center overflow-hidden border border-slate-200 dark:border-slate-700">
                        <?php if (!empty($settings['site_logo'])): ?>
                            <img src="<?php echo BASE_URL; ?>uploads/settings/<?php echo $settings['site_logo']; ?>" alt="Logo" class="h-full w-full object-contain">
                        <?php else: ?>
                            <span class="material-symbols-outlined text-state-400">image</span>
                        <?php endif; ?>
                    </div>
                    <input type="file" name="site_logo" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Site Name -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Site Name</label>
                    <input type="text" name="site_name" value="<?php echo $settings['site_name'] ?? ''; ?>" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
                </div>
                
                <!-- Site Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Contact Email</label>
                    <input type="email" name="site_email" value="<?php echo $settings['site_email'] ?? ''; ?>" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
                </div>

                <!-- Currency Code -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Currency Code</label>
                    <input type="text" name="currency_code" value="<?php echo $settings['currency_code'] ?? 'GHS'; ?>" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white uppercase" placeholder="USD, GHS">
                </div>

                <!-- Currency Symbol -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Currency Symbol</label>
                    <input type="text" name="currency_symbol" value="<?php echo $settings['currency_symbol'] ?? '₵'; ?>" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white" placeholder="$, ₵">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-dark transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">save</span>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Admin Management Content -->
<div id="content-admins" class="tab-content hidden transition-opacity duration-300">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Create Admin Form -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Add New Administrator</h3>
                <form action="<?php echo BASE_URL; ?>controllers/SettingController.php?action=createAdmin" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-400 mb-1 uppercase tracking-wider">Full Name</label>
                        <input type="text" name="full_name" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-400 mb-1 uppercase tracking-wider">Email Address</label>
                        <input type="email" name="email" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 dark:text-slate-400 mb-1 uppercase tracking-wider">Password</label>
                        <input type="password" name="password" required minlength="6" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
                        <p class="text-xs text-slate-500 mt-1">Must be at least 6 characters.</p>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-lg text-sm font-medium hover:opacity-90 transition-opacity flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg">person_add</span>
                        Create Admin
                    </button>
                </form>
            </div>
        </div>

        <!-- Admin List -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="font-semibold text-slate-900 dark:text-white">Existing Administrators</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Admin</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <?php while($admin = $admins->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xs font-bold mr-3">
                                            <?php echo strtoupper(substr($admin['full_name'], 0, 2)); ?>
                                        </div>
                                        <span class="text-sm font-medium text-slate-900 dark:text-white">
                                            <?php echo $admin['full_name']; ?>
                                            <?php if($admin['id'] == Auth::id()): ?>
                                                <span class="ml-2 text-[10px] bg-blue-100 text-blue-800 px-1.5 py-0.5 rounded-full">YOU</span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                    <?php echo $admin['email']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-slate-500 dark:text-slate-400">
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

<script>
function switchTab(tabName) {
    // Hide all contents
    document.querySelectorAll('.tab-content').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Show selected content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Reset tabs styles
    const tabs = document.querySelectorAll('nav button');
    tabs.forEach(tab => {
        tab.classList.remove('border-primary', 'text-primary');
        tab.classList.add('border-transparent', 'text-slate-500');
    });
    
    // Activate selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.remove('border-transparent', 'text-slate-500');
    activeTab.classList.add('border-primary', 'text-primary');
}
</script>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
