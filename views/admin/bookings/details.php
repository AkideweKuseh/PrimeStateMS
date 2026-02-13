<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
// $booking is passed from the controller
?>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Booking Details</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Booking #<?php echo $booking['id']; ?></p>
    </div>
    <a href="index.php" class="px-4 py-2 bg-white dark:bg-[#1a1625] border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        Back to List
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Booking Information -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Status Card -->
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Status</p>
                    <?php 
                        $statusClass = match($booking['booking_status']) {
                            'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                            default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300'
                        };
                    ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo $statusClass; ?>">
                        <?php echo ucfirst($booking['booking_status']); ?>
                    </span>
                </div>
                <div>
                     <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Booking Date</p>
                     <p class="text-slate-900 dark:text-white font-medium"><?php echo Helper::formatDate($booking['booking_date']); ?></p>
                </div>
                <div>
                     <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Total Amount</p>
                     <p class="text-lg font-bold text-primary"><?php echo Helper::formatCurrency($booking['total_amount']); ?></p>
                </div>
            </div>
            
            <?php if($booking['booking_status'] === 'pending'): ?>
            <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=confirm&id=<?php echo $booking['id']; ?>" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-lg shadow-green-600/30 transition-all flex items-center gap-2" onclick="return confirm('Confirm this booking?');">
                    <span class="material-symbols-outlined">check_circle</span>
                    Confirm Booking
                </a>
            </div>
            <?php endif; ?>
        </div>

        <!-- Property Details -->
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Property Information</h3>
            </div>
            <div class="p-6 flex flex-col md:flex-row gap-6">
                <?php if($booking['main_image']): ?>
                <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image']; ?>" alt="<?php echo $booking['title']; ?>" class="w-full md:w-48 h-32 object-cover rounded-lg">
                <?php endif; ?>
                <div class="flex-1">
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2"><?php echo $booking['title']; ?></h4>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">
                        <span class="material-symbols-outlined align-middle text-base mr-1">location_on</span>
                        <?php echo $booking['address'] . ', ' . $booking['city']; ?>
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Listed Price</p>
                            <p class="font-medium text-slate-900 dark:text-white"><?php echo Helper::formatCurrency($booking['price']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Notes -->
        <?php if(!empty($booking['notes'])): ?>
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Notes</h3>
            <p class="text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-800 p-4 rounded-lg">
                <?php echo nl2br(htmlspecialchars($booking['notes'])); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Client Information -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-6 sticky top-6">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Client Details</h3>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xl font-bold">
                    <?php echo strtoupper(substr($booking['client_name'], 0, 1)); ?>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white"><?php echo $booking['client_name']; ?></h4>
                    <span class="text-xs px-2 py-0.5 rounded bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">Client</span>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-slate-400 mt-0.5">email</span>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Email Address</p>
                        <a href="mailto:<?php echo $booking['client_email']; ?>" class="text-sm font-medium text-slate-900 dark:text-white hover:text-primary break-all">
                            <?php echo $booking['client_email']; ?>
                        </a>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-slate-400 mt-0.5">phone</span>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Phone Number</p>
                        <a href="tel:<?php echo $booking['client_phone']; ?>" class="text-sm font-medium text-slate-900 dark:text-white hover:text-primary">
                            <?php echo $booking['client_phone']; ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                <a href="mailto:<?php echo $booking['client_email']; ?>" class="w-full px-4 py-2 bg-white border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined text-sm">mail</span>
                    Contact Client
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
