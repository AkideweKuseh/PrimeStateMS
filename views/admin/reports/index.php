<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../core/Helper.php';
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 print:hidden">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">System Reports</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Generate and print reports for properties, bookings, and finances.</p>
    </div>
    <div class="flex gap-2">
        <button onclick="window.print()" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition flex items-center gap-2">
            <span class="material-symbols-outlined text-base">print</span>
            Print All Reports
        </button>
    </div>
</div>

<!-- Report Navigation Tabs (Simple implementation using anchor links or JS tabs) -->
<div class="mb-6 border-b border-slate-200 dark:border-slate-700 print:hidden">
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
        <button onclick="showTab('properties')" id="tab-properties" class="border-primary text-primary whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">domain</span> Properties
        </button>
        <button onclick="showTab('bookings')" id="tab-bookings" class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">event_note</span> Bookings
        </button>
        <button onclick="showTab('financials')" id="tab-financials" class="border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">payments</span> Financials
        </button>
    </nav>
</div>

<!-- Reports Content -->
<div class="space-y-8">

    <!-- Properties Report -->
    <div id="report-properties" class="report-section block">
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Property Inventory Report</h2>
                <div class="flex gap-2 print:hidden">
                    <span class="text-sm text-slate-500">Total: <strong><?php echo $propertyStats['total']; ?></strong></span>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                    <thead class="bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Property</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Location</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Type</th>
                            <th class="px-4 py-2 text-right text-xs font-semibold text-slate-500 uppercase">Price</th>
                            <th class="px-4 py-2 text-center text-xs font-semibold text-slate-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php foreach($propertyList as $prop): ?>
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white"><?php echo $prop['title']; ?></td>
                            <td class="px-4 py-3 text-sm text-slate-500"><?php echo $prop['city']; ?>, <?php echo $prop['address']; ?></td>
                            <td class="px-4 py-3 text-sm text-slate-500"><?php echo ucfirst($prop['property_type']); ?></td>
                            <td class="px-4 py-3 text-sm font-medium text-right text-slate-900 dark:text-white"><?php echo Helper::formatCurrency($prop['price']); ?></td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">
                                    <?php echo ucfirst($prop['status']); ?>
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
    <div id="report-bookings" class="report-section hidden print:block">
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Booking History Report</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                    <thead class="bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Booking Ref</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Client</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Property</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Dates</th>
                            <th class="px-4 py-2 text-center text-xs font-semibold text-slate-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php foreach($bookingList as $booking): ?>
                        <tr>
                            <td class="px-4 py-3 text-sm font-mono text-slate-500">#<?php echo $booking['id']; ?></td>
                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">
                                <?php echo $booking['client_name']; ?><br>
                                <span class="text-xs text-slate-400 font-normal"><?php echo $booking['client_phone']; ?></span>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-500"><?php echo $booking['title']; ?></td>
                            <td class="px-4 py-3 text-sm text-slate-500">
                                <?php echo Helper::formatDate($booking['start_date']); ?>
                                <?php if($booking['end_date']): ?> - <?php echo Helper::formatDate($booking['end_date']); ?><?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                    <?php echo $booking['booking_status'] == 'confirmed' ? 'bg-green-100 text-green-800' : ($booking['booking_status'] == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); ?>">
                                    <?php echo ucfirst($booking['booking_status']); ?>
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
    <div id="report-financials" class="report-section hidden print:block">
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Financial Revenue Report</h2>
                <div class="text-right">
                    <p class="text-sm text-slate-500">Total Revenue</p>
                    <p class="text-xl font-bold text-primary"><?php echo Helper::formatCurrency($totalRevenue); ?></p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                    <thead class="bg-slate-50 dark:bg-slate-800/50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Transaction ID</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Date</th>
                             <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Client</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500 uppercase">Method</th>
                            <th class="px-4 py-2 text-right text-xs font-semibold text-slate-500 uppercase">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php foreach($paymentList as $payment): ?>
                        <tr>
                            <td class="px-4 py-3 text-sm font-mono text-slate-500"><?php echo $payment['transaction_reference']; ?></td>
                            <td class="px-4 py-3 text-sm text-slate-500"><?php echo Helper::formatDate($payment['payment_date']); ?></td>
                            <td class="px-4 py-3 text-sm text-slate-500"><?php echo $payment['client_name']; ?></td>
                            <td class="px-4 py-3 text-sm text-slate-500 uppercase"><?php echo $payment['payment_method']; ?></td>
                            <td class="px-4 py-3 text-sm font-bold text-right text-slate-900 dark:text-white"><?php echo Helper::formatCurrency($payment['amount']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
    document.getElementById('report-' + tabName).classList.remove('hidden');
    
    // Update tabs
    const tabs = ['properties', 'bookings', 'financials'];
    tabs.forEach(t => {
        const btn = document.getElementById('tab-' + t);
        if(t === tabName) {
            btn.classList.add('border-primary', 'text-primary');
            btn.classList.remove('border-transparent', 'text-slate-500');
        } else {
            btn.classList.remove('border-primary', 'text-primary');
            btn.classList.add('border-transparent', 'text-slate-500');
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
            margin-bottom: 2rem;
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
            border: 1px solid #ddd;
            padding: 8px;
        }
        .bg-white, .dark\:bg-\[\#1a1625\] {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }
    }
</style>

</div>
</div>
</body>
</html>
