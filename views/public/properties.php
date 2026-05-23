<?php 
require_once __DIR__ . '/../layouts/header.php'; 
require_once __DIR__ . '/../../models/Property.php';
require_once __DIR__ . '/../../models/SavedProperty.php';
require_once __DIR__ . '/../../core/Auth.php';

// Initialize Property Model
$propertyModel = new Property();
$savedPropertyModel = new SavedProperty();
$savedPropertyIds = [];

if (Auth::check()) {
    $savedPropertyIds = $savedPropertyModel->getSavedPropertyIds(Auth::user()['id']);
}

// Get Filters
$location = $_GET['location'] ?? '';
$property_type = $_GET['property_type'] ?? '';
$price_range = $_GET['price_range'] ?? '';
$price_min = $_GET['price_min'] ?? '';
$price_max = $_GET['price_max'] ?? '';
$bedrooms = $_GET['bedrooms'] ?? '';
$bathrooms = $_GET['bathrooms'] ?? '';

// Parse price_range if provided and individual min/max not set
if (!empty($price_range) && empty($price_min) && empty($price_max)) {
    if (strpos($price_range, '+') !== false) {
        $price_min = (int) str_replace(['+', ',', 'GHS '], '', $price_range);
    } elseif (strpos($price_range, '-') !== false) {
        $parts = explode('-', $price_range);
        if (count($parts) == 2) {
            $price_min = (int) trim($parts[0]);
            $price_max = (int) trim($parts[1]);
        }
    }
}

$filters = [
    'location' => $location,
    'property_type' => $property_type,
    'price_min' => $price_min,
    'price_max' => $price_max,
    'bedrooms' => $bedrooms,
    'bathrooms' => $bathrooms
];

// Fetch Properties
$properties = $propertyModel->read($filters);
?>

<!-- Header / Breadcrumb (Luxury Charcoal Architectural Banner) -->
<header class="bg-charcoal text-white py-12 pt-28 relative overflow-hidden border-b border-white/10">
    <!-- Faint blueprint grid overlay -->
    <div class="absolute inset-0 blueprint-grid opacity-[0.12] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <span class="text-primary font-display text-[9px] font-bold tracking-[0.25em] uppercase block mb-1">PRIME ESTATE COLLECTION</span>
            <h1 class="font-display text-3xl md:text-4xl font-black tracking-tight uppercase leading-none">BROWSE PROPERTIES</h1>
            <nav class="flex text-[10px] font-display font-bold tracking-widest uppercase text-slate-400 mt-2">
                <a class="hover:text-primary transition-colors" href="<?php echo BASE_URL; ?>">Home</a>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white">Properties</span>
            </nav>
        </div>
        <div class="flex items-center gap-3 text-[10px] font-display font-bold tracking-widest uppercase text-slate-400">
            <span>Sort by:</span>
            <select class="form-select bg-white/5 border border-white/10 text-white rounded-none py-1.5 pl-3 pr-8 cursor-pointer focus:ring-1 focus:ring-primary text-[10px] uppercase font-bold tracking-wider">
                <option class="bg-charcoal text-white">Newest Listed</option>
                <option class="bg-charcoal text-white">Price: Low to High</option>
                <option class="bg-charcoal text-white">Price: High to Low</option>
            </select>
        </div>
    </div>
</header>

