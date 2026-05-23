<?php
require_once __DIR__ . '/../layouts/tenant-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../models/Maintenance.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';

$userId = Auth::id();
$tenantModel = new Tenant();
$tenant = $tenantModel->readByUserId($userId);

if (!$tenant) {
    Helper::redirect('views/tenant/dashboard.php');
    exit;
}

$maintenanceModel = new Maintenance();
$requests = $maintenanceModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">MAINTENANCE HISTORY</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Submit new tickets and track status updates for your leased unit.</p>
    </div>
    <a href="submit-maintenance.php" 
       class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
        <span class="material-symbols-outlined text-sm font-bold">add</span>
        New Request
    </a>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Grid of Requests -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
        <?php foreach ($requests as $req): ?>
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none flex flex-col justify-between hover:border-slate-900 dark:hover:border-white transition-all duration-300">
            <div>
                <div class="flex justify-between items-center mb-4 pb-3 border-b border-slate-100 dark:border-white/5">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                        echo match($req['status']) {
                            'pending' => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20',
                            'in_progress' => 'bg-blue-500/10 text-blue-700 border-blue-200 dark:text-blue-400 dark:border-blue-800/30',
                            'completed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                            default => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-800 dark:text-slate-350 dark:border-white/10'
                        };
                    ?>">
                        <?php echo str_replace('_', ' ', $req['status']); ?>
                    </span>
                    <span class="text-[9px] text-slate-400 dark:text-slate-500 font-mono"><?php echo date('d M Y', strtotime($req['request_date'])); ?></span>
                </div>
                <p class="text-xs text-slate-700 dark:text-slate-300 uppercase tracking-wider leading-relaxed font-bold"><?php echo htmlspecialchars($req['issue_description']); ?></p>
            </div>
            
            <?php if ($req['status'] === 'completed'): ?>
            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center gap-1.5 text-green-600 dark:text-green-400 font-display text-[9px] font-bold tracking-widest uppercase">
                <span class="material-symbols-outlined text-sm font-bold">check_circle</span>
                TICKET RESOLVED
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <?php if (empty($requests)): ?>
        <div class="col-span-full py-16 text-center bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none">
            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3 animate-pulse">build</span>
            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No active maintenance tickets filed.</p>
            <a href="submit-maintenance.php" 
               class="mt-4 px-5 py-2.5 border border-slate-905 dark:border-white text-slate-950 dark:text-white font-display text-[9px] font-bold tracking-widest uppercase rounded-none transition duration-300 hover:bg-slate-50 dark:hover:bg-slate-900 inline-block">
                File Your First Ticket
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
