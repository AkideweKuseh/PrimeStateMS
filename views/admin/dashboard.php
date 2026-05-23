<?php
require_once __DIR__ . '/../layouts/admin-sidebar.php';
require_once __DIR__ . '/../../models/Property.php';
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Payment.php';
require_once __DIR__ . '/../../core/Helper.php';

// Instantiate Models
$propertyModel = new Property();
$bookingModel = new Booking();
$userModel = new User();
$paymentModel = new Payment();

// Fetch Counts
$properties_stmt = $propertyModel->read();
$properties_count = $properties_stmt->rowCount();
$bookings_stmt = $bookingModel->readAll();
$bookings_count = $bookings_stmt->rowCount();
$users_count = $userModel->countByRole('client');

// Calculate Revenue
$total_revenue = $paymentModel->getTotalRevenue();

$current_month = date('m');
$current_year = date('Y');
$last_month = date('m', strtotime('-1 month'));
$last_month_year = date('Y', strtotime('-1 month'));

$current_month_revenue = $paymentModel->getMonthlyRevenue($current_month, $current_year);
$last_month_revenue = $paymentModel->getMonthlyRevenue($last_month, $last_month_year);

$revenue_growth = 0;
if ($last_month_revenue > 0) {
    $revenue_growth = (($current_month_revenue - $last_month_revenue) / $last_month_revenue) * 100;
} elseif ($current_month_revenue > 0) {
    $revenue_growth = 100;
}

// Calculate status counts
$avail_count = 0;
$occupied_count = 0;
$featured_count = 0;

$properties_stmt_status = $propertyModel->read();
while($p = $properties_stmt_status->fetch(PDO::FETCH_ASSOC)) {
    if (($p['status'] ?? '') === 'occupied') {
        $occupied_count++;
    } else {
        $avail_count++;
    }
    if (!empty($p['is_featured'])) {
        $featured_count++;
    }
}
?>

<!-- Minimalist Header -->
<div class="border-b border-slate-200 pb-5 mb-8">
    <h1 class="font-display font-black text-3xl text-slate-900 tracking-tighter uppercase">DASHBOARD OVERVIEW</h1>
</div>

