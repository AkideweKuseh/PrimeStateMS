<?php
require_once __DIR__ . '/../layouts/admin-sidebar.php';
require_once __DIR__ . '/../../models/Property.php';
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../models/User.php';

// Instantiate Models
$propertyModel = new Property();
$bookingModel = new Booking();
$userModel = new User();

// Fetch Counts (Simple implementation for now)
$properties_count = $propertyModel->read()->rowCount();
$bookings_stmt = $bookingModel->readAll();
$bookings_count = $bookings_stmt->rowCount();
$users_count = $userModel->readAll()->rowCount();

// Fetch Recent Bookings for the table
// Note: $bookings_stmt is already executed, but we need to reset/re-fetch or use fetchAll if we iterate twice.
// Since rowCount() doesn't move the pointer, we can just fetch.
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Dashboard Overview</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Welcome back, here's what's happening today.</p>
    </div>
    <div class="flex gap-3">
        <button class="px-4 py-2 bg-white dark:bg-[#1a1625] border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 transition">
            <span class="flex items-center gap-2">
                <span class="material-symbols-outlined text-base">file_download</span>
                Export
            </span>
        </button>
        <a href="<?php echo BASE_URL; ?>views/admin/properties/create.php" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition flex items-center gap-2">
            <span class="material-symbols-outlined text-base">add</span>
            Add Property
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white dark:bg-[#1a1625] rounded-xl p-5 shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden group">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Properties</p>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1"><?php echo $properties_count; ?></h3>
            </div>
            <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-600 dark:text-blue-400">
                <span class="material-symbols-outlined text-xl">apartment</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <span class="flex items-center text-xs font-semibold text-green-600 bg-green-50 dark:bg-green-900/20 px-1.5 py-0.5 rounded">
                <span class="material-symbols-outlined text-xs mr-0.5">trending_up</span> 4%
            </span>
            <span class="text-xs text-slate-400">vs last month</span>
        </div>
        <div class="absolute bottom-0 right-0 opacity-10 text-primary transform translate-y-1 translate-x-2">
            <svg fill="none" height="40" viewBox="0 0 100 40" width="100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 30L20 25L40 32L60 15L80 20L100 5" fill="none" stroke="currentColor" stroke-width="3"></path>
            </svg>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="bg-white dark:bg-[#1a1625] rounded-xl p-5 shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Bookings</p>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1"><?php echo $bookings_count; ?></h3>
            </div>
            <div class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600 dark:text-purple-400">
                <span class="material-symbols-outlined text-xl">event_available</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
             <span class="flex items-center text-xs font-semibold text-green-600 bg-green-50 dark:bg-green-900/20 px-1.5 py-0.5 rounded">
                <span class="material-symbols-outlined text-xs mr-0.5">trending_up</span> 12%
            </span>
            <span class="text-xs text-slate-400">vs last month</span>
        </div>
         <div class="absolute bottom-0 right-0 opacity-10 text-purple-600 transform translate-y-1 translate-x-2">
            <svg fill="none" height="40" viewBox="0 0 100 40" width="100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 35L25 20L50 25L75 10L100 5" fill="none" stroke="currentColor" stroke-width="3"></path>
            </svg>
        </div>
    </div>
    
    <!-- Stat Card 3 -->
    <div class="bg-white dark:bg-[#1a1625] rounded-xl p-5 shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Revenue</p>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">GHS 450k</h3>
            </div>
            <div class="p-2 bg-primary/10 rounded-lg text-primary">
                <span class="material-symbols-outlined text-xl">account_balance_wallet</span>
            </div>
        </div>
         <div class="flex items-center gap-2">
            <span class="flex items-center text-xs font-semibold text-green-600 bg-green-50 dark:bg-green-900/20 px-1.5 py-0.5 rounded">
                <span class="material-symbols-outlined text-xs mr-0.5">trending_up</span> 8.2%
            </span>
            <span class="text-xs text-slate-400">vs last month</span>
        </div>
        <div class="absolute bottom-0 right-0 opacity-10 text-primary transform translate-y-1 translate-x-2">
             <svg fill="none" height="40" viewBox="0 0 100 40" width="100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 38L20 30L40 32L60 18L80 22L100 2" fill="none" stroke="currentColor" stroke-width="3"></path>
            </svg>
        </div>
    </div>
    
    <!-- Stat Card 4 -->
    <div class="bg-white dark:bg-[#1a1625] rounded-xl p-5 shadow-sm border border-slate-100 dark:border-slate-800 relative overflow-hidden">
        <div class="flex justify-between items-start mb-4">
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Clients</p>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1"><?php echo $users_count; ?></h3>
            </div>
            <div class="p-2 bg-orange-50 dark:bg-orange-900/20 rounded-lg text-orange-600 dark:text-orange-400">
                <span class="material-symbols-outlined text-xl">people</span>
            </div>
        </div>
        <div class="flex items-center gap-2">
             <span class="flex items-center text-xs font-semibold text-red-600 bg-red-50 dark:bg-red-900/20 px-1.5 py-0.5 rounded">
                <span class="material-symbols-outlined text-xs mr-0.5">trending_down</span> 2%
            </span>
            <span class="text-xs text-slate-400">vs last month</span>
        </div>
        <div class="absolute bottom-0 right-0 opacity-10 text-orange-600 transform translate-y-1 translate-x-2">
             <svg fill="none" height="40" viewBox="0 0 100 40" width="100" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 20L25 15L50 25L75 30L100 35" fill="none" stroke="currentColor" stroke-width="3"></path>
            </svg>
        </div>
    </div>
</div>

<!-- Main Content Split -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left: Revenue Overview Chart -->
    <div class="lg:col-span-2 bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800/50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Revenue Overview</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Monthly income from rentals and sales</p>
            </div>
            <select class="text-sm border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 rounded-lg focus:ring-primary focus:border-primary text-slate-600 dark:text-slate-300 py-1 pl-3 pr-8">
                <option>This Year</option>
                <option>Last Year</option>
            </select>
        </div>
        <div class="p-6 flex-1 min-h-[300px] flex items-end justify-between gap-2 relative">
             <!-- Background Grid Lines -->
            <div class="absolute inset-0 px-6 py-6 flex flex-col justify-between pointer-events-none z-0">
                <div class="w-full h-px bg-slate-100 dark:bg-slate-800 border-dashed"></div>
                <div class="w-full h-px bg-slate-100 dark:bg-slate-800 border-dashed"></div>
                <div class="w-full h-px bg-slate-100 dark:bg-slate-800 border-dashed"></div>
                <div class="w-full h-px bg-slate-100 dark:bg-slate-800 border-dashed"></div>
                <div class="w-full h-px bg-slate-100 dark:bg-slate-800 border-dashed"></div>
            </div>
            <!-- Chart Placeholder (SVG) -->
            <div class="absolute inset-x-6 bottom-6 top-10 flex items-end justify-between z-10">
                <div class="relative w-full h-full">
                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 800 250">
                        <defs>
                            <linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="#4913ec" stop-opacity="0.2"></stop>
                                <stop offset="100%" stop-color="#4913ec" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                        <path d="M0,200 C50,180 100,210 150,150 C200,90 250,120 300,100 C350,80 400,110 450,70 C500,30 550,60 600,40 C650,20 700,50 750,30 L800,10 L800,250 L0,250 Z" fill="url(#chartGradient)"></path>
                        <path d="M0,200 C50,180 100,210 150,150 C200,90 250,120 300,100 C350,80 400,110 450,70 C500,30 550,60 600,40 C650,20 700,50 750,30 L800,10" fill="none" stroke="#4913ec" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"></path>
                         <circle cx="150" cy="150" fill="#fff" r="4" stroke="#4913ec" stroke-width="2"></circle>
                        <circle cx="300" cy="100" fill="#fff" r="4" stroke="#4913ec" stroke-width="2"></circle>
                        <circle cx="600" cy="40" fill="#fff" r="4" stroke="#4913ec" stroke-width="2"></circle>
                    </svg>
                </div>
            </div>
            <!-- X-Axis Labels -->
            <div class="w-full flex justify-between text-xs text-slate-400 mt-2 z-20 absolute bottom-0 left-0 px-6">
                <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span><span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span>
            </div>
        </div>
    </div>

    <!-- Right: Recent Bookings Table -->
    <div class="lg:col-span-1 bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
        <div class="p-6 border-b border-slate-100 dark:border-slate-800/50 flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Recent Bookings</h3>
            <a href="<?php echo BASE_URL; ?>views/admin/bookings/index.php" class="text-sm font-medium text-primary hover:text-primary-light">View All</a>
        </div>
        <div class="overflow-x-auto custom-scrollbar flex-1">
            <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property/Client</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#1a1625] divide-y divide-slate-100 dark:divide-slate-800">
                    <?php 
                    // Fetch top 5 bookings
                    $count = 0;
                    while($booking = $bookings_stmt->fetch(PDO::FETCH_ASSOC)): 
                        if($count >= 5) break; 
                        $count++;
                        
                        $statusColor = match($booking['payment_status']) {
                            'paid' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
                            'failed', 'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                            default => 'bg-slate-100 text-slate-800'
                        };
                    ?>
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-lg object-cover" src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" alt="">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $booking['title']; ?></div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400"><?php echo $booking['client_name']; ?> • <?php echo date('M d', strtotime($booking['created_at'])); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusColor; ?>">
                                <?php echo ucfirst($booking['payment_status']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    
                    <?php if($count == 0): ?>
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-sm text-slate-500">No bookings found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
