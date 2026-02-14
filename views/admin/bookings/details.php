<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../core/Helper.php';

// $booking is available from controller
?>

<!-- Back Button -->
<div class="mb-6">
    <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=index" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Back to Bookings
    </a>
</div>

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Booking #<?php echo $booking['id']; ?></h1>
                <?php 
                    $statusClass = match($booking['booking_status']) {
                        'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                        default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300'
                    };
                ?>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusClass; ?>">
                    <?php echo ucfirst($booking['booking_status']); ?>
                </span>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400">Created on <?php echo Helper::formatDate($booking['created_at']); ?></p>
        </div>
        
        <div class="flex gap-2">
            <?php if($booking['booking_status'] === 'pending'): ?>
            <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=confirm&id=<?php echo $booking['id']; ?>" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors shadow-lg shadow-green-600/20 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">check_circle</span>
                Confirm
            </a>
            <a href="#" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors shadow-lg shadow-red-600/20 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">cancel</span>
                Cancel
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Property Details -->
            <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">apartment</span>
                        Property Details
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" alt="Property" class="w-24 h-24 rounded-lg object-cover bg-slate-100">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1"><?php echo $booking['title']; ?></h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-2"><?php echo $booking['address'] . ', ' . $booking['city']; ?></p>
                            <p class="text-primary font-bold"><?php echo Helper::formatCurrency($booking['price']); ?> <span class="text-slate-400 text-sm font-normal">/ night</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Info -->
            <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">person</span>
                        Client Information
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Full Name</label>
                        <p class="text-slate-900 dark:text-white font-medium"><?php echo $booking['client_name']; ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Email Address</label>
                        <p class="text-slate-900 dark:text-white font-medium"><?php echo $booking['client_email']; ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Phone Number</label>
                        <p class="text-slate-900 dark:text-white font-medium"><?php echo $booking['client_phone']; ?></p>
                    </div>
                </div>
            </div>
             
             <!-- Payment / Booking Notes -->
             <?php if(!empty($booking['notes'])): ?>
             <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">notes</span>
                        Notes
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-slate-600 dark:text-slate-300 text-sm"><?php echo nl2br(htmlspecialchars($booking['notes'])); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Booking Summary -->
            <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Booking Summary</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Check-in</span>
                        <span class="font-medium text-slate-900 dark:text-white"><?php echo Helper::formatDate($booking['start_date']); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Check-out</span>
                        <span class="font-medium text-slate-900 dark:text-white"><?php echo Helper::formatDate($booking['end_date']); ?></span>
                    </div>
                    <div class="border-t border-slate-100 dark:border-slate-800 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-slate-900 dark:text-white">Total Amount</span>
                            <span class="text-xl font-bold text-primary"><?php echo Helper::formatCurrency($booking['total_amount']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
