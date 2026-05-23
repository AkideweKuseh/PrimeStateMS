<?php 
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../core/Helper.php';

// Safe Redirect if accessed directly without Controller data
if (!isset($bookings)) {
    header("Location: " . BASE_URL . "controllers/BookingController.php?action=index");
    exit;
}

require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">BOOKINGS & RESERVATIONS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Manage system-wide property scheduling, viewings, and contracts.</p>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist filter panel -->
    <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-6 mb-8 relative z-10">
        <form method="GET" class="flex flex-wrap gap-6 items-end">
            <input type="hidden" name="action" value="index">
            
            <div class="flex-1 min-w-[200px]">
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Status</label>
                <select name="status" 
                        class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider">
                    <option value="">All Statuses</option>
                    <option value="pending" <?php echo ($filters['status'] ?? '') === 'pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="confirmed" <?php echo ($filters['status'] ?? '') === 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                    <option value="cancelled" <?php echo ($filters['status'] ?? '') === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>
            
            <div class="flex-1 min-w-[200px]">
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Start Date</label>
                <input type="date" 
                       name="start_date" 
                       value="<?php echo $filters['start_date'] ?? ''; ?>" 
                       class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono">
            </div>
            
            <div class="flex-1 min-w-[200px]">
                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">End Date</label>
                <input type="date" 
                       name="end_date" 
                       value="<?php echo $filters['end_date'] ?? ''; ?>" 
                       class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono">
            </div>
            
            <div class="flex items-center gap-3">
                <button type="submit" 
                        class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300">
                    Filter
                </button>
                <?php if(!empty($filters['status']) || !empty($filters['start_date'])): ?>
                <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=index" 
                   class="px-5 py-2.5 border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white text-slate-700 dark:text-slate-300 font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300">
                    Clear
                </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Stark brutalist bookings list table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Booking Info</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Client</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Dates</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Total</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php 
                    if($bookings->rowCount() > 0):
                        while($booking = $bookings->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-xs font-mono text-slate-900 dark:text-white font-bold">#<?php echo $booking['id']; ?></span>
                            <div class="text-[9px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mt-1 font-mono">
                                <?php echo Helper::formatDate($booking['created_at']); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="block text-xs font-bold text-slate-900 dark:text-white uppercase truncate max-w-[150px]" title="<?php echo $booking['title']; ?>">
                                <?php echo $booking['title']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $booking['client_name']; ?></span>
                                <span class="text-[9px] font-mono text-slate-450 dark:text-slate-550 lowercase tracking-normal mt-0.5"><?php echo $booking['client_email']; ?></span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 dark:text-slate-400 font-mono">
                             <div><?php echo Helper::formatDate($booking['start_date']); ?></div>
                             <div class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">TO <?php echo Helper::formatDate($booking['end_date']); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-900 dark:text-white font-mono">
                            <?php echo Helper::formatCurrency($booking['total_amount']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo match($booking['booking_status']) {
                                    'confirmed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                    'cancelled' => 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30',
                                    default => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20'
                                };
                            ?>">
                                <?php echo $booking['booking_status']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="inline-flex gap-2">
                                <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=details&id=<?php echo $booking['id']; ?>" 
                                   class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300" 
                                   title="View Details">
                                    <span class="material-symbols-outlined text-sm leading-none">visibility</span>
                                </a>
                                
                                <?php if($booking['booking_status'] === 'pending'): ?>
                                <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=confirm&id=<?php echo $booking['id']; ?>" 
                                   class="p-2 border border-slate-200 dark:border-white/10 text-green-600 hover:text-green-850 hover:border-green-600 rounded-none transition duration-300" 
                                   title="Confirm Booking" 
                                   onclick="return confirm('Confirm this booking?')">
                                    <span class="material-symbols-outlined text-sm leading-none">check_circle</span>
                                </a>
                                <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=cancel&id=<?php echo $booking['id']; ?>" 
                                   class="p-2 border border-slate-200 dark:border-white/10 text-red-600 hover:text-red-850 hover:border-red-650 rounded-none transition duration-300" 
                                   title="Cancel Booking" 
                                   onclick="return confirm('Cancel this booking?')">
                                    <span class="material-symbols-outlined text-sm leading-none">cancel</span>
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
                        <td colspan="7" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">event_busy</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No bookings found matching filters.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
