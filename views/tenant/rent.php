<?php
// Load dependencies BEFORE the sidebar to allow redirect without "headers already sent" error
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../models/Rent.php';

if (session_status() === PHP_SESSION_NONE) session_start();

$userId = Auth::id();
$tenantModel = new Tenant();
$tenant = $tenantModel->readByUserId($userId);

if (!$tenant) {
    Helper::redirect('views/tenant/dashboard.php');
    exit;
}

// Now safe to include layout (tenant record confirmed)
require_once __DIR__ . '/../layouts/tenant-sidebar.php';

$rentModel = new Rent();
$rents = $rentModel->readByTenantId($tenant['id'])->fetchAll(PDO::FETCH_ASSOC);

$totalBalance = 0;
foreach ($rents as $r) {
    $totalBalance += $r['balance'];
}
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 relative z-10">
    <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">RENT STATEMENT</h1>
    <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">
        Leased Asset: <span class="text-slate-900 dark:text-white font-bold"><?php echo htmlspecialchars($tenant['property_title']); ?></span>
    </p>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark modular panels -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 relative z-10">
        <!-- Balance block (Brutalist gold/black block) -->
        <div class="bg-primary border border-slate-950 dark:border-primary p-8 rounded-none text-black flex flex-col justify-between shadow-[6px_6px_0px_0px_#111111] dark:shadow-[6px_6px_0px_0px_rgba(255,255,255,0.1)]">
            <div>
                <p class="font-display text-[10px] font-black tracking-widest uppercase text-black/70 mb-2">CURRENT BALANCE DUE</p>
                <h2 class="font-mono font-bold text-4xl leading-none"><?php echo Helper::formatCurrency($totalBalance); ?></h2>
            </div>
            
            <div class="mt-6">
                <?php if ($totalBalance > 0): ?>
                <span class="inline-block px-3 py-1.5 border border-black/25 text-[9px] font-bold uppercase tracking-wider font-display bg-black/5">Please settle balance to avoid penalty fees.</span>
                <?php else: ?>
                <span class="inline-block px-3 py-1.5 border border-black/25 text-[9px] font-bold uppercase tracking-wider font-display bg-black/5">Lease ledger is fully paid. Thank you!</span>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Instruction block -->
        <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-8 rounded-none flex flex-col justify-between">
            <div>
                <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-3">Payment Instructions</h3>
                <p class="text-xs text-slate-650 dark:text-slate-350 leading-relaxed uppercase tracking-wide">
                    Lease billings generate on the 1st of every calendar month. Please settle your accounts via mobile wallet, bank clearing, or direct manager deposit.
                </p>
            </div>
            <ul class="space-y-2 mt-5 font-display text-[9px] font-bold tracking-widest uppercase text-slate-500 dark:text-slate-400">
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-sm font-bold">check_circle</span>
                    Mobile Money Wallet (MTN / Telecel)
                </li>
                <li class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-sm font-bold">check_circle</span>
                    Direct Bank Transfer (GCB / Ecobank)
                </li>
            </ul>
        </div>
    </div>

    <!-- Stark brutalist rent table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30">
            <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight">Ledger Statement History</h3>
        </div>
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Post Date</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Amount Due</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Balance</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php foreach ($rents as $r): ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                            <?php echo $r['payment_date'] ? date('d M Y', strtotime($r['payment_date'])) : 'N/A'; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-900 dark:text-white font-mono">
                            <?php echo Helper::formatCurrency($r['amount']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-mono font-bold <?php echo $r['balance'] > 0 ? 'text-red-655 dark:text-red-400' : 'text-slate-550'; ?>">
                            <?php echo Helper::formatCurrency($r['balance']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo $r['status'] == 'paid' 
                                    ? 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30' 
                                    : 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30'; 
                            ?>">
                                <?php echo $r['status']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($rents)): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">receipt_long</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No rent history statements posted.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