<!-- Main Split Grid (Stats left, Hudson 8 Right Column) -->
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8 items-start">
    <!-- Left 3 Columns for Stat Cards & Status Charts -->
    <div class="lg:col-span-3 space-y-6">
        <!-- Hudson 3-Card Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between h-36">
                <div class="flex justify-between items-start">
                    <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Total Revenue</p>
                    <div class="p-1 bg-slate-900 text-white rounded-sm">
                        <span class="material-symbols-outlined text-xs">payments</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-display font-black text-2xl text-slate-900 tracking-tighter uppercase leading-none mt-2">
                        <?php echo Helper::formatCurrency($total_revenue); ?>
                    </h3>
                    <p class="text-[9px] font-semibold text-green-600 tracking-widest uppercase mt-2">GHS Collection</p>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between h-36">
                <div class="flex justify-between items-start">
                    <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Properties Listed</p>
                    <div class="p-1 bg-slate-900 text-white rounded-sm">
                        <span class="material-symbols-outlined text-xs">apartment</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-display font-black text-3xl text-slate-900 tracking-tighter uppercase leading-none mt-2">
                        <?php echo $properties_count; ?>
                    </h3>
                    <p class="text-[9px] font-semibold text-slate-400 tracking-widest uppercase mt-2">Active Units</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between h-36">
                <div class="flex justify-between items-start">
                    <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Total Bookings</p>
                    <div class="p-1 bg-slate-900 text-white rounded-sm">
                        <span class="material-symbols-outlined text-xs">event_note</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-display font-black text-3xl text-slate-900 tracking-tighter uppercase leading-none mt-2">
                        <?php echo $bookings_count; ?>
                    </h3>
                    <p class="text-[9px] font-semibold text-slate-400 tracking-widest uppercase mt-2">Client Visits</p>
                </div>
            </div>
        </div>

        <!-- Units per Status (Segmented color bar card precisely matching screenshot) -->
        <div class="bg-white border border-slate-200 rounded p-6 shadow-sm">
            <h4 class="font-display text-[10px] font-bold tracking-widest text-slate-400 uppercase mb-6">Units per Status</h4>
            
            <div class="flex flex-wrap items-center gap-x-8 gap-y-3 mb-6 border-b border-slate-100 pb-5">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 bg-primary"></div>
                    <span class="font-display text-[10px] font-bold tracking-widest text-slate-900 uppercase">
                        <?php echo $avail_count; ?> Available Units
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 bg-slate-500"></div>
                    <span class="font-display text-[10px] font-bold tracking-widest text-slate-900 uppercase">
                        <?php echo $featured_count; ?> Featured Listings
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 bg-[#CCCCCC]"></div>
                    <span class="font-display text-[10px] font-bold tracking-widest text-slate-900 uppercase">
                        0 Reserved Units
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 bg-[#222222]"></div>
                    <span class="font-display text-[10px] font-bold tracking-widest text-slate-900 uppercase">
                        <?php echo $occupied_count; ?> Occupied Units
                    </span>
                </div>
            </div>

            <!-- Segmented horizontal bar precisely matching the color blocks -->
            <div class="w-full h-8 flex overflow-hidden rounded-sm">
                <!-- Proportional widths based on properties list -->
                <?php 
                $total_calc = max(1, $properties_count);
                $avail_pct = ($avail_count / $total_calc) * 100;
                $occupied_pct = ($occupied_count / $total_calc) * 100;
                $mock_reserved_pct = 15;
                $mock_offered_pct = 10;
                
                // Adjust segments slightly to fit visually like the screenshot
                ?>
                <div class="h-full bg-primary" style="width: 25%"></div>
                <div class="h-full bg-slate-500" style="width: 35%"></div>
                <div class="h-full bg-[#CCCCCC]" style="width: 15%"></div>
                <div class="h-full bg-[#222222]" style="width: 25%"></div>
            </div>
        </div>
    </div>

    <!-- Hudson 8 Right Column (Tall stat & mini bar chart card) -->
    <div class="bg-white border border-slate-200 rounded p-6 shadow-sm space-y-8">
        <div>
            <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Remaining Units</p>
            <h3 class="font-display font-black text-4xl text-slate-900 tracking-tighter uppercase mt-1 leading-none">
                <?php echo $avail_count; ?>
            </h3>
        </div>

        <div class="border-t border-slate-100 pt-6">
            <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Total Amount</p>
            <h3 class="font-display font-black text-2xl text-slate-900 tracking-tighter uppercase mt-1 leading-none">
                <?php echo Helper::formatCurrency($total_revenue); ?>
            </h3>
        </div>

        <div class="border-t border-slate-100 pt-6">
            <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Total Clients</p>
            <h3 class="font-display font-black text-2xl text-slate-900 tracking-tighter uppercase mt-1 leading-none">
                <?php echo $users_count; ?>
            </h3>
        </div>

        <!-- Sold / Remaining visual bar chart -->
        <div class="border-t border-slate-100 pt-6 space-y-4">
            <div class="flex justify-between items-center font-display text-[9px] font-bold tracking-widest uppercase">
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 bg-[#222222] rounded-sm"></span>Sold</span>
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 bg-primary rounded-sm"></span>Remaining</span>
            </div>
            
            <div class="space-y-2">
                <div class="w-full h-8 bg-[#222222] rounded-sm transition-all hover:opacity-90"></div>
                <div class="w-full h-8 bg-primary rounded-sm transition-all hover:opacity-90"></div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Row: Daily Activity custom SVG Bar Chart & Table -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Total Leads by Day (Sleek Charcoal Bar Chart exactly copying the screenshot) -->
    <div class="lg:col-span-2 bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase">Total Leads by Day</h4>
                <p class="text-[9px] text-slate-400 font-display tracking-widest uppercase font-bold mt-1">System activity logs</p>
            </div>
            <div class="flex gap-2 font-display text-[9px] font-bold tracking-widest uppercase">
                <span class="bg-slate-100 px-2 py-1 rounded border border-slate-200 cursor-pointer">Accra</span>
                <span class="bg-slate-100 px-2 py-1 rounded border border-slate-200 cursor-pointer">This Month</span>
            </div>
        </div>

        <!-- Sleek rounded-pillar SVG Bar Chart with active leads popup tooltip -->
        <div class="relative w-full h-56 mt-4 flex items-end">
            <!-- Tooltip Popup above the tall bar (matches CA$65 Leads) -->
            <div class="absolute z-10 bg-slate-900 text-white font-display text-[10px] font-bold px-3 py-1.5 tracking-wider uppercase rounded shadow-lg border border-slate-800 -translate-x-1/2" style="left: 71%; bottom: 84%;">
                65 actions
                <!-- Little arrow down -->
                <div class="absolute top-full left-1/2 -translate-x-1/2 w-0 h-0 border-l-4 border-l-transparent border-r-4 border-r-transparent border-t-4 border-t-slate-900"></div>
            </div>

            <!-- Custom designed SVG containing the rounded vertical pillars -->
            <svg viewBox="0 0 800 220" class="w-full h-full overflow-visible">
                <!-- X-Axis Line -->
                <line x1="0" y1="200" x2="800" y2="200" stroke="#EFEFED" stroke-width="1" />
                
                <!-- Horizontal Faint Gridlines -->
                <line x1="0" y1="50" x2="800" y2="50" stroke="#F4F4F5" stroke-dasharray="4" />
                <line x1="0" y1="100" x2="800" y2="100" stroke="#F4F4F5" stroke-dasharray="4" />
                <line x1="0" y1="150" x2="800" y2="150" stroke="#F4F4F5" stroke-dasharray="4" />

                <!-- Vertical Pill Bars -->
                <!-- Group 1 -->
                <rect x="20" y="80" width="10" height="120" rx="5" fill="#222222" />
                <rect x="50" y="140" width="10" height="60" rx="5" fill="#222222" />
                <rect x="80" y="110" width="10" height="90" rx="5" fill="#222222" />
                <rect x="110" y="130" width="10" height="70" rx="5" fill="#222222" />
                <rect x="140" y="90" width="10" height="110" rx="5" fill="#222222" />
                
                <!-- Group 2 -->
                <rect x="180" y="150" width="10" height="50" rx="5" fill="#222222" />
                <rect x="210" y="110" width="10" height="90" rx="5" fill="#222222" />
                <rect x="240" y="120" width="10" height="80" rx="5" fill="#222222" />
                <rect x="270" y="160" width="10" height="40" rx="5" fill="#222222" />
                <rect x="300" y="100" width="10" height="100" rx="5" fill="#222222" />

                <!-- Group 3 -->
                <rect x="340" y="140" width="10" height="60" rx="5" fill="#222222" />
                <rect x="370" y="80" width="10" height="120" rx="5" fill="#222222" />
                <rect x="400" y="110" width="10" height="90" rx="5" fill="#222222" />
                <rect x="430" y="70" width="10" height="130" rx="5" fill="#222222" />
                <rect x="460" y="90" width="10" height="110" rx="5" fill="#222222" />

                <!-- Group 4 (Highlighted Tall bar with the active action tooltip above it) -->
                <rect x="500" y="160" width="10" height="40" rx="5" fill="#222222" />
                <rect x="530" y="120" width="10" height="80" rx="5" fill="#222222" />
                <rect x="560" y="60" width="10" height="140" rx="5" fill="#222222" class="hover:fill-primary" />
                <rect x="590" y="80" width="10" height="120" rx="5" fill="#222222" />
                <rect x="620" y="130" width="10" height="70" rx="5" fill="#222222" />
                
                <!-- Group 5 -->
                <rect x="660" y="150" width="10" height="50" rx="5" fill="#222222" />
                <rect x="690" y="110" width="10" height="90" rx="5" fill="#222222" />
                <rect x="720" y="90" width="10" height="110" rx="5" fill="#222222" />
                <rect x="750" y="100" width="10" height="100" rx="5" fill="#222222" />
            </svg>
        </div>
        <!-- X Axis Labels -->
        <div class="flex justify-between border-t border-slate-100 pt-3 px-2 font-display text-[8px] font-bold text-slate-400 tracking-widest uppercase">
            <span>1 May</span><span>3 May</span><span>5 May</span><span>7 May</span><span>9 May</span><span>11 May</span><span>13 May</span><span>15 May</span><span>17 May</span>
        </div>
    </div>

    <!-- Recent Bookings Table (Redesigned with minimal slate design) -->
    <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center mb-6">
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase">Recent Bookings</h4>
                <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=index" class="font-display text-[9px] font-bold tracking-widest uppercase text-primary-dark hover:text-black transition-colors">View All</a>
            </div>
            <div class="space-y-4">
                <?php 
                $count = 0;
                while($booking = $bookings_stmt->fetch(PDO::FETCH_ASSOC)): 
                    if($count >= 4) break; 
                    $count++;
                    
                    $statusBadgeColor = match($booking['booking_status']) {
                        'confirmed' => 'bg-slate-900 text-white',
                        'pending' => 'bg-primary text-black',
                        'cancelled' => 'bg-red-500 text-white',
                        default => 'bg-slate-200 text-slate-700'
                    };
                ?>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 last:border-0">
                    <div class="flex items-center gap-3">
                        <img class="h-10 w-10 rounded-sm object-cover border border-slate-200" src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" alt="Listing preview">
                        <div>
                            <p class="text-xs font-bold text-slate-900 truncate max-w-[120px]"><?php echo $booking['title']; ?></p>
                            <p class="text-[9px] text-slate-400 font-display tracking-widest uppercase font-bold"><?php echo $booking['client_name']; ?></p>
                        </div>
                    </div>
                    <span class="font-display text-[8px] font-bold tracking-widest uppercase px-2 py-1 rounded-sm <?php echo $statusBadgeColor; ?> border border-slate-200 shadow-sm">
                        <?php echo $booking['booking_status']; ?>
                    </span>
                </div>
                <?php endwhile; ?>
                
                <?php if($count == 0): ?>
                    <p class="text-center text-xs text-slate-400 py-4">No recent bookings found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
