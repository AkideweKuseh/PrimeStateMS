<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../core/Helper.php';

$bookingModel = new Booking();
$myBookings = $bookingModel->readByClient(Auth::id());
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">My Bookings</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage your property visits and rental agreements.</p>
    </div>
</div>

<!-- Bookings Table -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
    <div class="overflow-x-auto custom-scrollbar flex-1 rounded-xl">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-[#1a1625] divide-y divide-slate-100 dark:divide-slate-800">
                <?php 
                if($myBookings->rowCount() > 0):
                    while($booking = $myBookings->fetch(PDO::FETCH_ASSOC)): 
                ?>
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-lg object-cover" src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" alt="">
                            </div>
                            <div class="ml-4">
                                <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $booking['property_id']; ?>" class="text-sm font-medium text-slate-900 dark:text-white hover:text-primary transition-colors">
                                    <?php echo $booking['title']; ?>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                        <?php echo $booking['city']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                        <?php echo Helper::formatDate($booking['booking_date']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
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
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                        <?php echo Helper::formatCurrency($booking['total_amount']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $booking['property_id']; ?>" class="text-blue-500 hover:text-blue-700 transition-colors" title="View Property">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>

                            <?php if($booking['booking_status'] === 'pending'): ?>
                            <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=payment&booking_id=<?php echo $booking['id']; ?>" class="inline-flex items-center justify-center p-2 text-green-600 hover:text-green-800 hover:bg-green-50 rounded-full transition-colors" title="Pay Now">
                                <span class="material-symbols-outlined text-lg">credit_card</span>
                            </a>
                            <?php endif; ?>
                            
                            <?php if($booking['booking_status'] !== 'confirmed'): ?>
                            <form action="<?php echo BASE_URL; ?>controllers/BookingController.php?action=delete" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this booking? This action cannot be undone.');">
                                <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Delete Booking">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </form>
                            <?php else: ?>
                            <button disabled class="text-slate-300 cursor-not-allowed" title="Cannot delete confirmed booking">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else:
                ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-500">
                            <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">event_busy</span>
                            <p class="mb-4">You haven't made any bookings yet.</p>
                            <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition">
                                Browse Properties
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
