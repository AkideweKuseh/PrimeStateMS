<?php
// Load dependencies BEFORE the sidebar to allow redirect without "headers already sent" error
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Helper.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../models/Booking.php';

if (session_status() === PHP_SESSION_NONE) session_start();

// Now safe to include layout
require_once __DIR__ . '/../layouts/tenant-sidebar.php';

$bookingModel = new Booking();
$myBookings = $bookingModel->readByClient(Auth::id());
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">MY BOOKINGS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Track your property bookings, payments, and confirmations.</p>
    </div>
    <a href="<?php echo BASE_URL; ?>views/public/properties.php" 
       class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
        <span class="material-symbols-outlined text-sm font-bold">add</span>
        Book New Property
    </a>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist bookings list table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Asset</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Location</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Schedule Date</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Payment</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Tally Due</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php 
                    if($myBookings->rowCount() > 0):
                        while($booking = $myBookings->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 border border-slate-200 dark:border-white/10 bg-slate-900 overflow-hidden">
                                    <img class="h-full w-full object-cover" 
                                         src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" 
                                         alt="<?php echo $booking['title']; ?>"
                                         onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=120&q=80'">
                                </div>
                                <div class="ml-4">
                                    <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $booking['property_id']; ?>" 
                                       class="text-xs font-bold text-slate-900 dark:text-white hover:text-primary transition-colors uppercase tracking-wide">
                                        <?php echo $booking['title']; ?>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-650 dark:text-slate-350 uppercase">
                            <?php echo $booking['city']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500 font-mono">
                            <?php echo Helper::formatDate($booking['booking_date']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                                $clientPaymentClass = match($booking['payment_status']) {
                                    'completed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                                    'partial' => 'bg-blue-500/10 text-blue-700 border-blue-200 dark:text-blue-400 dark:border-blue-800/30',
                                    default => 'bg-slate-100 text-slate-500 border-slate-200 dark:bg-slate-800/50 dark:text-slate-400 dark:border-white/10'
                                };
                            ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php echo $clientPaymentClass; ?>">
                                <span class="material-symbols-outlined text-[10px]"><?php echo $booking['payment_status'] === 'completed' ? 'paid' : 'money_off'; ?></span>
                                <?php echo $booking['payment_status']; ?>
                            </span>
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
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-900 dark:text-white font-mono">
                            <?php echo Helper::formatCurrency($booking['total_amount']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="inline-flex items-center gap-2">
                                <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $booking['property_id']; ?>" 
                                   class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300" 
                                   title="View Property">
                                    <span class="material-symbols-outlined text-sm leading-none">visibility</span>
                                </a>

                                <?php if($booking['booking_status'] === 'pending' && $booking['payment_status'] !== 'completed'): ?>
                                <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=payment&booking_id=<?php echo $booking['id']; ?>" 
                                   class="p-2 border border-slate-200 dark:border-white/10 text-green-600 hover:text-green-850 hover:border-green-600 rounded-none transition duration-300" 
                                   title="Pay Now">
                                    <span class="material-symbols-outlined text-sm leading-none font-bold">credit_card</span>
                                </a>
                                <?php elseif($booking['booking_status'] === 'pending' && $booking['payment_status'] === 'completed'): ?>
                                <span class="px-2 py-1 text-[9px] font-bold font-display tracking-wider uppercase text-slate-400 dark:text-slate-500" title="Awaiting admin confirmation">
                                    <span class="material-symbols-outlined text-sm leading-none text-yellow-600 dark:text-primary">hourglass_top</span>
                                </span>
                                <?php endif; ?>
                                
                                <?php if($booking['booking_status'] !== 'confirmed'): ?>
                                <form id="deleteBookingForm-<?php echo $booking['id']; ?>"
                                      action="<?php echo BASE_URL; ?>controllers/BookingController.php?action=delete" 
                                      method="POST" 
                                      class="inline-block">
                                    <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                                    <button type="submit" 
                                            class="p-2 border border-slate-200 dark:border-white/10 text-red-500 hover:text-red-700 hover:border-red-650 rounded-none transition duration-300" 
                                            title="Delete Booking"
                                            onclick="return confirm('Are you sure you want to delete this booking?')">
                                        <span class="material-symbols-outlined text-sm leading-none">delete</span>
                                    </button>
                                </form>
                                <?php else: ?>
                                <button disabled 
                                        class="p-2 border border-slate-200 dark:border-white/5 text-slate-300 dark:text-slate-700 cursor-not-allowed rounded-none" 
                                        title="Cannot delete confirmed booking">
                                    <span class="material-symbols-outlined text-sm leading-none">delete</span>
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
                        <td colspan="7" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">event_busy</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">You haven't scheduled any bookings yet.</p>
                            <a href="<?php echo BASE_URL; ?>views/public/properties.php" 
                               class="mt-4 px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 inline-block shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                                Browse Properties
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
