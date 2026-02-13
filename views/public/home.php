<?php 
include __DIR__ . '/../layouts/header.php'; 
require_once __DIR__ . '/../../models/Property.php';

// Fetch featured properties
$propertyModel = new Property();
$featuredProperties = $propertyModel->read(); // In real app, consider adding a limit or is_featured filter
?>

<!-- Hero Section -->
<header class="relative pt-20 h-[650px] flex items-center justify-center bg-slate-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDnp5Itr32QkH9icJmdUDcQod0jKm9uN5SW9Sm2LzAUf-a6JhcWGCcq_CrV8H3a9Bw7i9kN0Gzp4l6umj6a_A92tzTUSKQFZ_IUoQTv21hHz-XjlgLRdAwyAr4iasqWgA4f9TJDOMCl5F58Ejj2jCj3xZMnHBHo1X9n903tSrnb8Fq5LA_E0fmOGVYufF1Yga-RwgqBnaytI5QX1BkDYnaJapOFYgshi4nG33hpTFG8yVqEA2t2xfMHZhz6E9FEImHlchsSjiVJTd0" class="w-full h-full object-cover opacity-50 mix-blend-overlay" alt="Hero Background">
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/80 via-transparent to-transparent"></div>
    </div>
    
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight drop-shadow-lg">
            Find Your Dream <span class="text-primary">Property</span>
        </h1>
        <p class="text-lg md:text-xl text-slate-200 mb-10 max-w-2xl drop-shadow-md mx-auto">
            Discover the perfect home from our exclusive collection of premium listings tailored to your lifestyle.
        </p>

        <!-- Search Box -->
        <div class="w-full max-w-5xl bg-white dark:bg-slate-900 rounded-xl shadow-2xl p-4 md:p-6 transform transition-all hover:scale-[1.01]">
            <form action="<?php echo BASE_URL; ?>views/public/properties.php" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <!-- Location -->
                <div class="relative group text-left">
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider">Location</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 group-focus-within:text-primary transition-colors">place</span>
                        <input name="location" class="w-full pl-10 pr-4 py-2.5 bg-background-light dark:bg-slate-800 border-0 rounded text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary focus:bg-white dark:focus:bg-slate-800 transition-all font-medium" placeholder="City, Zip..." type="text"/>
                    </div>
                </div>
                <!-- Property Type -->
                <div class="relative group text-left">
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider">Property Type</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 group-focus-within:text-primary transition-colors">home</span>
                        <select name="property_type" class="w-full pl-10 pr-4 py-2.5 bg-background-light dark:bg-slate-800 border-0 rounded text-slate-900 dark:text-white focus:ring-2 focus:ring-primary cursor-pointer appearance-none font-medium">
                            <option value="">All Types</option>
                            <option value="house">House</option>
                            <option value="apartment">Apartment</option>
                            <option value="land">Land</option>
                            <option value="commercial">Commercial</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-slate-400 pointer-events-none text-sm">expand_more</span>
                    </div>
                </div>
                <!-- Price Range -->
                <div class="relative group text-left">
                    <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1 uppercase tracking-wider">Price Range</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 group-focus-within:text-primary transition-colors">attach_money</span>
                        <select name="price_range" class="w-full pl-10 pr-4 py-2.5 bg-background-light dark:bg-slate-800 border-0 rounded text-slate-900 dark:text-white focus:ring-2 focus:ring-primary cursor-pointer appearance-none font-medium">
                            <option value="">Any Price</option>
                            <option value="0-5000">GHS 0 - 5,000</option>
                            <option value="5000-20000">GHS 5,000 - 20,000</option>
                            <option value="20000+">GHS 20,000+</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-slate-400 pointer-events-none text-sm">expand_more</span>
                    </div>
                </div>
                <!-- Search Button -->
                <div>
                    <button class="w-full py-2 px-6 bg-primary hover:bg-primary-dark text-white rounded-lg font-semibold shadow-lg shadow-primary/30 flex items-center justify-center gap-2 transition-all transform hover:-translate-y-0.5 active:scale-95" type="submit">
                        <span class="material-symbols-outlined">search</span>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>

