<?php
require_once __DIR__ . '/../layouts/tenant-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../models/Rent.php';
require_once __DIR__ . '/../../models/Maintenance.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';

$userId = Auth::id();
$tenantModel = new Tenant();
$tenant = $tenantModel->readByUserId($userId);

if (!$tenant) {
    echo "<div class='p-12 text-center bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none max-w-2xl mx-auto mt-12'>
            <span class='material-symbols-outlined text-4xl text-slate-300 dark:text-slate-600 mb-4'>domain_disabled</span>
            <h2 class='font-display font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight'>No Active Lease Found</h2>
            <p class='text-xs text-slate-450 dark:text-slate-500 uppercase tracking-widest mt-2'>Please contact management if you believe this is an error.</p>
          </div>";
    require_once __DIR__ . '/../layouts/admin-footer.php';
    exit;
}

$rentModel = new Rent();
$rents = $rentModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);

$maintenanceModel = new Maintenance();
$requests = $maintenanceModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);

$totalBalance = 0;
foreach ($rents as $r) {
    $totalBalance += $r['balance'];
}
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 relative z-10">
    <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">RESIDENT DASHBOARD</h1>
    <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">
        Property: <span class="text-slate-900 dark:text-white font-bold"><?php echo htmlspecialchars($tenant['property_title']); ?></span> (<?php echo htmlspecialchars($tenant['property_address']); ?>)
    </p>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist stats grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 relative z-10">
        <!-- Balance Card -->
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none flex flex-col justify-between hover:border-slate-900 dark:hover:border-white transition-all duration-300">
            <div>
                <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">Total Balance Due</p>
                <h3 class="font-mono font-bold text-2xl text-slate-900 dark:text-white mt-2 leading-none"><?php echo Helper::formatCurrency($totalBalance); ?></h3>
            </div>
            <a href="rent.php" class="font-display text-[9px] font-bold tracking-widest uppercase text-primary hover:text-[#d9c441] mt-5 inline-flex items-center gap-1.5 transition-colors">
                View Rent Statement
                <span class="material-symbols-outlined text-[10px]">arrow_forward</span>
            </a>
        </div>
        
        <!-- Lease Card -->
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none flex flex-col justify-between hover:border-slate-900 dark:hover:border-white transition-all duration-300">
            <div>
                <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">Lease Ends</p>
                <h3 class="font-mono font-bold text-xl text-slate-900 dark:text-white mt-2 leading-none"><?php echo date('d M Y', strtotime($tenant['lease_end'])); ?></h3>
            </div>
            <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-450 dark:text-slate-550 mt-5">Lease Renewals Available</p>
        </div>
        
        <!-- Maintenance Card -->
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none flex flex-col justify-between hover:border-slate-900 dark:hover:border-white transition-all duration-300">
            <div>
                <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">Active Requests</p>
                <h3 class="font-mono font-bold text-2xl text-slate-900 dark:text-white mt-2 leading-none"><?php 
                    $activeCount = 0;
                    foreach ($requests as $req) if ($req['status'] !== 'completed') $activeCount++;
                    echo $activeCount;
                ?></h3>
            </div>
            <a href="maintenance.php" class="font-display text-[9px] font-bold tracking-widest uppercase text-primary hover:text-[#d9c441] mt-5 inline-flex items-center gap-1.5 transition-colors">
                Request Service
                <span class="material-symbols-outlined text-[10px]">arrow_forward</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative z-10">
        <!-- Rent History -->
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none">
            <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-5">Recent Rent Statements</h3>
            <div class="space-y-4">
                <?php foreach (array_slice($rents, 0, 3) as $r): ?>
                <div class="flex items-center justify-between p-4 border border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-900/30 rounded-none hover:border-slate-900 dark:hover:border-white transition-colors duration-300">
                    <div>
                        <p class="text-xs font-bold text-slate-900 dark:text-white font-mono"><?php echo Helper::formatCurrency($r['amount']); ?></p>
                        <p class="text-[9px] font-mono text-slate-450 dark:text-slate-500 uppercase mt-1">Due: <?php echo $r['payment_date'] ? date('d M Y', strtotime($r['payment_date'])) : 'Pending'; ?></p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                        echo $r['status'] == 'paid' 
                            ? 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30' 
                            : 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30'; 
                    ?>">
                        <?php echo $r['status']; ?>
                    </span>
                </div>
                <?php endforeach; ?>
                <?php if (empty($rents)): ?>
                <div class="p-8 border border-slate-200 dark:border-white/10 text-center rounded-none bg-slate-50 dark:bg-slate-900/30">
                    <span class="material-symbols-outlined text-3xl text-slate-300 mb-2">receipt_long</span>
                    <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">No rent statements posted.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Maintenance Status -->
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none">
            <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-5">Maintenance Tickets</h3>
            <div class="space-y-4">
                <?php foreach (array_slice($requests, 0, 3) as $req): ?>
                <div class="p-4 border border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-900/30 rounded-none hover:border-slate-900 dark:hover:border-white transition-colors duration-300">
                    <div class="flex justify-between items-start gap-4 mb-3">
                        <p class="text-xs font-bold text-slate-900 dark:text-white uppercase truncate tracking-wide"><?php echo htmlspecialchars($req['issue_description']); ?></p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                            echo match($req['status']) {
                                'completed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                'in_progress' => 'bg-blue-500/10 text-blue-700 border-blue-200 dark:text-blue-400 dark:border-blue-800/30',
                                default => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20'
                            };
                        ?>">
                            <?php echo str_replace('_', ' ', $req['status']); ?>
                        </span>
                    </div>
                    <p class="text-[9px] font-mono text-slate-450 dark:text-slate-500 uppercase">Filed: <?php echo date('d M Y', strtotime($req['request_date'])); ?></p>
                </div>
                <?php endforeach; ?>
                <?php if (empty($requests)): ?>
                <div class="p-8 border border-slate-200 dark:border-white/10 text-center rounded-none bg-slate-50 dark:bg-slate-900/30">
                    <span class="material-symbols-outlined text-3xl text-slate-300 mb-2">build</span>
                    <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">No maintenance tickets filed.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
