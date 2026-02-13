<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../models/Booking.php';
require_once __DIR__ . '/../../../core/Helper.php';

$bookingModel = new Booking();
$bookings = $bookingModel->readAll();
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Bookings</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage property bookings and viewing requests.</p>
    </div>
    <button onclick="window.print()" class="px-4 py-2 bg-white dark:bg-[#1a1625] border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">print</span>
        Print Report
    </button>
</div>

<!-- Bookings Table -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
    <div class="overflow-x-auto custom-scrollbar flex-1 rounded-xl">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-[#1a1625] divide-y divide-slate-100 dark:divide-slate-800">
                <?php while($booking = $bookings->fetch(PDO::FETCH_ASSOC)): ?>
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                         <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $booking['property_id']; ?>" class="text-sm font-medium text-slate-900 dark:text-white hover:text-primary transition-colors">
                             <?php echo $booking['title']; ?>
                         </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $booking['client_name']; ?></span>
                            <!-- Assuming we might have email here if query selected it, otherwise just name -->
                        </div>
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
                             <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=details&id=<?php echo $booking['id']; ?>" class="text-blue-500 hover:text-blue-700 transition-colors" title="View Details">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>
                            <?php if($booking['booking_status'] === 'pending'): ?>
                            <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=confirm&id=<?php echo $booking['id']; ?>" class="text-green-500 hover:text-green-700 transition-colors" title="Confirm" onclick="return confirm('Are you sure you want to confirm this booking?');">
                                <span class="material-symbols-outlined text-lg">check_circle</span>
                            </a>
                            <?php endif; ?>
                            <!-- Cancel button removed as requested -->
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
                
                <?php if($bookings->rowCount() == 0): ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">event_busy</span>
                        <p>No bookings found.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