<!-- Main Content Grid -->
<div class="bg-neutral-light dark:bg-background-dark py-16 relative">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters (Crisp Minimalist Brutalist Box) -->
        <aside class="w-full lg:w-1/4 flex-shrink-0">
            <form action="<?php echo BASE_URL; ?>views/public/properties.php" method="GET" class="bg-white dark:bg-[#151517] border-2 border-slate-900 dark:border-white/10 p-8 rounded-none sticky top-36 shadow-sm">
                <div class="flex items-center justify-between mb-6 border-b border-slate-100 dark:border-white/5 pb-4">
                    <h2 class="font-display text-xs font-black tracking-widest uppercase text-slate-900 dark:text-white">Filters</h2>
                    <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="font-display text-[10px] font-bold tracking-widest uppercase text-primary-dark hover:text-primary transition-colors">Reset</a>
                </div>
                
                <!-- Location Search -->
                <div class="mb-6">
                    <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Location</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 text-sm">search</span>
                        <input type="text" name="location" value="<?php echo htmlspecialchars($filters['location']); ?>" class="w-full pl-9 pr-4 py-2 bg-slate-50 dark:bg-white/5 border-2 border-slate-900 dark:border-white/10 text-xs focus:ring-0 focus:border-slate-900 dark:focus:border-white transition-all font-medium rounded-none text-slate-900 dark:text-white placeholder-slate-400" placeholder="City, Zip, Address...">
                    </div>
                </div>
                
                <hr class="border-slate-100 dark:border-white/5 my-6"/>
                
                <!-- Property Type -->
                <div class="mb-6">
                    <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3">Property Type</label>
                    <div class="space-y-2.5">
                        <?php 
                        $types = ['house' => 'House', 'apartment' => 'Apartment', 'office' => 'Office', 'villa' => 'Villa', 'land' => 'Land'];
                        foreach($types as $val => $label):
                        ?>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="property_type" value="<?php echo $val; ?>" <?php echo $filters['property_type'] === $val ? 'checked' : ''; ?> class="border-2 border-slate-900 text-slate-900 focus:ring-0 focus:ring-offset-0 w-4 h-4 rounded-none accent-slate-950 dark:border-white/20"/>
                            <span class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-colors"><?php echo $label; ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <hr class="border-slate-100 dark:border-white/5 my-6"/>
                
                <!-- Price Range -->
                <div class="mb-6">
                    <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-4">Max Price (GHS)</label>
                    <input type="range" name="price_max" min="0" max="5000000" step="50000" value="<?php echo $filters['price_max'] ?: '5000000'; ?>" class="w-full h-1 bg-slate-200 dark:bg-white/10 rounded-none appearance-none cursor-pointer mb-4 accent-slate-900" oninput="document.getElementById('priceOutput').innerText = 'GHS ' + parseInt(this.value).toLocaleString()">
                    <div class="flex items-center justify-between font-display text-[10px] font-bold tracking-widest uppercase text-slate-900 dark:text-white">
                        <span class="text-slate-400">0</span>
                        <span id="priceOutput" class="bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 px-3 py-1.5 text-[9px] rounded-none">
                            GHS <?php echo number_format($filters['price_max'] ?: 5000000); ?>
                        </span>
                    </div>
                </div>
                
                <hr class="border-slate-100 dark:border-white/5 my-6"/>
                
                <!-- Bedrooms -->
                <div class="mb-8">
                    <div class="mb-4">
                        <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Bedrooms</label>
                        <div class="flex gap-1.5">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bedrooms" value="" class="hidden peer" <?php echo empty($filters['bedrooms']) ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 font-display text-[9px] font-bold tracking-widest uppercase border-2 border-slate-900 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 dark:peer-checked:bg-white dark:peer-checked:text-black dark:peer-checked:border-white">Any</span>
                            </label>
                            <?php foreach([1, 2, 3, 4] as $num): ?>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bedrooms" value="<?php echo $num; ?>" class="hidden peer" <?php echo $filters['bedrooms'] == $num ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 font-display text-[9px] font-bold tracking-widest uppercase border-2 border-slate-900 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 dark:peer-checked:bg-white dark:peer-checked:text-black dark:peer-checked:border-white"><?php echo $num; ?>+</span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Bathrooms -->
                    <div>
                        <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Bathrooms</label>
                        <div class="flex gap-1.5">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bathrooms" value="" class="hidden peer" <?php echo empty($filters['bathrooms']) ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 font-display text-[9px] font-bold tracking-widest uppercase border-2 border-slate-900 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 dark:peer-checked:bg-white dark:peer-checked:text-black dark:peer-checked:border-white">Any</span>
                            </label>
                            <?php foreach([1, 2, 3] as $num): ?>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bathrooms" value="<?php echo $num; ?>" class="hidden peer" <?php echo $filters['bathrooms'] == $num ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 font-display text-[9px] font-bold tracking-widest uppercase border-2 border-slate-900 dark:border-white/10 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 dark:peer-checked:bg-white dark:peer-checked:text-black dark:peer-checked:border-white"><?php echo $num; ?>+</span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Hidden Inputs -->
                <input type="hidden" name="price_min" value="<?php echo htmlspecialchars($filters['price_min']); ?>">

                <button type="submit" class="w-full bg-slate-900 hover:bg-black dark:bg-primary dark:hover:bg-primary-dark text-white dark:text-black font-display text-[10px] font-bold tracking-widest uppercase py-3.5 shadow-md transition-all flex justify-center items-center gap-2 rounded-none">
                    <span class="material-symbols-outlined text-sm">filter_alt</span>
                    Apply Filters
                </button>
            </form>
        </aside>

        <!-- Property Grid -->
        <main class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <?php while($property = $properties->fetch(PDO::FETCH_ASSOC)): ?>
                <!-- Stark brutalist property card -->
                <div class="group bg-white dark:bg-[#151517] rounded-none overflow-hidden border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white hover:shadow-2xl transition-all duration-500 flex flex-col relative">
                    <!-- Overlay Link -->
                    <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="absolute inset-0 z-10">
                        <span class="sr-only">View Details for <?php echo $property['title']; ?></span>
                    </a>

                    <!-- Main Image container -->
                    <div class="relative h-56 overflow-hidden bg-slate-900">
                        <span class="absolute top-4 left-4 bg-slate-900 text-white font-display text-[9px] font-bold tracking-widest px-3 py-1.5 uppercase rounded-none border border-white/10 z-10 shadow-sm">
                            For <?php echo ucfirst($property['listing_type']); ?>
                        </span>
                        <?php 
                        $isSaved = in_array($property['id'], $savedPropertyIds); 
                        ?>
                        <form action="<?php echo BASE_URL; ?>controllers/SavedPropertyController.php?action=toggle" method="POST" class="absolute top-4 right-4 z-20">
                            <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                            <button type="submit" class="p-2 bg-slate-950/70 hover:bg-slate-900 border border-white/10 text-white rounded-full transition-colors <?php echo $isSaved ? 'text-primary' : ''; ?> shadow-sm" title="<?php echo $isSaved ? 'Remove from Saved' : 'Save Property'; ?>">
                                <span class="material-symbols-outlined text-sm flex"><?php echo $isSaved ? 'favorite' : 'favorite_border'; ?></span>
                            </button>
                        </form>
                        <div class="block h-full w-full">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100" 
                                 src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" 
                                 alt="<?php echo $property['title']; ?>"
                                 onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80'">
                        </div>
                    </div>
                    
                    <!-- Content Block -->
                    <div class="p-6 flex-1 flex flex-col justify-between border-t border-slate-100 dark:border-white/5 bg-white dark:bg-[#151517]">
                        <div>
                            <h3 class="font-display font-black text-slate-900 dark:text-white text-lg mb-1 leading-none">
                                <?php echo Helper::formatCurrency($property['price']); ?>
                            </h3>
                            <h4 class="font-display font-bold text-slate-900 dark:text-white text-sm mb-2 uppercase tracking-wide line-clamp-1 group-hover:text-primary-dark transition-colors">
                                <?php echo $property['title']; ?>
                            </h4>
                            <p class="text-slate-400 font-display text-[9px] font-bold tracking-widest uppercase flex items-center gap-1.5 mb-6">
                                <span class="material-symbols-outlined text-slate-400 text-xs">location_on</span>
                                <?php echo $property['city'] . ', ' . $property['state']; ?>
                            </p>
                        </div>
                        
                        <!-- Details row -->
                        <div class="border-t border-slate-100 dark:border-white/5 pt-4 flex justify-between items-center text-slate-500 dark:text-slate-400 font-display text-[9px] font-bold tracking-widest uppercase">
                            <div class="flex items-center gap-1.5" title="Bedrooms">
                                <span class="material-symbols-outlined text-slate-400 text-sm">bed</span>
                                <span><?php echo $property['bedrooms']; ?> Beds</span>
                            </div>
                            <div class="flex items-center gap-1.5" title="Bathrooms">
                                <span class="material-symbols-outlined text-slate-400 text-sm">bathtub</span>
                                <span><?php echo $property['bathrooms']; ?> Baths</span>
                            </div>
                            <div class="flex items-center gap-1.5" title="Square Footage">
                                <span class="material-symbols-outlined text-slate-400 text-sm">square_foot</span>
                                <span><?php echo $property['area_sqft']; ?> sqft</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            
            <?php if($properties->rowCount() == 0): ?>
            <div class="text-center py-20 bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10">
                <span class="material-symbols-outlined text-5xl text-slate-300 dark:text-slate-600 mb-4 block">search_off</span>
                <h3 class="font-display text-sm font-black tracking-widest uppercase text-slate-900 dark:text-white">No properties found</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 font-light">Try adjusting your filters to find what you're looking for.</p>
            </div>
            <?php endif; ?>

            <!-- Pagination (Static Brutalist squares) -->
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button class="w-10 h-10 flex items-center justify-center border-2 border-slate-200 dark:border-white/10 text-slate-400 hover:border-slate-900 dark:hover:border-white transition-colors rounded-none" disabled>
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center border-2 border-slate-900 dark:border-white bg-slate-900 dark:bg-white text-white dark:text-black font-display text-[10px] font-bold rounded-none">1</button>
                    <button class="w-10 h-10 flex items-center justify-center border-2 border-slate-200 dark:border-white/10 text-slate-500 hover:border-slate-900 dark:hover:border-white hover:text-slate-900 dark:hover:text-white transition-colors rounded-none">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </nav>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
