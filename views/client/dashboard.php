<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../models/Property.php'; // For recommended properties
require_once __DIR__ . '/../../models/SavedProperty.php';
require_once __DIR__ . '/../../models/Payment.php';

$bookingModel = new Booking();
$propertyModel = new Property();
$savedPropertyModel = new SavedProperty();
$paymentModel = new Payment();

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

<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Welcome back, <?php echo explode(' ', $_SESSION['user_name'])[0]; ?>! 👋</h1>
        <p class="mt-2 text-slate-500 dark:text-slate-400">Here's what's happening with your properties today.</p>
    </div>
    <div class="mt-4 md:mt-0 text-sm text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-800 px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-base">calendar_today</span>
        <span id="currentDate"><?php echo date('F d, Y'); ?></span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Stats & Activity -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Active Bookings Card -->
            <a href="<?php echo BASE_URL; ?>views/client/bookings.php" class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between group hover:border-primary/30 transition-colors cursor-pointer">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Bookings</p>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1"><?php echo $activeBookingsCount; ?></p>
                    <p class="text-xs text-green-600 mt-2 flex items-center font-medium">
                        <span class="material-symbols-outlined text-sm mr-1">trending_up</span> +1 this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors">
                    <span class="material-symbols-outlined text-primary text-2xl group-hover:text-white transition-colors">vpn_key</span>
                </div>
            </a>
            <!-- Total Payments Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between group hover:border-primary/30 transition-colors">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Payments</p>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1"><?php echo Helper::formatCurrency($totalPayments); ?></p>
                    <p class="text-xs text-slate-400 mt-2">Lifetime total</p>
                </div>
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors">
                    <span class="material-symbols-outlined text-primary text-2xl group-hover:text-white transition-colors">account_balance_wallet</span>
                </div>
            </div>
        </div>

        <!-- Recommended Properties Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Recommended for You</h2>
                <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="text-sm font-medium text-primary hover:text-primary/80 flex items-center">
                    View all <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Property Cards -->
                <?php foreach($recommendedProps as $prop): ?>
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow border border-slate-100 dark:border-slate-700 group relative">
                    <!-- Overlay Link -->
                    <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $prop['id']; ?>" class="absolute inset-0 z-10">
                        <span class="sr-only">View Details for <?php echo $prop['title']; ?></span>
                    </a>

                    <div class="relative h-48">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $prop['main_image'] ?? 'default.jpg'; ?>" 
                             alt="<?php echo $prop['title']; ?>"
                             onerror="this.src='https://via.placeholder.com/600x400?text=Property'">
                        <div class="absolute top-3 left-3 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-1.5 py-0.5 rounded text-[10px] font-bold text-slate-900 dark:text-white uppercase tracking-wide">
                            <?php echo $prop['listing_type']; ?>
                        </div>
                        <?php 
                        $isSaved = in_array($prop['id'], $savedPropertyIds); 
                        ?>
                        <form action="<?php echo BASE_URL; ?>controllers/SavedPropertyController.php?action=toggle" method="POST" class="absolute top-3 right-3 z-20">
                            <input type="hidden" name="property_id" value="<?php echo $prop['id']; ?>">
                            <button type="submit" class="p-1.5 bg-white/50 hover:bg-white rounded-full transition-colors <?php echo $isSaved ? 'text-red-500' : 'text-slate-700'; ?> shadow-sm" title="<?php echo $isSaved ? 'Remove from Saved' : 'Save Property'; ?>">
                                <span class="material-symbols-outlined text-sm"><?php echo $isSaved ? 'favorite' : 'favorite_border'; ?></span>
                            </button>
                        </form>
                    </div>
                    <div class="p-4">
                        <div class="mb-2">
                            <div class="block w-full mb-1">
                                <h3 class="font-medium text-slate-900 dark:text-white text-sm leading-tight group-hover:text-primary transition-colors" title="<?php echo htmlspecialchars($prop['title']); ?>">
                                    <?php echo $prop['title']; ?>
                                </h3>
                            </div>
                            <div class="text-primary font-bold text-sm"><?php echo Helper::formatCurrency($prop['price']); ?></div>
                        </div>
                        <p class="text-slate-500 text-xs mb-3 flex items-center">
                            <span class="material-symbols-outlined text-sm mr-1 text-slate-400">location_on</span> <?php echo $prop['city']; ?>
                        </p>
                        <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400 border-t border-slate-100 dark:border-slate-700 pt-3">
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">bed</span> <?php echo $prop['bedrooms']; ?> Beds</span>
                            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">shower</span> <?php echo $prop['bathrooms']; ?> Baths</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Right Column: Recent Activity (Mocked for now) -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-100 dark:border-slate-700 h-full flex flex-col">
            <div class="p-6 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Recent Activity</h2>
                <button class="text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">more_horiz</span>
                </button>
            </div>
            <div class="p-6 space-y-6 flex-1 overflow-y-auto max-h-[600px]">
                <!-- Item 1 -->
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-sm text-green-600 dark:text-green-400">check_circle</span>
                        </div>
                        <div class="w-px h-full bg-slate-200 dark:bg-slate-700 my-2"></div>
                    </div>
                    <div class="pb-6">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Account Created</p>
                        <p class="text-xs text-slate-500 mt-1">Welcome to Prime Estate!</p>
                        <p class="text-[10px] text-slate-400 mt-2 font-medium uppercase tracking-wide">Just now</p>
                    </div>
                </div>
                
                <?php if($activeBookingsCount > 0): ?>
                <div class="flex gap-4">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-sm text-orange-600 dark:text-orange-400">schedule</span>
                        </div>
                        <div class="w-px h-full bg-slate-200 dark:bg-slate-700 my-2"></div>
                    </div>
                     <div class="pb-6">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Booking Request</p>
                        <p class="text-xs text-slate-500 mt-1">You have requested a booking/viewing.</p>
                        <p class="text-[10px] text-slate-400 mt-2 font-medium uppercase tracking-wide">Recently</p>
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <div class="p-4 border-t border-slate-100 dark:border-slate-700">
                <a href="<?php echo BASE_URL; ?>views/client/bookings.php" class="block w-full py-2 text-sm text-center text-primary font-medium hover:bg-primary/5 rounded-lg transition-colors">
                    View Full History
                </a>
            </div>
        </div>
    </div>
</div>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
