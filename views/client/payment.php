<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

if (!isset($_GET['booking_id'])) {
    Helper::redirect('views/client/bookings.php');
}

$bookingId = $_GET['booking_id'];
$bookingModel = new Booking();
$booking = $bookingModel->readOne($bookingId);

// Validate booking
if (!$booking || $booking['client_id'] != Auth::id() || $booking['booking_status'] != 'pending') {
    Helper::redirect('views/client/bookings.php');
}
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10 max-w-3xl mx-auto">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">SECURE CHECKOUT</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Settle your outstanding booking balance to secure active dates.</p>
    </div>
</div>

<div class="relative z-10 max-w-3xl mx-auto">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
        <!-- Order Summary -->
        <div class="md:col-span-1 order-2 md:order-1">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-6 sticky top-24">
                <h3 class="font-display font-black text-xs text-slate-900 dark:text-white uppercase tracking-wider mb-4">Summary</h3>
                
                <div class="mb-4">
                    <div class="h-32 border border-slate-200 dark:border-white/10 bg-slate-900 overflow-hidden mb-3">
                        <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" 
                             alt="Property" 
                             class="w-full h-full object-cover"
                             onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=200&q=80'">
                    </div>
                    <h4 class="font-display font-bold text-xs text-slate-900 dark:text-white uppercase truncate"><?php echo $booking['title']; ?></h4>
                    <p class="text-[9px] font-bold tracking-wider text-slate-400 uppercase mt-1"><?php echo $booking['city']; ?></p>
                </div>

                <div class="space-y-3 border-t border-slate-200 dark:border-white/5 pt-4 mb-4">
                     <div class="flex justify-between items-center text-xs">
                        <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">Duration</span>
                        <span class="font-mono font-bold text-slate-900 dark:text-white uppercase">
                            <?php 
                            $start = new DateTime($booking['start_date']);
                            $end = new DateTime($booking['end_date']);
                            echo $start->diff($end)->days . ' Days';
                            ?>
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400">Total</span>
                        <span class="font-mono font-bold text-slate-900 dark:text-white"><?php echo Helper::formatCurrency($booking['total_amount']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="md:col-span-2 order-1 md:order-2">
            <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 p-6">
                <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-6">Select Payment Method</h3>
                
                <form id="paymentForm" action="<?php echo BASE_URL; ?>controllers/BookingController.php?action=processPayment" method="POST">
                    <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                    <input type="hidden" name="payment_method" id="selectedMethod" value="card">

                    <!-- Methods Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <!-- Card Option -->
                        <div onclick="selectMethod('card')" 
                             id="method-card" 
                             class="payment-method cursor-pointer border border-slate-950 bg-primary/20 text-black p-4 flex items-center gap-4 transition-all duration-300 relative rounded-none">
                            <div class="w-10 h-10 border border-slate-950/20 bg-white flex items-center justify-center text-black rounded-none">
                                <span class="material-symbols-outlined font-bold text-lg">credit_card</span>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-xs uppercase tracking-wider text-black">Credit Card</h4>
                                <p class="text-[9px] font-bold tracking-wider text-black/60 uppercase">Visa, Mastercard</p>
                            </div>
                            <div class="absolute top-4 right-4 text-black flex items-center">
                                <span class="material-symbols-outlined text-sm font-bold">check_circle</span>
                            </div>
                        </div>

                        <!-- Mobile Money Option -->
                        <div onclick="selectMethod('momo')" 
                             id="method-momo" 
                             class="payment-method cursor-pointer border border-slate-200 dark:border-white/10 text-slate-500 hover:border-slate-950 p-4 flex items-center gap-4 transition-all duration-300 relative rounded-none">
                            <div class="w-10 h-10 border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center text-slate-400 rounded-none">
                                <span class="material-symbols-outlined text-lg">smartphone</span>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-xs uppercase tracking-wider text-slate-805 dark:text-white">Mobile Money</h4>
                                <p class="text-[9px] font-bold tracking-wider text-slate-400 uppercase">MTN, Telecel, AT</p>
                            </div>
                            <div class="absolute top-4 right-4 text-primary hidden check-icon flex items-center">
                                <span class="material-symbols-outlined text-sm font-bold">check_circle</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Form -->
                    <div id="card-details" class="space-y-5">
                        <div>
                            <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Card Number</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-405 text-lg">credit_card</span>
                                <input type="text" 
                                       placeholder="0000 0000 0000 0000" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Expiry Date</label>
                                <input type="text" 
                                       placeholder="MM/YY" 
                                       class="w-full px-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono">
                            </div>
                            <div>
                                <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">CVC Security Code</label>
                                <input type="text" 
                                       placeholder="123" 
                                       class="w-full px-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono">
                            </div>
                        </div>
                    </div>

                    <!-- Momo Form -->
                    <div id="momo-details" class="space-y-5 hidden">
                         <div>
                            <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Select Network Provider</label>
                            <select class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider">
                                <option>MTN Mobile Money</option>
                                <option>Telecel Cash</option>
                                <option>AT Money</option>
                            </select>
                        </div>
                        <div>
                            <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Mobile Number</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-405 text-lg">phone_iphone</span>
                                <input type="tel" 
                                       placeholder="024 123 4567" 
                                       class="w-full pl-10 pr-4 py-2.5 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs transition-colors font-mono">
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="mt-8 w-full px-8 py-4 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center justify-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                        <span class="material-symbols-outlined text-sm font-bold">lock</span>
                        PAY <?php echo Helper::formatCurrency($booking['total_amount']); ?>
                    </button>
                    
                    <p class="text-center text-[9px] text-slate-400 dark:text-slate-500 mt-4 flex items-center justify-center gap-1 uppercase tracking-widest font-display">
                        <span class="material-symbols-outlined text-xs font-bold text-green-500">enhanced_encryption</span>
                        Transaction data encrypted with bank-level security algorithms.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Processing Modal -->
<div id="processingModal" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm hidden items-center justify-center p-6">
    <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none p-8 max-w-sm w-full text-center shadow-2xl scale-95" id="modalContent">
        <div class="w-12 h-12 border-4 border-slate-200 dark:border-slate-800 border-t-primary rounded-full animate-spin mx-auto mb-6"></div>
        <h3 class="font-display font-black text-base text-slate-900 dark:text-white uppercase tracking-tight mb-2">Processing Transaction</h3>
        <p class="text-xs text-slate-450 dark:text-slate-500 uppercase tracking-widest">Please hold while payment registers with gateway...</p>
    </div>
    
    <!-- Success State -->
    <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none p-8 max-w-sm w-full text-center shadow-2xl hidden" id="successContent">
        <div class="w-12 h-12 border border-green-500/20 bg-green-500/10 text-green-600 dark:text-green-400 flex items-center justify-center mx-auto mb-6 rounded-none">
            <span class="material-symbols-outlined text-xl font-bold">check</span>
        </div>
        <h3 class="font-display font-black text-base text-slate-900 dark:text-white uppercase tracking-tight mb-2">Payment Clear!</h3>
        <p class="text-xs text-slate-450 dark:text-slate-500 uppercase tracking-widest mb-6">Your reservation has been fully confirmed.</p>
        <button onclick="window.location.href='<?php echo BASE_URL; ?>views/client/bookings.php'" 
                class="w-full px-5 py-3.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[9px] font-bold tracking-widest uppercase rounded-none transition duration-300">
            View Bookings
        </button>
    </div>
</div>

<script>
    function selectMethod(method) {
        // Update hidden input
        document.getElementById('selectedMethod').value = method;

        // Reset Styles
        document.querySelectorAll('.payment-method').forEach(el => {
            el.classList.remove('border-slate-950', 'bg-primary/20', 'text-black');
            el.classList.add('border-slate-200', 'dark:border-white/10', 'text-slate-500');
            el.querySelector('.check-icon')?.classList.add('hidden');
            el.querySelector('.absolute')?.classList.add('hidden'); 
        });

        // Activate Selected
        const selected = document.getElementById('method-' + method);
        selected.classList.remove('border-slate-200', 'dark:border-white/10', 'text-slate-500');
        selected.classList.add('border-slate-950', 'bg-primary/20', 'text-black');
        
        if(method === 'card') {
             selected.querySelector('.absolute').classList.remove('hidden');
             document.getElementById('card-details').classList.remove('hidden');
             document.getElementById('momo-details').classList.add('hidden');
        } else {
             selected.querySelector('.check-icon').classList.remove('hidden');
             document.getElementById('card-details').classList.add('hidden');
             document.getElementById('momo-details').classList.remove('hidden');
        }
    }

    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show Processing Modal
        const modal = document.getElementById('processingModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Simulate Processing
        setTimeout(() => {
            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Hide processing spinner
                document.getElementById('modalContent').classList.add('hidden');
                
                if (data.success) {
                    // Show success
                    document.getElementById('successContent').classList.remove('hidden');
                } else {
                    // Show error
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.getElementById('modalContent').classList.remove('hidden');
                    showAlertModal({title:'Payment Failed',message:data.message || 'An unknown error occurred. Please try again.',type:'danger'}); 
                }
            })
            .catch(error => {
                console.error('Error:', error);
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.getElementById('modalContent').classList.remove('hidden');
                showAlertModal({title:'Payment Error',message:'An error occurred while processing your payment. Please try again.',type:'danger'}); 
            });
            
        }, 3000); 
    });
</script>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
