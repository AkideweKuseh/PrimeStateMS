<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../core/Helper.php';
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Bookings</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage all property bookings and reservations.</p>
    </div>
</div>

<!-- Filters -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 p-4 mb-6">
    <form method="GET" class="flex flex-wrap gap-4 items-end">
        <input type="hidden" name="action" value="index">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider">Status</label>
            <select name="status" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
                <option value="">All Statuses</option>
                <option value="pending" <?php echo ($filters['status'] ?? '') === 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="confirmed" <?php echo ($filters['status'] ?? '') === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                <option value="cancelled" <?php echo ($filters['status'] ?? '') === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider">Start Date</label>
            <input type="date" name="start_date" value="<?php echo $filters['start_date'] ?? ''; ?>" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider">End Date</label>
            <input type="date" name="end_date" value="<?php echo $filters['end_date'] ?? ''; ?>" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary dark:text-white">
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-primary-dark transition-colors shadow-sm shadow-primary/20">
                Filter
            </button>
            <?php if(!empty($filters['status']) || !empty($filters['start_date'])): ?>
            <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=index" class="ml-2 px-4 py-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-medium transition-colors">
                Clear
            </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Bookings Table -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
    <div class="overflow-x-auto custom-scrollbar flex-1 rounded-xl">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Booking Info</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Dates</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-[#1a1625] divide-y divide-slate-100 dark:divide-slate-800">
                <?php 
                if($bookings->rowCount() > 0):
                    while($booking = $bookings->fetch(PDO::FETCH_ASSOC)): 
                ?>
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-mono text-slate-500">#<?php echo $booking['id']; ?></span>
                        <div class="text-xs text-slate-400 mt-0.5">
                            <?php echo Helper::formatDate($booking['created_at']); ?>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="block text-sm font-medium text-slate-900 dark:text-white truncate max-w-[150px]" title="<?php echo $booking['title']; ?>">
                            <?php echo $booking['title']; ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $booking['client_name']; ?></span>
                            <span class="text-xs text-slate-500"><?php echo $booking['client_email']; ?></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                         <div><?php echo Helper::formatDate($booking['start_date']); ?></div>
                         <div class="text-xs text-slate-400">to <?php echo Helper::formatDate($booking['end_date']); ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                        <?php echo Helper::formatCurrency($booking['total_amount']); ?>
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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=details&id=<?php echo $booking['id']; ?>" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-colors" title="View Details">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </a>
                            
                            <?php if($booking['booking_status'] === 'pending'): ?>
                            <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=confirm&id=<?php echo $booking['id']; ?>" class="p-1 text-green-600 hover:text-green-800 hover:bg-green-50 rounded transition-colors" title="Confirm Booking" onclick="return confirm('Confirm this booking?')">
                                <span class="material-symbols-outlined text-lg">check_circle</span>
                            </a>
                            <a href="#" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors" title="Cancel Booking" onclick="return confirm('Cancel this booking?')">
                                <span class="material-symbols-outlined text-lg">cancel</span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else:
                ?>
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-500">
                            <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">event_busy</span>
                            <p class="mb-4">No bookings found matching your filters.</p>
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
