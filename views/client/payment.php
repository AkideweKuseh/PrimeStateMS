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

<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Secure Checkout</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Complete your payment to confirm your booking.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Order Summary -->
        <div class="md:col-span-1 order-2 md:order-1">
            <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6 sticky top-24">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4">Order Summary</h3>
                
                <div class="mb-4">
                    <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $booking['main_image'] ?? 'default.jpg'; ?>" alt="Property" class="w-full h-32 object-cover rounded-lg mb-3">
                    <h4 class="font-medium text-slate-900 dark:text-white text-sm line-clamp-1"><?php echo $booking['title']; ?></h4>
                    <p class="text-xs text-slate-500"><?php echo $booking['city']; ?></p>
                </div>

                <div class="space-y-2 border-t border-slate-100 dark:border-slate-800 pt-4 mb-4">
                     <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Duration</span>
                        <span class="text-slate-900 dark:text-white font-medium">
                            <?php 
                            $start = new DateTime($booking['start_date']);
                            $end = new DateTime($booking['end_date']);
                            echo $start->diff($end)->days . ' Days';
                            ?>
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Total Amount</span>
                        <span class="text-slate-900 dark:text-white font-bold"><?php echo Helper::formatCurrency($booking['total_amount']); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="md:col-span-2 order-1 md:order-2">
            <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6">
                <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-6">Select Payment Method</h3>
                
                <form id="paymentForm" action="<?php echo BASE_URL; ?>controllers/BookingController.php?action=processPayment" method="POST">
                    <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                    <input type="hidden" name="payment_method" id="selectedMethod" value="card">

                    <!-- Methods Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <!-- Card Option -->
                        <div onclick="selectMethod('card')" id="method-card" class="payment-method cursor-pointer border-2 border-primary bg-primary/5 rounded-xl p-4 flex items-center gap-4 transition-all relative">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm text-primary">
                                <span class="material-symbols-outlined">credit_card</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white">Credit Card</h4>
                                <p class="text-xs text-slate-500">Visa, Mastercard</p>
                            </div>
                            <div class="absolute top-4 right-4 text-primary">
                                <span class="material-symbols-outlined">check_circle</span>
                            </div>
                        </div>

                        <!-- Mobile Money Option -->
                        <div onclick="selectMethod('momo')" id="method-momo" class="payment-method cursor-pointer border-2 border-slate-200 dark:border-slate-700 hover:border-slate-300 rounded-xl p-4 flex items-center gap-4 transition-all relative">
                            <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shadow-sm text-slate-500">
                                <span class="material-symbols-outlined">smartphone</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white">Mobile Money</h4>
                                <p class="text-xs text-slate-500">MTN, Telecel, AT</p>
                            </div>
                            <div class="absolute top-4 right-4 text-primary hidden check-icon">
                                <span class="material-symbols-outlined">check_circle</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Form -->
                    <div id="card-details" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Card Number</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">credit_card</span>
                                <input type="text" placeholder="0000 0000 0000 0000" class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Expiry</label>
                                <input type="text" placeholder="MM/YY" class="w-full px-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">CVC</label>
                                <input type="text" placeholder="123" class="w-full px-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                            </div>
                        </div>
                    </div>

                    <!-- Momo Form (Hidden by default) -->
                    <div id="momo-details" class="space-y-4 hidden">
                         <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Network</label>
                            <select class="w-full px-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                                <option>MTN Mobile Money</option>
                                <option>Telecel Cash</option>
                                <option>AT Money</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Phone Number</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">phone_iphone</span>
                                <input type="tel" placeholder="024 123 4567" class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow dark:text-white">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mt-8 w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">lock</span>
                        Pay <?php echo Helper::formatCurrency($booking['total_amount']); ?>
                    </button>
                    
                    <p class="text-center text-xs text-slate-400 mt-4 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm">enhanced_encryption</span>
                        Payments are secure and encrypted.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Processing Modal -->
<div id="processingModal" class="fixed inset-0 z-50 bg-slate-900/80 backdrop-blur-sm hidden items-center justify-center">
    <div class="bg-white dark:bg-[#1a1625] rounded-2xl p-8 max-w-sm w-full text-center shadow-2xl transform scale-95 transition-transform duration-300" id="modalContent">
        <div class="w-16 h-16 border-4 border-primary/30 border-t-primary rounded-full animate-spin mx-auto mb-6"></div>
        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Processing Payment</h3>
        <p class="text-slate-500 dark:text-slate-400">Please wait while we secure your booking...</p>
    </div>
    
    <!-- Success State (Hidden initially) -->
    <div class="bg-white dark:bg-[#1a1625] rounded-2xl p-8 max-w-sm w-full text-center shadow-2xl hidden" id="successContent">
        <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
            <span class="material-symbols-outlined text-3xl">check</span>
        </div>
        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Payment Successful!</h3>
        <p class="text-slate-500 dark:text-slate-400 mb-6">Your booking has been confirmed.</p>
        <button onclick="window.location.href='<?php echo BASE_URL; ?>views/client/bookings.php'" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-xl transition-colors">
            View My Bookings
        </button>
    </div>
</div>

<script>
    function selectMethod(method) {
        // Update hidden input
        document.getElementById('selectedMethod').value = method;

        // Reset Styles
        document.querySelectorAll('.payment-method').forEach(el => {
            el.classList.remove('border-primary', 'bg-primary/5');
            el.classList.add('border-slate-200', 'dark:border-slate-700');
            el.querySelector('.check-icon')?.classList.add('hidden');
            el.querySelector('.absolute')?.classList.add('hidden'); // For checked one
        });

        // Activate Selected
        const selected = document.getElementById('method-' + method);
        selected.classList.remove('border-slate-200', 'dark:border-slate-700');
        selected.classList.add('border-primary', 'bg-primary/5');
        
        // Show check icon logic (simplified for custom HTML structure)
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
            // Actually submit data via Fetch
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
                    alert('Payment Failed: ' + (data.message || 'Unknown error'));
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.getElementById('modalContent').classList.remove('hidden'); // Reset for next time
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your payment. Please try again.');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.getElementById('modalContent').classList.remove('hidden'); // Reset
            });
            
        }, 3000); // 3 seconds delay
    });
</script>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
