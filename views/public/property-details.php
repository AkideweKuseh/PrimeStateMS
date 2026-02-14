<?php 
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../../models/Property.php';
require_once __DIR__ . '/../../models/SavedProperty.php';
require_once __DIR__ . '/../../core/Auth.php';

if (!isset($_GET['id'])) {
    Helper::redirect('views/public/properties.php');
}

$propertyModel = new Property();
$propertyModel->id = $_GET['id'];
$property = $propertyModel->readOne();

if (!$property) {
    Helper::redirect('views/public/properties.php');
}
?>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pt-28">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-lg">arrow_back</span>
            Back to Properties
        </a>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-4">
        <div class="space-y-2">
            <div class="flex items-center gap-3 mb-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                    <?php echo ucfirst($property['status']); ?>
                </span>
                <span class="text-sm text-slate-500 dark:text-slate-400">Ref: PE-<?php echo $property['id']; ?></span>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight"><?php echo $property['title']; ?></h1>
            <div class="flex items-center text-slate-500 dark:text-slate-400">
                <span class="material-symbols-outlined text-lg mr-1 text-primary">location_on</span>
                <span class="text-base"><?php echo $property['address'] . ', ' . $property['city']; ?></span>
            </div>
        </div>
        <div class="flex flex-col items-start md:items-end">
            <span class="text-sm text-slate-500 dark:text-slate-400 font-medium">Price</span>
            <h2 class="text-3xl font-bold text-primary"><?php echo Helper::formatCurrency($property['price']); ?></h2>
            <span class="text-sm text-slate-400">For <?php echo ucfirst($property['listing_type']); ?></span>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-[500px] mb-10">
        <!-- Main Image -->
        <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-xl">
            <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" 
                 alt="<?php echo $property['title']; ?>" 
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                 onerror="this.src='https://via.placeholder.com/800x600?text=Property+Image'">
        </div>
        <!-- Secondary Images (Placeholders for now, as we only have main_image) -->
        <div class="relative group overflow-hidden rounded-xl">
             <img src="https://via.placeholder.com/400x300?text=Kitchen" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        </div>
        <div class="relative group overflow-hidden rounded-xl">
             <img src="https://via.placeholder.com/400x300?text=Bedroom" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        </div>
         <div class="relative group overflow-hidden rounded-xl">
             <img src="https://via.placeholder.com/400x300?text=Bathroom" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        </div>
        <div class="relative group overflow-hidden rounded-xl">
            <img src="https://via.placeholder.com/400x300?text=Exterior" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/50 transition-colors cursor-pointer">
                <span class="text-white font-medium flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">grid_view</span>
                    View all photos
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Main Column -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Overview Icons -->
            <div class="bg-white dark:bg-[#1a1429] rounded-xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-primary/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined">home</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase">Type</p>
                        <p class="font-semibold text-slate-900 dark:text-white"><?php echo ucfirst($property['property_type']); ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-primary/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined">bed</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase">Bedrooms</p>
                        <p class="font-semibold text-slate-900 dark:text-white"><?php echo $property['bedrooms']; ?> Beds</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-primary/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined">bathtub</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase">Bathrooms</p>
                        <p class="font-semibold text-slate-900 dark:text-white"><?php echo $property['bathrooms']; ?> Baths</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-primary/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined">square_foot</span>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium uppercase">Area</p>
                        <p class="font-semibold text-slate-900 dark:text-white"><?php echo $property['area_sqft']; ?> sqft</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Description</h2>
                <div class="prose prose-indigo dark:prose-invert text-slate-600 dark:text-slate-300 max-w-none">
                    <?php echo nl2br($property['description']); ?>
                </div>
            </div>

            <!-- Features & Amenities -->
            <div class="border-t border-slate-200 dark:border-slate-800 pt-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Features & Amenities</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-8">
                    <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span>
                        <span>Air Conditioning</span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span>
                        <span>Swimming Pool</span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span>
                        <span>24/7 Security</span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span>
                        <span>Garage Parking</span>
                    </div>
                     <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span>
                        <span>Water Reservoir</span>
                    </div>
                     <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-green-500 text-sm">check_circle</span>
                        <span>Garden</span>
                    </div>
                </div>
            </div>

            <!-- Location Map (Placeholder) -->
            <div class="border-t border-slate-200 dark:border-slate-800 pt-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Location</h2>
                <div class="w-full h-80 rounded-xl overflow-hidden relative bg-slate-200 flex items-center justify-center">
                     <span class="text-slate-500">Map View Placeholder for <?php echo $property['city']; ?></span>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                <div class="bg-white dark:bg-[#1a1429] rounded-xl shadow-lg border border-slate-100 dark:border-slate-700 p-6">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-4">Interested in this property?</h3>
                    
                    <!-- Agent Info -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="relative">
                            <div class="w-14 h-14 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 ring-2 ring-primary/20">
                                <span class="material-symbols-outlined text-2xl">person</span>
                            </div>
                            <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white dark:border-slate-800 rounded-full"></span>
                        </div>
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white"><?php echo $property['agent_name'] ?? 'Prime Agent'; ?></p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Verified Agent</p>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <?php 
                    $isSaved = false;
                    if (Auth::check()) {
                        $savedPropertyModel = new SavedProperty();
                        $isSaved = $savedPropertyModel->isSaved(Auth::id(), $property['id']);
                    }
                    ?>
                    <form action="<?php echo BASE_URL; ?>controllers/SavedPropertyController.php?action=toggle" method="POST" class="mb-6">
                        <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                        <button type="submit" class="w-full py-2 px-4 rounded-lg border <?php echo $isSaved ? 'border-red-200 bg-red-50 text-red-600' : 'border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700'; ?> transition-colors font-medium text-sm flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg"><?php echo $isSaved ? 'favorite' : 'favorite_border'; ?></span>
                            <?php echo $isSaved ? 'Saved to Favorites' : 'Save to Favorites'; ?>
                        </button>
                    </form>

                    <!-- Contact Actions -->
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button class="flex items-center justify-center gap-2 py-2 px-4 rounded-lg border border-slate-300 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-slate-700 dark:text-slate-200 font-medium text-sm">
                            <span class="material-symbols-outlined text-base">phone</span>
                            Call
                        </button>
                        <button class="flex items-center justify-center gap-2 py-2 px-4 rounded-lg border border-slate-300 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors text-slate-700 dark:text-slate-200 font-medium text-sm">
                            <span class="material-symbols-outlined text-base">chat</span>
                            WhatsApp
                        </button>
                    </div>

                    <!-- Inquiry Form or Booking Status -->
                    <?php 
                    $userBooking = null;
                    if (Auth::check()) {
                        require_once __DIR__ . '/../../models/Booking.php';
                        $bookingModel = new Booking();
                        $userBooking = $bookingModel->getUserBooking($property['id'], Auth::id());
                    }
                    ?>

                    <?php if ($userBooking): ?>
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-6 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-800 text-green-600 dark:text-green-300 mb-4">
                                <span class="material-symbols-outlined text-2xl">check_circle</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">You have booked this property!</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">
                                Your booking request on <strong><?php echo Helper::formatDate($userBooking['booking_date']); ?></strong> is currently 
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium <?php echo $userBooking['booking_status'] === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                    <?php echo ucfirst($userBooking['booking_status']); ?>
                                </span>
                            </p>
                            <a href="<?php echo BASE_URL; ?>views/client/bookings.php" class="inline-block px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                                Manage Booking
                            </a>
                        </div>
                    <?php elseif (Auth::check()): ?>
                    <form action="<?php echo BASE_URL; ?>controllers/BookingController.php?action=book" method="POST" class="space-y-4">
                        <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                        <input type="hidden" name="total_amount" value="<?php echo $property['price']; ?>">
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Move-in Date</label>
                            <input type="date" name="start_date" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-primary focus:ring-primary shadow-sm text-sm">
                        </div>
                        
                         <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Duration / Move-out</label>
                            <input type="date" name="end_date" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-primary focus:ring-primary shadow-sm text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Message</label>
                            <textarea name="notes" rows="3" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-primary focus:ring-primary shadow-sm text-sm" placeholder="I am interested in this property..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-semibold shadow-md hover:bg-primary-dark transition-all flex items-center justify-center gap-2 group">
                            Request Booking
                            <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </form>
                    <?php else: ?>
                    <div class="text-center py-6 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-100 dark:border-slate-700">
                        <span class="material-symbols-outlined text-4xl text-slate-400 mb-3">lock</span>
                        <h5 class="font-bold text-slate-900 dark:text-white mb-2">Login Required</h5>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-4 px-4">Please login or register to book visits or make offers.</p>
                        <a href="<?php echo BASE_URL; ?>views/auth/login.php" class="inline-block bg-primary text-white px-6 py-2 rounded-lg font-medium hover:bg-primary-dark transition-colors">Login Now</a>
                    </div>
                    <?php endif; ?>
                    
                    <p class="text-xs text-center text-slate-400 mt-4">
                        By sending a request, you agree to our Terms and Privacy Policy.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
