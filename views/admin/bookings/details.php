<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../core/Helper.php';

// $booking is available from controller
?>

<!-- Back Button (Hudson 8 Minimalist Link) -->
<div class="mb-6 relative z-10">
    <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=index" 
       class="inline-flex items-center gap-2 font-display text-[10px] font-bold tracking-widest uppercase text-slate-500 hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Back to Bookings
    </a>
</div>

<div class="max-w-4xl mx-auto relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Header Block -->
    <div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10 bg-white dark:bg-[#151517] p-6 border rounded-none">
        <div>
            <div class="flex items-center gap-3 mb-2 flex-wrap">
                <h1 class="font-display font-black text-2xl text-slate-900 dark:text-white tracking-tighter uppercase">BOOKING RECORD #<?php echo $booking['id']; ?></h1>
                <?php 
                    $statusClass = match($booking['booking_status']) {
                        'confirmed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                        'cancelled' => 'bg-red-500/10 text-red-700 border-red-200 dark:text-red-400 dark:border-red-800/30',
                        default => 'bg-yellow-500/10 text-yellow-750 border-yellow-250 dark:text-primary dark:border-primary/20'
                    };
                    $paymentBadgeClass = match($booking['payment_status']) {
                        'completed' => 'bg-green-500/10 text-green-700 border-green-200 dark:text-green-400 dark:border-green-800/30',
                        'partial' => 'bg-blue-500/10 text-blue-700 border-blue-200 dark:text-blue-400 dark:border-blue-800/30',
                        default => 'bg-slate-100 text-slate-500 border-slate-200 dark:bg-slate-800/50 dark:text-slate-400 dark:border-white/10'
                    };
                ?>
                <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php echo $statusClass; ?>">
                    <?php echo $booking['booking_status']; ?>
                </span>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php echo $paymentBadgeClass; ?>">
                    <span class="material-symbols-outlined text-[10px]"><?php echo $booking['payment_status'] === 'completed' ? 'paid' : 'money_off'; ?></span>
                    <?php echo $booking['payment_status']; ?>
                </span>
            </div>
            <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase">Registered on <?php echo Helper::formatDate($booking['created_at']); ?></p>
        </div>
        
        <div class="flex gap-3">
            <?php if($booking['booking_status'] === 'pending'): ?>
                <?php if($booking['payment_status'] === 'completed'): ?>
                <a href="javascript:void(0)" 
                   onclick="showConfirmModal({title:'Confirm Booking',message:'Payment has been received. Are you sure you want to confirm this booking?',type:'success',confirmText:'Yes, Confirm',onConfirm:()=>{window.location.href='<?php echo BASE_URL; ?>controllers/BookingController.php?action=confirm&id=<?php echo $booking['id']; ?>'}})"
                   class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                    <span class="material-symbols-outlined text-sm font-bold">check_circle</span>
                    Confirm
                </a>
                <?php else: ?>
                <button disabled 
                        class="px-5 py-2.5 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-white/10 text-slate-400 dark:text-slate-600 font-display text-[10px] font-bold tracking-widest uppercase rounded-none cursor-not-allowed flex items-center gap-2"
                        title="Client must pay before you can confirm">
                    <span class="material-symbols-outlined text-sm">check_circle</span>
                    Awaiting Payment
                </button>
                <?php endif; ?>
            <a href="javascript:void(0)" 
               onclick="showConfirmModal({title:'Cancel Booking',message:'Are you sure you want to cancel this booking? This action cannot be undone.',type:'danger',confirmText:'Yes, Cancel',onConfirm:()=>{window.location.href='<?php echo BASE_URL; ?>controllers/BookingController.php?action=cancel&id=<?php echo $booking['id']; ?>'}})"
               class="px-5 py-2.5 bg-charcoal dark:bg-white text-white dark:text-black hover:bg-black dark:hover:bg-slate-100 border border-slate-950 dark:border-white font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">cancel</span>
                Cancel
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 relative z-10">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Property Details -->
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30">
                    <h2 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">apartment</span>
                        Property Details
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row items-start gap-5">
                        <div class="w-full sm:w-28 h-28 border border-slate-200 dark:border-white/10 bg-slate-900 overflow-hidden">
                            <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" 
                                 alt="Property" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=200&q=80'">
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-slate-900 dark:text-white text-base mb-1 uppercase tracking-wide"><?php echo $booking['title']; ?></h3>
                            <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase flex items-center gap-1 mb-3">
                                <span class="material-symbols-outlined text-[10px]">location_on</span>
                                <?php echo $booking['address'] . ', ' . $booking['city']; ?>
                            </p>
                            <p class="text-slate-900 dark:text-white font-mono font-bold text-sm">
                                <?php echo Helper::formatCurrency($booking['price']); ?> 
                                <span class="text-slate-400 dark:text-slate-500 text-[10px] font-display font-bold tracking-wider uppercase ml-1">/ Night</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Info -->
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30">
                    <h2 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">person</span>
                        Client Information
                    </h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Full Name</label>
                        <p class="text-xs font-bold text-slate-950 dark:text-white uppercase"><?php echo $booking['client_name']; ?></p>
                    </div>
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Email Address</label>
                        <p class="text-xs text-slate-800 dark:text-slate-300 font-mono"><?php echo $booking['client_email']; ?></p>
                    </div>
                    <div>
                        <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Phone Number</label>
                        <p class="text-xs font-bold text-slate-950 dark:text-white font-mono"><?php echo $booking['client_phone']; ?></p>
                    </div>
                </div>
            </div>
             
             <!-- Notes -->
             <?php if(!empty($booking['notes'])): ?>
             <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30">
                    <h2 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">notes</span>
                        Administrative Notes
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-xs text-slate-650 dark:text-slate-350 leading-relaxed uppercase tracking-wide"><?php echo nl2br(htmlspecialchars($booking['notes'])); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Booking Summary -->
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30">
                    <h2 class="font-display font-black text-xs text-slate-900 dark:text-white uppercase tracking-wider">Booking Summary</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">CHECK-IN</span>
                        <span class="font-mono font-bold text-slate-900 dark:text-white"><?php echo Helper::formatDate($booking['start_date']); ?></span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">CHECK-OUT</span>
                        <span class="font-mono font-bold text-slate-900 dark:text-white"><?php echo Helper::formatDate($booking['end_date']); ?></span>
                    </div>
                    <div class="border-t border-slate-200 dark:border-white/5 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-950 dark:text-white">TOTAL DUE</span>
                            <span class="text-lg font-mono font-bold text-primary"><?php echo Helper::formatCurrency($booking['total_amount']); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Status Card -->
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 overflow-hidden">
                <div class="p-5 border-b border-slate-200 dark:border-white/5 bg-slate-50 dark:bg-slate-800/30">
                    <h2 class="font-display font-black text-xs text-slate-900 dark:text-white uppercase tracking-wider">Payment Status</h2>
                </div>
                <div class="p-6">
                    <?php
                        $pStatusClass = match($booking['payment_status']) {
                            'completed' => 'border-green-500/20 bg-green-500/5',
                            'partial' => 'border-blue-500/20 bg-blue-500/5',
                            default => 'border-slate-200 bg-slate-50 dark:border-white/10 dark:bg-slate-800/30'
                        };
                        $pStatusIcon = match($booking['payment_status']) {
                            'completed' => 'paid',
                            default => 'money_off'
                        };
                        $pStatusColor = match($booking['payment_status']) {
                            'completed' => 'text-green-600 dark:text-green-400',
                            default => 'text-slate-400 dark:text-slate-500'
                        };
                    ?>
                    <div class="border rounded-none p-4 flex items-center gap-4 <?php echo $pStatusClass; ?>">
                        <span class="material-symbols-outlined text-2xl <?php echo $pStatusColor; ?>"><?php echo $pStatusIcon; ?></span>
                        <div>
                            <p class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $booking['payment_status']; ?></p>
                            <p class="text-[9px] font-bold tracking-wider text-slate-400 uppercase mt-0.5">
                                <?php echo $booking['payment_status'] === 'completed' ? 'Client has paid in full' : 'Awaiting client payment'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
