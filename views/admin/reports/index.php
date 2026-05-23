<?php 
if (Auth::isAdmin()) {
    require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
} else {
    require_once __DIR__ . '/../../layouts/manager-sidebar.php'; 
}
require_once __DIR__ . '/../../../core/Helper.php';
?>

<!-- Minimalist Page Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 print:hidden relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">SYSTEM REPORTS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Generate, print, and export system-wide operational metrics.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <!-- Download All Reports Button (Hudson 8 Stark Gold Callout) -->
        <a href="<?php echo BASE_URL; ?>controllers/ReportController.php?action=export&type=all" 
           class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
            <span class="material-symbols-outlined text-sm font-bold">download</span>
            Download All Reports
        </a>
        
        <!-- Print Button -->
        <button onclick="window.print()" 
                class="px-5 py-2.5 bg-charcoal dark:bg-white text-white dark:text-black hover:bg-black dark:hover:bg-slate-100 border border-slate-950 dark:border-white font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">print</span>
            Print All Reports
        </button>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Report Navigation Tabs -->
    <div class="mb-8 border-b border-slate-200 dark:border-white/10 print:hidden relative z-10">
        <nav class="-mb-px flex flex-wrap gap-2" aria-label="Tabs">
            <button onclick="showTab('properties')" id="tab-properties" 
                    class="tab-btn px-6 py-3 border border-b-0 border-slate-250 bg-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">domain</span> Properties
            </button>
            <button onclick="showTab('bookings')" id="tab-bookings" 
                    class="tab-btn px-6 py-3 border border-b-0 border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white bg-white dark:bg-[#151517] font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">event_note</span> Bookings
            </button>
            <button onclick="showTab('financials')" id="tab-financials" 
                    class="tab-btn px-6 py-3 border border-b-0 border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white bg-white dark:bg-[#151517] font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">payments</span> Financials
            </button>
            <button onclick="showTab('rent')" id="tab-rent" 
                    class="tab-btn px-6 py-3 border border-b-0 border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white bg-white dark:bg-[#151517] font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">receipt_long</span> Rent Tracking
            </button>
            <button onclick="showTab('maintenance')" id="tab-maintenance" 
                    class="tab-btn px-6 py-3 border border-b-0 border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white bg-white dark:bg-[#151517] font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">build</span> Maintenance
            </button>
        </nav>
    </div>

    <!-- Reports Content -->
    <div class="space-y-8 relative z-10">

        <!-- Properties Report -->
        <div id="report-properties" class="report-section block">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="font-display font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">Property Inventory</h2>
                        <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase">Full list of properties and their current status</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="font-display text-[10px] font-bold tracking-widest uppercase bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 px-3 py-1.5 border border-slate-200 dark:border-white/5">
                            Total: <?php echo $propertyStats['total']; ?> Units
                        </span>
                        <a href="<?php echo BASE_URL; ?>controllers/ReportController.php?action=export&type=properties" 
                           class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300 print:hidden" 
                           title="Export CSV">
                            <span class="material-symbols-outlined text-base">download</span>
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-white/10">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Location</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Type</th>
                                <th class="px-4 py-3 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Price</th>
                                <th class="px-4 py-3 text-center font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5 bg-white dark:bg-[#151517]">
                            <?php foreach($propertyList as $prop): ?>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                                <td class="px-4 py-3 text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $prop['title']; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500"><?php echo $prop['city']; ?>, <?php echo $prop['address']; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 font-mono"><?php echo strtoupper($prop['property_type']); ?></td>
                                <td class="px-4 py-3 text-xs font-bold text-right text-slate-900 dark:text-white"><?php echo Helper::formatCurrency($prop['price']); ?></td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-none text-[9px] font-bold uppercase border border-slate-200 dark:border-white/10 <?php 
                                        echo match(strtolower($prop['status'])) {
                                            'available' => 'bg-primary/20 text-yellow-750 dark:text-primary',
                                            'occupied' => 'bg-charcoal text-white dark:bg-white dark:text-black',
                                            default => 'bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300'
                                        };
                                    ?>">
                                        <?php echo $prop['status']; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Bookings Report -->
        <div id="report-bookings" class="report-section hidden">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="font-display font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">Booking History</h2>
                        <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase">Overview of booking requests and viewings</p>
                    </div>
                    <a href="<?php echo BASE_URL; ?>controllers/ReportController.php?action=export&type=bookings" 
                       class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300 print:hidden" 
                       title="Export CSV">
                        <span class="material-symbols-outlined text-base">download</span>
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-white/10">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Booking Ref</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Client</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Dates</th>
                                <th class="px-4 py-3 text-center font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5 bg-white dark:bg-[#151517]">
                            <?php foreach($bookingList as $booking): ?>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                                <td class="px-4 py-3 text-xs font-mono text-slate-500">#<?php echo $booking['id']; ?></td>
                                <td class="px-4 py-3 text-xs font-bold text-slate-900 dark:text-white uppercase">
                                    <?php echo $booking['client_name']; ?><br>
                                    <span class="text-[9px] text-slate-400 font-mono tracking-normal font-normal"><?php echo $booking['client_phone']; ?></span>
                                </td>
                                <td class="px-4 py-3 text-xs text-slate-500 uppercase"><?php echo $booking['title']; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 font-mono">
                                    <?php echo Helper::formatDate($booking['start_date']); ?>
                                    <?php if($booking['end_date']): ?> - <?php echo Helper::formatDate($booking['end_date']); ?><?php endif; ?>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-none text-[9px] font-bold uppercase border <?php 
                                        echo match($booking['booking_status']) {
                                            'confirmed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                            'pending' => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20',
                                            default => 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30'
                                        };
                                    ?>">
                                        <?php echo $booking['booking_status']; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Financial Report -->
        <div id="report-financials" class="report-section hidden">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="font-display font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">Financial Revenue</h2>
                        <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase">System transaction logs and cashflows</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Total Revenue</p>
                            <p class="text-xl font-display font-black text-primary"><?php echo Helper::formatCurrency($totalRevenue); ?></p>
                        </div>
                        <a href="<?php echo BASE_URL; ?>controllers/ReportController.php?action=export&type=financials" 
                           class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300 print:hidden" 
                           title="Export CSV">
                            <span class="material-symbols-outlined text-base">download</span>
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-white/10">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Transaction ID</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Date</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Client</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Method</th>
                                <th class="px-4 py-3 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5 bg-white dark:bg-[#151517]">
                            <?php foreach($paymentList as $payment): ?>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                                <td class="px-4 py-3 text-xs font-mono text-slate-500 uppercase"><?php echo $payment['transaction_reference'] ?? 'N/A'; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 font-mono"><?php echo Helper::formatDate($payment['payment_date']); ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 uppercase"><?php echo $payment['client_name']; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 font-mono uppercase"><?php echo $payment['payment_method']; ?></td>
                                <td class="px-4 py-3 text-xs font-bold text-right text-slate-900 dark:text-white"><?php echo Helper::formatCurrency($payment['amount']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Rent Tracking Report -->
        <div id="report-rent" class="report-section hidden">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="font-display font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">Rent Collection</h2>
                        <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase">Tenant rental payments and outstanding balances</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Total Rent Collected</p>
                            <p class="text-lg font-display font-bold text-green-600 dark:text-green-400"><?php echo Helper::formatCurrency($totalRentCollected); ?></p>
                        </div>
                        <a href="<?php echo BASE_URL; ?>controllers/ReportController.php?action=export&type=rent" 
                           class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300 print:hidden" 
                           title="Export CSV">
                            <span class="material-symbols-outlined text-base">download</span>
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-white/10">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Tenant</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property</th>
                                <th class="px-4 py-3 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Amount Due</th>
                                <th class="px-4 py-3 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Balance</th>
                                <th class="px-4 py-3 text-center font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5 bg-white dark:bg-[#151517]">
                            <?php foreach($rentList as $r): ?>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                                <td class="px-4 py-3 text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $r['tenant_name']; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 uppercase"><?php echo $r['property_title']; ?></td>
                                <td class="px-4 py-3 text-xs text-right text-slate-600 dark:text-slate-400 font-mono"><?php echo Helper::formatCurrency($r['amount']); ?></td>
                                <td class="px-4 py-3 text-xs text-right font-bold font-mono <?php echo $r['balance'] > 0 ? 'text-red-650 dark:text-red-400' : 'text-slate-500'; ?>"><?php echo Helper::formatCurrency($r['balance']); ?></td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-none border text-[9px] font-bold uppercase <?php 
                                        echo $r['status'] == 'paid' 
                                            ? 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30' 
                                            : 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30'; 
                                    ?>">
                                        <?php echo $r['status']; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Maintenance Report -->
        <div id="report-maintenance" class="report-section hidden">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="font-display font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">Maintenance & Repairs</h2>
                        <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase">Summary of facility requests and resolution statuses</p>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="flex gap-4">
                            <div class="text-center">
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Pending</p>
                                <p class="font-display font-bold text-yellow-600 dark:text-primary"><?php echo $maintenanceStats['pending']; ?></p>
                            </div>
                            <div class="text-center">
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Progress</p>
                                <p class="font-display font-bold text-blue-600 dark:text-blue-400"><?php echo $maintenanceStats['in_progress']; ?></p>
                            </div>
                        </div>
                        <a href="<?php echo BASE_URL; ?>controllers/ReportController.php?action=export&type=maintenance" 
                           class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300 print:hidden" 
                           title="Export CSV">
                            <span class="material-symbols-outlined text-base">download</span>
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-white/10">
                        <thead class="bg-slate-50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Issue</th>
                                <th class="px-4 py-3 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Request Date</th>
                                <th class="px-4 py-3 text-center font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-white/5 bg-white dark:bg-[#151517]">
                            <?php foreach($maintenanceList as $m): ?>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                                <td class="px-4 py-3 text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $m['property_title']; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 truncate max-w-xs uppercase"><?php echo $m['issue_description']; ?></td>
                                <td class="px-4 py-3 text-xs text-slate-500 font-mono"><?php echo Helper::formatDate($m['request_date']); ?></td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-none border text-[9px] font-bold uppercase <?php 
                                        echo match($m['status']) {
                                            'pending' => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20',
                                            'in_progress' => 'bg-blue-500/10 text-blue-700 border-blue-200 dark:text-blue-400 dark:border-blue-800/30',
                                            'completed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                            default => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-800 dark:text-slate-350 dark:border-white/10'
                                        };
                                    ?>">
                                        <?php echo str_replace('_', ' ', $m['status']); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all sections
    document.querySelectorAll('.report-section').forEach(el => {
        el.classList.add('hidden');
    });
    // Show selected
    const selected = document.getElementById('report-' + tabName);
    if(selected) selected.classList.remove('hidden');
    
    // Update tabs
    const tabs = ['properties', 'bookings', 'financials', 'rent', 'maintenance'];
    tabs.forEach(t => {
        const btn = document.getElementById('tab-' + t);
        if(!btn) return;
        if(t === tabName) {
            btn.classList.add('bg-primary', 'text-black', 'border-slate-250');
            btn.classList.remove('text-slate-500', 'bg-white', 'dark:bg-[#151517]');
        } else {
            btn.classList.remove('bg-primary', 'text-black', 'border-slate-250');
            btn.classList.add('text-slate-500', 'bg-white', 'dark:bg-[#151517]');
        }
    });
}
</script>

<!-- Print Styles -->
<style>
    @media print {
        header, aside, .print\:hidden {
            display: none !important;
        }
        main {
            padding: 0 !important;
            margin: 0 !important;
            overflow: visible !important;
        }
        .report-section {
            display: block !important;
            margin-bottom: 3rem;
            break-inside: avoid;
        }
        body {
            background: white !important;
            color: black !important;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 10px;
        }
        .bg-white, .dark\:bg-\[\#151517\] {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }
    }
</style>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
