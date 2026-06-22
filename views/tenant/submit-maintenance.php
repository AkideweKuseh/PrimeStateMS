<?php
// Load dependencies BEFORE the sidebar to allow redirect without "headers already sent" error
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../models/Tenant.php';

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
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10 max-w-2xl mx-auto">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">SUBMIT TICKET</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">File a new maintenance request for your assigned residency unit.</p>
    </div>
    <a href="maintenance.php" 
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
        <form action="<?php echo BASE_URL; ?>controllers/MaintenanceController.php?action=submit" method="POST" class="space-y-6">
            <input type="hidden" name="tenant_id" value="<?php echo $tenant['id']; ?>">
            <input type="hidden" name="property_id" value="<?php echo $tenant['property_id']; ?>">

            <div>
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Issue Description</label>
                <textarea name="issue_description" 
                          required 
                          rows="6" 
                          class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider" 
                          placeholder="Describe the issue (e.g. leaking sink faucet, electrical wiring short, HVAC failure)..."></textarea>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-white/5">
                <button type="submit" 
                        class="w-full px-8 py-3.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center justify-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                    <span class="material-symbols-outlined text-sm font-bold">send</span>
                    Submit Request
                </button>
                <p class="text-[9px] text-slate-400 dark:text-slate-500 uppercase mt-4 text-center tracking-widest font-display">Administrative staff will be notified to deploy dispatch personnel shortly.</p>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
