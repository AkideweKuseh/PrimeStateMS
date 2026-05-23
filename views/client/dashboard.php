<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../models/Property.php'; // For recommended properties
require_once __DIR__ . '/../../models/SavedProperty.php';
require_once __DIR__ . '/../../models/Payment.php';
require_once __DIR__ . '/../../models/Activity.php';

$bookingModel = new Booking();
$propertyModel = new Property();
$savedPropertyModel = new SavedProperty();
$paymentModel = new Payment();
$activityModel = new Activity();

$savedPropertyIds = $savedPropertyModel->getSavedPropertyIds($_SESSION['user_id']);

// Fetch Client Bookings
$myBookingsStmt = $bookingModel->readByClient($_SESSION['user_id']);
$allBookings = $myBookingsStmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate Active Bookings (Confirmed or Pending)
$activeBookingsCount = 0;
foreach($allBookings as $b) {
    if($b['booking_status'] == 'confirmed' || $b['booking_status'] == 'pending') {
        $activeBookingsCount++;
    }
}

// Calculate Total Payments
$totalPayments = $paymentModel->getTotalPaymentsByUser($_SESSION['user_id']);

// Fetch Recommended Properties (Just fetch recent 3 for now)
$recommendedProps = $propertyModel->read()->fetchAll(PDO::FETCH_ASSOC); // Fetch all then slice
$recommendedProps = array_slice($recommendedProps, 0, 3);
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">WELCOME BACK, <?php echo strtoupper(explode(' ', $_SESSION['user_name'])[0]); ?>! 👋</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Here is the active summary of your booked viewings, payments, and catalog recommendations.</p>
    </div>
    <div class="flex items-center gap-2 border border-slate-205 dark:border-white/10 bg-white dark:bg-[#151517] px-4 py-2 text-xs font-mono text-slate-500 rounded-none shrink-0 uppercase tracking-widest">
        <span class="material-symbols-outlined text-primary text-sm font-bold">calendar_today</span>
        <span><?php echo date('d M Y'); ?></span>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative z-10">
        <!-- Left Column: Stats & Activity -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Active Bookings Card -->
                <a href="<?php echo BASE_URL; ?>views/client/bookings.php" 
                   class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none flex items-center justify-between group hover:border-slate-950 dark:hover:border-white transition-all duration-300">
                    <div>
                        <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-450 dark:text-slate-500">Active Bookings</p>
                        <p class="font-mono font-bold text-3xl text-slate-900 dark:text-white mt-2 leading-none"><?php echo $activeBookingsCount; ?></p>
                        <p class="text-[9px] font-bold text-green-600 dark:text-green-400 mt-4 flex items-center uppercase tracking-wider">
                            <span class="material-symbols-outlined text-[10px] font-bold mr-1">trending_up</span> Scheduled Viewings
                        </p>
                    </div>
                    <div class="w-11 h-11 border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center group-hover:bg-primary group-hover:text-black transition-colors rounded-none">
                        <span class="material-symbols-outlined text-xl leading-none">vpn_key</span>
                    </div>
                </a>
                
                <!-- Total Payments Card -->
                <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 rounded-none flex items-center justify-between group hover:border-slate-950 dark:hover:border-white transition-all duration-300">
                    <div>
                        <p class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-450 dark:text-slate-500">Total Spendings</p>
                        <p class="font-mono font-bold text-2xl text-slate-900 dark:text-white mt-2 leading-none"><?php echo Helper::formatCurrency($totalPayments); ?></p>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-4">Lifetime transactions</p>
                    </div>
                    <div class="w-11 h-11 border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center group-hover:bg-primary group-hover:text-black transition-colors rounded-none">
                        <span class="material-symbols-outlined text-xl leading-none">account_balance_wallet</span>
                    </div>
                </div>
            </div>

            <!-- Recommended Properties Section -->
            <div class="space-y-5">
                <div class="flex items-center justify-between">
                    <h2 class="font-display font-black text-lg text-slate-900 dark:text-white uppercase tracking-tight">RECOMMENDED ASSETS</h2>
                    <a href="<?php echo BASE_URL; ?>views/public/properties.php" 
                       class="font-display text-[9px] font-bold tracking-widest uppercase text-primary hover:text-[#d9c441] transition-colors flex items-center gap-1">
                        View All Listings
                        <span class="material-symbols-outlined text-[10px]">arrow_forward</span>
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Property Cards -->
                    <?php foreach($recommendedProps as $prop): ?>
                    <div class="group bg-white dark:bg-[#151517] rounded-none overflow-hidden border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white hover:shadow-2xl transition-all duration-500 flex flex-col relative">
                        <!-- Overlay Link -->
                        <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $prop['id']; ?>" class="absolute inset-0 z-10">
                            <span class="sr-only">View details of <?php echo htmlspecialchars($prop['title']); ?></span>
                        </a>

                        <div class="relative h-44 overflow-hidden bg-slate-900">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100" 
                                 src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $prop['main_image'] ?? 'default.jpg'; ?>" 
                                 alt="<?php echo $prop['title']; ?>"
                                 onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=300&q=80'">
                            
                            <span class="absolute top-3 left-3 bg-slate-900 text-white font-display text-[8px] font-bold tracking-widest px-2 py-1 uppercase rounded-none border border-white/10 z-20 shadow-sm">
                                FOR <?php echo strtoupper($prop['listing_type']); ?>
                            </span>
                            
                            <?php 
                            $isSaved = in_array($prop['id'], $savedPropertyIds); 
                            ?>
                            <form action="<?php echo BASE_URL; ?>controllers/SavedPropertyController.php?action=toggle" method="POST" class="absolute top-3 right-3 z-20">
                                <input type="hidden" name="property_id" value="<?php echo $prop['id']; ?>">
                                <button type="submit" 
                                        class="p-1.5 bg-slate-900/80 hover:bg-slate-900 border border-white/10 text-white hover:text-red-500 rounded-none transition-colors shadow-sm" 
                                        title="<?php echo $isSaved ? 'Remove from Saved' : 'Save Property'; ?>">
                                    <span class="material-symbols-outlined text-xs leading-none font-bold"><?php echo $isSaved ? 'favorite' : 'favorite_border'; ?></span>
                                </button>
                            </form>
                        </div>
                        
                        <div class="p-4 flex-1 flex flex-col justify-between border-t border-slate-100 dark:border-white/5">
                            <div>
                                <h4 class="font-display font-bold text-slate-900 dark:text-white text-xs mb-1.5 uppercase tracking-wide truncate group-hover:text-primary transition-colors">
                                    <?php echo $prop['title']; ?>
                                </h4>
                                <p class="text-primary font-mono font-bold text-xs mb-3">
                                    <?php echo Helper::formatCurrency($prop['price']); ?>
                                </p>
                                <p class="text-slate-400 dark:text-slate-500 font-display text-[8px] font-bold tracking-widest uppercase flex items-center gap-1 mb-4">
                                    <span class="material-symbols-outlined text-slate-400 text-[10px]">location_on</span>
                                    <?php echo $prop['city']; ?>
                                </p>
                            </div>
                            
                            <div class="border-t border-slate-100 dark:border-white/5 pt-3 flex justify-between text-slate-500 dark:text-slate-400 font-display text-[8px] font-bold tracking-widest uppercase">
                                <span><?php echo $prop['bedrooms']; ?> Beds</span>
                                <span><?php echo $prop['bathrooms']; ?> Baths</span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Column: Recent Activity -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 h-full flex flex-col">
                <div class="p-5 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30 flex justify-between items-center">
                    <h2 class="font-display font-black text-xs text-slate-900 dark:text-white uppercase tracking-wider">Recent Activity</h2>
                    <a href="<?php echo BASE_URL; ?>views/client/activity.php" 
                       class="text-slate-400 hover:text-primary transition-colors" 
                       title="View All History">
                        <span class="material-symbols-outlined">more_horiz</span>
                    </a>
                </div>
                
                <div class="p-6 space-y-6 flex-1 overflow-y-auto max-h-[600px] custom-scrollbar">
                    <?php 
                    $recentActivities = $activityModel->getRecent($_SESSION['user_id'], 5);
                    if ($recentActivities->rowCount() > 0):
                        while ($activity = $recentActivities->fetch(PDO::FETCH_ASSOC)):
                            $icon = 'info';
                            $iconColor = 'text-blue-500';
                            
                            if ($activity['type'] == 'booking') {
                                $icon = 'schedule';
                                $iconColor = 'text-orange-500';
                            } elseif ($activity['type'] == 'payment') {
                                $icon = 'payments';
                                $iconColor = 'text-green-500';
                            } elseif ($activity['type'] == 'auth') {
                                $icon = 'lock';
                                $iconColor = 'text-slate-405';
                            }
                    ?>
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center shrink-0 rounded-none">
                                <span class="material-symbols-outlined text-sm <?php echo $iconColor; ?>"><?php echo $icon; ?></span>
                            </div>
                            <div class="w-px h-full bg-slate-200 dark:bg-white/5 my-2"></div>
                        </div>
                        <div class="pb-2">
                            <p class="text-[10px] font-display font-black tracking-widest uppercase text-slate-900 dark:text-white leading-none mb-1.5"><?php echo $activity['type']; ?></p>
                            <p class="text-xs text-slate-650 dark:text-slate-350 uppercase tracking-wide leading-relaxed"><?php echo $activity['message']; ?></p>
                            <p class="text-[9px] font-mono text-slate-400 mt-2"><?php echo Helper::timeAgo($activity['created_at']); ?></p>
                        </div>
                    </div>
                    <?php 
                        endwhile;
                    else: 
                    ?>
                    <div class="text-center py-16 text-slate-500">
                        <p class="font-display text-[9px] font-bold tracking-widest uppercase">No recent activity logs.</p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="p-4 border-t border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/20">
                    <a href="<?php echo BASE_URL; ?>views/client/activity.php" 
                       class="block w-full py-2.5 border border-slate-950 dark:border-white text-center text-slate-950 dark:text-white font-display text-[9px] font-bold tracking-widest uppercase rounded-none transition duration-300 hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-black">
                        View Full History
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
