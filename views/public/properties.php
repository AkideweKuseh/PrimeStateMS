<?php 
require_once __DIR__ . '/../layouts/header.php'; 
require_once __DIR__ . '/../../models/Property.php';

// Initialize Property Model
$propertyModel = new Property();

// Get Filters
$filters = [
    'location' => $_GET['location'] ?? '',
    'property_type' => $_GET['property_type'] ?? '',
    'price_max' => $_GET['price_max'] ?? '',
    'bedrooms' => $_GET['bedrooms'] ?? '',
    'bathrooms' => $_GET['bathrooms'] ?? ''
];

// Fetch Properties
$properties = $propertyModel->read($filters);
?>

<!-- Header / Breadcrumb -->
<header class="bg-white dark:bg-[#1a1429] border-b border-slate-200 dark:border-slate-800 py-8 pt-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Browse Properties</h1>
                <nav class="flex text-sm font-medium text-slate-500 dark:text-slate-400">
                    <a class="hover:text-primary" href="<?php echo BASE_URL; ?>">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-primary">Properties</span>
                </nav>
            </div>
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <span>Sort by:</span>
                <select class="form-select bg-transparent border-slate-200 dark:border-slate-700 rounded-lg text-slate-900 dark:text-white focus:ring-primary focus:border-primary text-sm py-2 pl-3 pr-8 cursor-pointer">
                    <option>Newest Listed</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full lg:w-1/4 flex-shrink-0">
            <form action="<?php echo BASE_URL; ?>views/public/properties.php" method="GET" class="bg-white dark:bg-[#1a1429] rounded-xl border border-slate-200 dark:border-slate-800 p-6 sticky top-24 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Filters</h2>
                    <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="text-sm text-primary hover:underline font-medium">Reset</a>
                </div>
                
                <!-- Location Search -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Location</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400">search</span>
                        <input type="text" name="location" value="<?php echo htmlspecialchars($filters['location']); ?>" class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm transition-shadow" placeholder="City, Zip, Address...">
                    </div>
                </div>
                
                <hr class="border-slate-100 dark:border-slate-800 my-6"/>
                
                <!-- Property Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Property Type</label>
                    <div class="space-y-3">
                        <?php 
                        $types = ['house' => 'House', 'apartment' => 'Apartment', 'office' => 'Office', 'villa' => 'Villa', 'land' => 'Land'];
                        foreach($types as $val => $label):
                        ?>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="property_type" value="<?php echo $val; ?>" <?php echo $filters['property_type'] === $val ? 'checked' : ''; ?> class="rounded border-slate-300 text-primary focus:ring-primary/20 w-4 h-4"/>
                            <span class="text-sm text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors"><?php echo $label; ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <hr class="border-slate-100 dark:border-slate-800 my-6"/>
                
                <!-- Price Range -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-4">Max Price (GHS)</label>
                    <input type="range" name="price_max" min="0" max="5000000" step="50000" value="<?php echo $filters['price_max'] ?: '5000000'; ?>" class="w-full h-1 bg-slate-200 rounded-lg appearance-none cursor-pointer dark:bg-slate-700 mb-4" oninput="document.getElementById('priceOutput').innerText = 'GHS ' + parseInt(this.value).toLocaleString()">
                    <div class="flex items-center justify-between text-sm font-medium text-slate-900 dark:text-white">
                        <span class="text-slate-400">0</span>
                        <span id="priceOutput" class="bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-slate-700 px-3 py-1.5 rounded text-xs">
                            GHS <?php echo number_format($filters['price_max'] ?: 5000000); ?>
                        </span>
                    </div>
                </div>
                
                <hr class="border-slate-100 dark:border-slate-800 my-6"/>
                
                <!-- Bedrooms -->
                <div class="mb-8">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Bedrooms</label>
                        <div class="flex gap-2">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bedrooms" value="" class="hidden peer" <?php echo empty($filters['bedrooms']) ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 text-sm border border-slate-200 dark:border-slate-700 rounded hover:border-primary hover:text-primary dark:hover:border-primary transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-primary/10 peer-checked:border-primary peer-checked:text-primary font-medium">Any</span>
                            </label>
                            <?php foreach([1, 2, 3, 4] as $num): ?>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bedrooms" value="<?php echo $num; ?>" class="hidden peer" <?php echo $filters['bedrooms'] == $num ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 text-sm border border-slate-200 dark:border-slate-700 rounded hover:border-primary hover:text-primary dark:hover:border-primary transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-primary/10 peer-checked:border-primary peer-checked:text-primary font-medium"><?php echo $num; ?>+</span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Bathrooms -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Bathrooms</label>
                        <div class="flex gap-2">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bathrooms" value="" class="hidden peer" <?php echo empty($filters['bathrooms']) ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 text-sm border border-slate-200 dark:border-slate-700 rounded hover:border-primary hover:text-primary dark:hover:border-primary transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-primary/10 peer-checked:border-primary peer-checked:text-primary font-medium">Any</span>
                            </label>
                            <?php foreach([1, 2, 3] as $num): ?>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="bathrooms" value="<?php echo $num; ?>" class="hidden peer" <?php echo $filters['bathrooms'] == $num ? 'checked' : ''; ?>>
                                <span class="block text-center py-1.5 text-sm border border-slate-200 dark:border-slate-700 rounded hover:border-primary hover:text-primary dark:hover:border-primary transition-colors text-slate-600 dark:text-slate-400 peer-checked:bg-primary/10 peer-checked:border-primary peer-checked:text-primary font-medium"><?php echo $num; ?>+</span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-medium py-2 rounded-lg shadow-lg shadow-primary/20 transition-all flex justify-center items-center gap-2">
                    <span class="material-symbols-outlined text-sm">filter_alt</span>
                    Apply Filters
                </button>
            </form>
        </aside>

        <!-- Property Grid -->
        <main class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                <?php while($property = $properties->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="group bg-white dark:bg-[#1a1429] rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col relative">
                    <!-- Overlay Link -->
                    <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="absolute inset-0 z-10">
                        <span class="sr-only">View Details for <?php echo $property['title']; ?></span>
                    </a>

                    <div class="relative h-48 overflow-hidden">
                        <span class="absolute top-3 left-3 bg-white dark:bg-background-dark text-slate-900 dark:text-white text-xs font-bold px-3 py-1 rounded-full z-10 shadow-sm uppercase tracking-wide">
                            For <?php echo ucfirst($property['listing_type']); ?>
                        </span>
                        <div class="block h-full">
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                 src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" 
                                 alt="<?php echo $property['title']; ?>"
                                 onerror="this.src='https://via.placeholder.com/600x400?text=Property+Image'">
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-primary font-bold text-lg mb-1">
                            <?php echo Helper::formatCurrency($property['price']); ?>
                        </h3>
                        <h4 class="font-bold text-slate-900 dark:text-white text-lg mb-1 line-clamp-1 group-hover:text-primary transition-colors">
                            <?php echo $property['title']; ?>
                        </h4>
                        <p class="text-slate-500 dark:text-slate-400 text-sm mb-4 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <?php echo $property['city'] . ', ' . $property['state']; ?>
                        </p>
                        
                        <div class="mt-auto border-t border-slate-100 dark:border-slate-800 pt-4 flex justify-between items-center text-slate-600 dark:text-slate-300 text-sm">
                            <div class="flex items-center gap-1" title="Bedrooms">
                                <span class="material-symbols-outlined text-slate-400">bed</span>
                                <span><?php echo $property['bedrooms']; ?></span>
                            </div>
                            <div class="flex items-center gap-1" title="Bathrooms">
                                <span class="material-symbols-outlined text-slate-400">bathtub</span>
                                <span><?php echo $property['bathrooms']; ?></span>
                            </div>
                            <div class="flex items-center gap-1" title="Square Footage">
                                <span class="material-symbols-outlined text-slate-400">square_foot</span>
                                <span><?php echo $property['area_sqft']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            
            <?php if($properties->rowCount() == 0): ?>
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-6xl text-slate-300 dark:text-slate-600 mb-4">search_off</span>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">No properties found</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-2">Try adjusting your filters to find what you're looking for.</p>
            </div>
            <?php endif; ?>

            <!-- Pagination (Static for now) -->
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button class="p-2 rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:border-primary hover:text-primary transition-colors" disabled>
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </button>
                    <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-medium shadow-lg shadow-primary/30">1</button>
                    <button class="p-2 rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:border-primary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </button>
                </nav>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