<!-- Why Choose Us -->
<section class="py-20 bg-white dark:bg-background-dark relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary font-semibold tracking-wider uppercase text-sm">Our Features</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mt-2">Why Choose Prime Estate?</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="p-8 rounded-xl bg-background-light dark:bg-slate-800/50 hover:shadow-xl transition-shadow border border-transparent hover:border-slate-100 dark:hover:border-slate-700 text-center group">
                <div class="w-16 h-16 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined text-primary text-3xl">domain</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Wide Range of Properties</h3>
                <p class="text-slate-600 dark:text-slate-400">Access thousands of premium listings across the most desirable locations in the country.</p>
            </div>
            <!-- Card 2 -->
            <div class="p-8 rounded-xl bg-background-light dark:bg-slate-800/50 hover:shadow-xl transition-shadow border border-transparent hover:border-slate-100 dark:hover:border-slate-700 text-center group">
                <div class="w-16 h-16 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined text-primary text-3xl">verified_user</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Trusted Security</h3>
                <p class="text-slate-600 dark:text-slate-400">We verify every property and agent to ensure your real estate journey is safe and secure.</p>
            </div>
            <!-- Card 3 -->
            <div class="p-8 rounded-xl bg-background-light dark:bg-slate-800/50 hover:shadow-xl transition-shadow border border-transparent hover:border-slate-100 dark:hover:border-slate-700 text-center group">
                <div class="w-16 h-16 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <span class="material-symbols-outlined text-primary text-3xl">support_agent</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">24/7 Support</h3>
                <p class="text-slate-600 dark:text-slate-400">Our dedicated support team is available around the clock to assist with your inquiries.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<section class="py-20 bg-background-light dark:bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <span class="text-primary font-semibold tracking-wider uppercase text-sm">Best Choices</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mt-2">Featured Properties</h2>
            </div>
            <a class="text-primary hover:text-primary-dark font-medium flex items-center gap-1 group" href="<?php echo BASE_URL; ?>views/public/properties.php">
                View All Properties 
                <span class="material-symbols-outlined text-sm transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $count = 0;
            while($property = $featuredProperties->fetch(PDO::FETCH_ASSOC)): 
                if($count >= 3) break; 
                $count++;
            ?>
            <!-- Property Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="relative h-64 overflow-hidden">
                    <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" alt="<?php echo $property['title']; ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-<?php echo $property['listing_type'] == 'sale' ? 'red-500' : 'green-500'; ?> text-white text-xs font-bold px-3 py-1.5 rounded uppercase tracking-wide">
                        For <?php echo ucfirst($property['listing_type']); ?>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white line-clamp-1">
                                <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="hover:text-primary transition-colors">
                                    <?php echo $property['title']; ?>
                                </a>
                            </h3>
                            <div class="flex items-center text-slate-500 dark:text-slate-400 text-sm mt-1 gap-1">
                                <span class="material-symbols-outlined text-sm">location_on</span>
                                <?php echo $property['city']; ?>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-primary font-bold text-lg"><?php echo Helper::formatCurrency($property['price']); ?></p>
                        </div>
                    </div>
                    <div class="border-t border-slate-100 dark:border-slate-700 pt-4 flex justify-between text-slate-500 dark:text-slate-400 text-sm">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-primary/70 text-lg">bed</span>
                            <span><?php echo $property['bedrooms']; ?> Beds</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-primary/70 text-lg">bathtub</span>
                            <span><?php echo $property['bathrooms']; ?> Baths</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-primary/70 text-lg">square_foot</span>
                            <span><?php echo $property['area_sqft']; ?> sqft</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- How It Works & Stats -->
<section class="py-20 bg-white dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary font-semibold tracking-wider uppercase text-sm">Workflow</span>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mt-2">How It Works</h2>
        </div>
        <!-- Steps -->
        <div class="relative mb-24">
            <!-- Connector Line -->
            <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-slate-800 -translate-y-1/2 z-0"></div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-primary text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-primary/30 mb-4 border-4 border-white dark:border-background-dark">1</div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Search</h4>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Browse thousands of properties to find your match.</p>
                </div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-white dark:bg-slate-800 border-2 border-primary text-primary flex items-center justify-center text-xl font-bold mb-4 border-4 border-white dark:border-background-dark">2</div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">View</h4>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Schedule a visit and inspect properties personally.</p>
                </div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-white dark:bg-slate-800 border-2 border-primary text-primary flex items-center justify-center text-xl font-bold mb-4 border-4 border-white dark:border-background-dark">3</div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Book</h4>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Secure your choice with a simple booking process.</p>
                </div>
                <!-- Step 4 -->
                <div class="flex flex-col items-center text-center">
                    <div class="w-14 h-14 rounded-full bg-white dark:bg-slate-800 border-2 border-primary text-primary flex items-center justify-center text-xl font-bold mb-4 border-4 border-white dark:border-background-dark">4</div>
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Pay</h4>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Complete the transaction securely and move in.</p>
                </div>
            </div>
        </div>
        <!-- Stats -->
        <div class="bg-primary rounded-xl p-12 text-white shadow-2xl shadow-primary/30">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/20">
                <div class="px-4">
                    <p class="text-4xl md:text-5xl font-bold mb-2">500+</p>
                    <p class="text-sm md:text-base opacity-80 uppercase tracking-wide">Properties Sold</p>
                </div>
                <div class="px-4">
                    <p class="text-4xl md:text-5xl font-bold mb-2">450+</p>
                    <p class="text-sm md:text-base opacity-80 uppercase tracking-wide">Happy Clients</p>
                </div>
                <div class="px-4">
                    <p class="text-4xl md:text-5xl font-bold mb-2">80+</p>
                    <p class="text-sm md:text-base opacity-80 uppercase tracking-wide">Awards Won</p>
                </div>
                <div class="px-4">
                    <p class="text-4xl md:text-5xl font-bold mb-2">20+</p>
                    <p class="text-sm md:text-base opacity-80 uppercase tracking-wide">Years Active</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
