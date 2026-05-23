<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../core/Helper.php';

$tenantModel = new Tenant();
$tenants = $tenantModel->readAll();
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10 max-w-2xl mx-auto">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">RECORD RENT</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Configure and post new billing or payment statement records.</p>
    </div>
    <a href="rent.php" 
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
        <form action="<?php echo BASE_URL; ?>controllers/RentController.php?action=record" method="POST" class="space-y-6">
            <div>
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Select Tenant</label>
                <select name="tenant_id" 
                        required 
                        class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider">
                    <option value="">-- Choose Tenant --</option>
                    <?php while($t = $tenants->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo $t['id']; ?>" data-property="<?php echo $t['property_id']; ?>">
                        <?php echo $t['user_name']; ?> - <?php echo $t['property_title']; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
                <!-- Hidden property_id to be populated by JS -->
                <input type="hidden" name="property_id" id="property_id">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Rent Amount</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-450 text-xs font-mono">GHS</span>
                        <input type="number" 
                               step="0.01" 
                               name="amount" 
                               required 
                               class="w-full pl-12 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                               placeholder="0.00">
                    </div>
                </div>
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Balance Remaining</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-450 text-xs font-mono">GHS</span>
                        <input type="number" 
                               step="0.01" 
                               name="balance" 
                               class="w-full pl-12 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                               placeholder="0.00">
                    </div>
                </div>
            </div>

            <div>
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-2.5 block">Payment Status</label>
                <div class="flex flex-wrap gap-6">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="radio" 
                               name="status" 
                               value="paid" 
                               class="focus:ring-0 h-4 w-4 text-slate-950 border border-slate-200 dark:border-white/10 rounded-none bg-white dark:bg-[#121214]">
                        <span class="font-display text-[10px] font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400 group-hover:text-slate-950 dark:group-hover:text-white transition-colors">Paid</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="radio" 
                               name="status" 
                               value="pending" 
                               checked 
                               class="focus:ring-0 h-4 w-4 text-slate-950 border border-slate-200 dark:border-white/10 rounded-none bg-white dark:bg-[#121214]">
                        <span class="font-display text-[10px] font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400 group-hover:text-slate-950 dark:group-hover:text-white transition-colors">Pending</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="radio" 
                               name="status" 
                               value="overdue" 
                               class="focus:ring-0 h-4 w-4 text-slate-950 border border-slate-200 dark:border-white/10 rounded-none bg-white dark:bg-[#121214]">
                        <span class="font-display text-[10px] font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400 group-hover:text-slate-950 dark:group-hover:text-white transition-colors">Overdue</span>
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-white/5">
                <button type="submit" 
                        class="w-full px-8 py-3.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                    Save Rent Record
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('select[name="tenant_id"]').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption) {
            document.getElementById('property_id').value = selectedOption.getAttribute('data-property') || '';
        }
    });
</script>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
