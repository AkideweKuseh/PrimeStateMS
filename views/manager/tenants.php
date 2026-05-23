<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../core/Helper.php';

$tenantModel = new Tenant();
$tenants = $tenantModel->readAll();
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">TENANT DIRECTORY</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Manage active residents, contact information, and lease timeline specifications.</p>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist tenants table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Resident</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Assigned Property</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Lease Duration</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php while($t = $tenants->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-9 w-9 border border-slate-200 dark:border-white/10 bg-primary/20 text-yellow-750 dark:text-primary flex items-center justify-center text-[10px] font-mono font-bold mr-3 rounded-none">
                                    <?php echo strtoupper(substr($t['user_name'], 0, 2)); ?>
                                </div>
                                <div class="ml-1">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $t['user_name']; ?></div>
                                    <div class="text-[9px] font-mono text-slate-400 dark:text-slate-500 mt-1"><?php echo $t['user_email']; ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-650 dark:text-slate-350 uppercase">
                            <?php echo $t['property_title']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                            <?php echo date('d M Y', strtotime($t['lease_start'])); ?> 
                            <span class="text-[9px] font-bold text-slate-400 uppercase font-display mx-1">TO</span> 
                            <?php echo date('d M Y', strtotime($t['lease_end'])); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <a href="<?php echo BASE_URL; ?>controllers/TenantController.php?action=delete&id=<?php echo $t['id']; ?>" 
                               class="px-3 py-1.5 border border-red-500/20 text-red-600 hover:text-red-800 hover:border-red-650 rounded-none transition duration-300 font-display text-[9px] font-bold tracking-widest uppercase"
                               onclick="return confirm('Remove tenant lease record? The property will remain occupied.')">
                                Terminate
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($tenants->rowCount() == 0): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">group_off</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No active leases recorded.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
