<?php 
$no_header_padding = true;
include __DIR__ . '/../layouts/header.php'; 
require_once __DIR__ . '/../../models/Property.php';

// Fetch featured properties
$propertyModel = new Property();
$featuredProperties = $propertyModel->read();
?>

<!-- Hero Section (Luxury Brutalist Mountain Architecture Theme) -->
<header class="relative h-screen min-h-[750px] flex items-center justify-center bg-charcoal overflow-hidden pt-0">
    <!-- Main High-Quality Mountainside Brutalist Concrete Home image -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover opacity-85" alt="Luxury Mountain Brutalist Architecture Background">
        <!-- Faint Dark Vignette & Gradient Overlays -->
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-transparent to-black/35 z-10"></div>
        <div class="absolute inset-0 bg-charcoal/10 z-10"></div>
    </div>
    
    <!-- Thin Vertical Architectural Gridlines Overlay -->
    <div class="absolute inset-x-0 inset-y-0 z-20 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-white/5"></div>
        <div class="w-px h-full bg-white/5"></div>
        <div class="w-px h-full bg-white/5"></div>
        <div class="w-px h-full bg-white/5"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-30 w-full max-w-7xl mx-auto px-6 lg:px-8 h-full flex flex-col justify-between pt-36 pb-12">
        <!-- Massive Uppercase Title Layout (Matches exact visual flow of screenshot 2) -->
        <div class="max-w-4xl mt-12 select-none">
            <h1 class="font-arch text-6xl md:text-8xl lg:text-[105px] font-black text-white leading-[0.8] tracking-tighter uppercase">
                FIND YOUR<br>DREAM<br>PROPERTY
            </h1>
        </div>

        <!-- Sleek Search Filter Widget (Glassmorphic brutalist row) -->
        <div class="w-full glass-panel p-5 border border-white/10 rounded-none shadow-2xl my-8">
            <form action="<?php echo BASE_URL; ?>views/public/properties.php" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <!-- Location -->
                <div class="relative text-left">
                    <label class="block font-display text-[9px] font-bold text-white/55 mb-1.5 uppercase tracking-widest">Location</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-white/40 text-sm flex items-center justify-center pointer-events-none">place</span>
                        <input name="location" class="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 text-white placeholder-white/30 text-xs focus:ring-1 focus:ring-primary focus:border-primary transition-all font-medium rounded-none" placeholder="City, Zip..." type="text"/>
                    </div>
                </div>
                <!-- Property Type -->
                <div class="relative text-left">
                    <label class="block font-display text-[9px] font-bold text-white/55 mb-1.5 uppercase tracking-widest">Property Type</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-white/40 text-sm flex items-center justify-center pointer-events-none">home</span>
                        <select name="property_type" class="w-full pl-10 pr-8 py-3 bg-white/5 border border-white/10 text-white text-xs focus:ring-1 focus:ring-primary cursor-pointer appearance-none font-medium rounded-none">
                            <option value="" class="bg-charcoal">All Types</option>
                            <option value="house" class="bg-charcoal">House</option>
                            <option value="apartment" class="bg-charcoal">Apartment</option>
                            <option value="land" class="bg-charcoal">Land</option>
                            <option value="commercial" class="bg-charcoal">Commercial</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-white/40 pointer-events-none text-xs flex items-center justify-center">expand_more</span>
                    </div>
                </div>
                <!-- Price Range -->
                <div class="relative text-left">
                    <label class="block font-display text-[9px] font-bold text-white/55 mb-1.5 uppercase tracking-widest">Price Range</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-white/40 text-sm flex items-center justify-center pointer-events-none">attach_money</span>
                        <select name="price_range" class="w-full pl-10 pr-8 py-3 bg-white/5 border border-white/10 text-white text-xs focus:ring-1 focus:ring-primary cursor-pointer appearance-none font-medium rounded-none">
                            <option value="" class="bg-charcoal">Any Price</option>
                            <option value="0-5000" class="bg-charcoal">GHS 0 - 5,000</option>
                            <option value="5000-20000" class="bg-charcoal">GHS 5,000 - 20,000</option>
                            <option value="20000+" class="bg-charcoal">GHS 20,000+</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-white/40 pointer-events-none text-xs flex items-center justify-center">expand_more</span>
                    </div>
                </div>
                <!-- Search Button -->
                <div>
                    <button class="w-full py-3 px-6 bg-primary hover:bg-primary-dark text-black rounded-none font-display text-[10px] font-bold tracking-widest uppercase flex items-center justify-center gap-2 transition-all transform active:scale-95" type="submit">
                        <span class="material-symbols-outlined text-xs flex items-center justify-center">search</span>
                        Search Listings
                    </button>
                </div>
            </form>
        </div>

        <!-- Bottom Layout Row (Matches exactly the layout blocks from screenshot 2) -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8 pt-4">
            <!-- Left Bottom: Black Blueprint Wireframe Detail Box -->
            <div class="w-full lg:w-[360px] bg-black/95 border border-white/15 p-6 rounded-none flex gap-6 items-center">
                <!-- House Area Blueprint SVG -->
                <div class="w-20 h-20 border border-white/10 flex items-center justify-center relative flex-shrink-0 bg-white/5">
                    <svg viewBox="0 0 100 100" class="w-16 h-16 stroke-white/60 fill-none stroke-[0.8] opacity-90">
                        <!-- Base grid / blueprint helper lines -->
                        <line x1="10" y1="75" x2="90" y2="75" class="stroke-white/10" />
                        <line x1="50" y1="15" x2="50" y2="85" class="stroke-white/10" />
                        <!-- Isometric Box (First floor) -->
                        <polygon points="50,75 80,60 80,45 50,60" />
                        <polygon points="50,75 20,60 20,45 50,60" />
                        <polygon points="50,60 80,45 50,30 20,45" />
                        <!-- Isometric Box (Second floor shifted) -->
                        <polygon points="50,45 70,35 70,25 50,35" />
                        <polygon points="50,45 30,35 30,25 50,35" />
                        <polygon points="50,35 70,25 50,15 30,25" />
                        <!-- Architectural grid extension lines -->
                        <line x1="20" y1="60" x2="20" y2="75" class="stroke-white/20 stroke-dasharray-[2,2]" />
                        <line x1="80" y1="60" x2="80" y2="75" class="stroke-white/20 stroke-dasharray-[2,2]" />
                    </svg>
                </div>
                <div class="flex-1 flex flex-col justify-between h-20">
                    <div>
                        <p class="text-[9px] font-display font-bold text-slate-400 uppercase tracking-widest mb-0.5">House Area:</p>
                        <h4 class="font-display font-black text-3xl text-white tracking-tighter leading-none uppercase">160 M²</h4>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="leading-tight">
                            <span class="text-[9px] font-display font-bold text-white uppercase tracking-widest block">House Type C</span>
                            <span class="text-[9px] font-display font-semibold text-slate-400 uppercase tracking-widest block">- Comfort Line</span>
                        </div>
                        <!-- Circle Arrow Controls -->
                        <div class="flex gap-1.5">
                            <div class="w-6 h-6 rounded-full border border-white/20 flex items-center justify-center text-[10px] text-white hover:border-white transition cursor-pointer select-none">&lt;</div>
                            <div class="w-6 h-6 rounded-full border border-white/20 flex items-center justify-center text-[10px] text-white hover:border-white transition cursor-pointer select-none">&gt;</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Bottom: Ghana Map Outline / Floating Previews / Poetic Text -->
            <div class="flex-1 flex flex-col md:flex-row justify-end items-start md:items-end gap-12 w-full">
                <!-- Map Outline SVG (USA layout from Screenshot 2 with Montana highlighted in Neon Blue) -->
                <div class="w-36 h-24 flex items-center justify-center opacity-85 flex-shrink-0">
                    <svg viewBox="0 0 160 100" class="w-36 h-24 stroke-white/40 fill-none stroke-[0.8]">
                        <!-- USA main land boundary -->
                        <path d="M 12 25 C 25 22, 35 25, 45 20 C 55 18, 65 24, 75 22 C 85 20, 95 18, 105 20 C 115 22, 125 15, 135 20 C 142 24, 148 30, 150 40 C 152 50, 145 60, 142 65 C 138 70, 134 68, 130 72 C 125 76, 122 80, 118 82 C 112 85, 105 82, 100 80 C 95 78, 92 84, 88 84 C 84 84, 82 78, 78 76 C 74 74, 70 78, 68 76 C 65 74, 62 68, 58 68 C 54 68, 52 72, 48 72 C 44 72, 42 66, 38 65 C 34 64, 30 68, 25 65 C 22 62, 25 55, 22 50 C 18 45, 10 40, 12 35 C 14 30, 8 28, 12 25 Z" class="stroke-white/20" />
                        <!-- State boundaries (abstracted lines) -->
                        <path d="M 30,24 L 32,45" class="stroke-white/10" />
                        <path d="M 50,20 L 52,50" class="stroke-white/10" />
                        <path d="M 80,21 L 78,52" class="stroke-white/10" />
                        <path d="M 105,20 L 102,55" class="stroke-white/10" />
                        <!-- Highlighted State (Montana-ish Northwest area) in Bright Blue -->
                        <polygon points="40,22 55,20 53,28 38,29" class="fill-[#38BDF8]/90 stroke-[#38BDF8] stroke-1" />
                    </svg>
                </div>
                <!-- Native App Subtitle Wording and Thumbnail Previews -->
                <div class="max-w-xs flex flex-col justify-between h-24 text-left">
                    <p class="text-[10px] text-slate-300 leading-relaxed font-light uppercase tracking-wider">
                        Discover the perfect home from our exclusive collection of premium listings tailored to your lifestyle.
                    </p>
                    <!-- Overlapping thumbnails -->
                    <div class="flex items-center -space-x-3.5">
                        <img class="w-8 h-8 rounded-full border border-black object-cover shadow-lg" src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=100&q=80" alt="Interior Detail 1">
                        <img class="w-8 h-8 rounded-full border border-black object-cover shadow-lg" src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=100&q=80" alt="Interior Detail 2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Why Choose Us Section (Warm Alabaster background) -->
<section class="py-24 bg-neutral-light relative overflow-hidden">
    <!-- Faint blueprint lines layout -->
    <div class="absolute inset-0 blueprint-grid-light opacity-[0.4] pointer-events-none"></div>
    <!-- Vertical faint layout gridlines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-slate-200/50"></div>
        <div class="w-px h-full bg-slate-200/50"></div>
        <div class="w-px h-full bg-slate-200/50"></div>
        <div class="w-px h-full bg-slate-200/50"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-20 gap-6">
            <div>
                <span class="text-primary-dark font-display text-[10px] font-bold tracking-[0.25em] uppercase block mb-2">SYSTEM REDEFINED</span>
                <h2 class="font-display text-4xl md:text-5xl font-black text-slate-900 tracking-tighter uppercase leading-none">
                    WHY CHOOSE PRIME ESTATE?
                </h2>
            </div>
            <p class="max-w-sm text-xs text-slate-500 leading-relaxed font-light">
                Leveraging high-end digital workflows and unmatched architecture to secure your real estate investment.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="p-10 bg-white border border-slate-200/60 rounded-none shadow-sm hover:shadow-xl transition-all duration-500 group flex flex-col justify-between min-h-[250px]">
                <div class="w-12 h-12 border border-slate-900/10 flex items-center justify-center mb-6 group-hover:bg-primary transition-all duration-500">
                    <span class="material-symbols-outlined text-slate-900 text-lg group-hover:scale-110 transition-transform">domain</span>
                </div>
                <div>
                    <h3 class="font-display text-base font-bold text-slate-900 tracking-wider uppercase mb-3">Wide Range of Properties</h3>
                    <p class="text-xs text-slate-500 leading-relaxed font-light">Access thousands of premium listings across the most desirable locations in the country.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="p-10 bg-white border border-slate-200/60 rounded-none shadow-sm hover:shadow-xl transition-all duration-500 group flex flex-col justify-between min-h-[250px]">
                <div class="w-12 h-12 border border-slate-900/10 flex items-center justify-center mb-6 group-hover:bg-primary transition-all duration-500">
                    <span class="material-symbols-outlined text-slate-900 text-lg group-hover:scale-110 transition-transform">verified_user</span>
                </div>
                <div>
                    <h3 class="font-display text-base font-bold text-slate-900 tracking-wider uppercase mb-3">Trusted Security</h3>
                    <p class="text-xs text-slate-500 leading-relaxed font-light">We verify every property and agent to ensure your real estate journey is safe and secure.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="p-10 bg-white border border-slate-200/60 rounded-none shadow-sm hover:shadow-xl transition-all duration-500 group flex flex-col justify-between min-h-[250px]">
                <div class="w-12 h-12 border border-slate-900/10 flex items-center justify-center mb-6 group-hover:bg-primary transition-all duration-500">
                    <span class="material-symbols-outlined text-slate-900 text-lg group-hover:scale-110 transition-transform">support_agent</span>
                </div>
                <div>
                    <h3 class="font-display text-base font-bold text-slate-900 tracking-wider uppercase mb-3">24/7 Support</h3>
                    <p class="text-xs text-slate-500 leading-relaxed font-light">Our dedicated support team is available around the clock to assist with your inquiries.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Properties Section -->
<section class="py-24 bg-white relative">
    <!-- Vertical faint layout gridlines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-slate-100"></div>
        <div class="w-px h-full bg-slate-100"></div>
        <div class="w-px h-full bg-slate-100"></div>
        <div class="w-px h-full bg-slate-100"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6">
            <div>
                <span class="text-primary-dark font-display text-[10px] font-bold tracking-[0.25em] uppercase block mb-2">BEST CHOICES</span>
                <h2 class="font-display text-4xl md:text-5xl font-black text-slate-900 tracking-tighter uppercase leading-none">
                    FEATURED LISTINGS
                </h2>
            </div>
            <a class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-900 hover:text-primary-dark transition-colors flex items-center gap-1.5 group border-b border-slate-900 pb-1" href="<?php echo BASE_URL; ?>views/public/properties.php">
                View All Properties 
                <span class="material-symbols-outlined text-xs transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $count = 0;
            while($property = $featuredProperties->fetch(PDO::FETCH_ASSOC)): 
                if($count >= 3) break; 
                $count++;
            ?>
            <!-- Property Card (Crisp Minimalist Layout) -->
            <div class="bg-neutral-light border border-slate-200/50 rounded-none overflow-hidden hover:shadow-2xl transition-all duration-500 group flex flex-col justify-between">
                <div class="relative h-72 overflow-hidden bg-slate-900">
                    <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" alt="<?php echo $property['title']; ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                    <div class="absolute top-4 left-4 bg-slate-900 text-white font-display text-[9px] font-bold tracking-widest px-3.5 py-1.5 uppercase rounded-none border border-white/10">
                        For <?php echo ucfirst($property['listing_type']); ?>
                    </div>
                </div>
                <div class="p-8 bg-white border-t border-slate-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1 pr-4">
                            <h3 class="font-display text-base font-bold text-slate-900 tracking-wider uppercase line-clamp-1">
                                <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="hover:text-primary-dark transition-colors">
                                    <?php echo $property['title']; ?>
                                </a>
                            </h3>
                            <div class="flex items-center text-slate-400 text-xs mt-1.5 gap-1.5">
                                <span class="material-symbols-outlined text-sm text-slate-400">location_on</span>
                                <?php echo $property['city']; ?>, <?php echo $property['state']; ?>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-display font-black text-slate-900 text-lg leading-none"><?php echo Helper::formatCurrency($property['price']); ?></p>
                        </div>
                    </div>
                    <div class="border-t border-slate-100 pt-5 mt-6 flex justify-between text-slate-400 font-display text-[9px] font-bold tracking-widest uppercase">
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-slate-400 text-sm">bed</span>
                            <span><?php echo $property['bedrooms']; ?> Beds</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-slate-400 text-sm">bathtub</span>
                            <span><?php echo $property['bathrooms']; ?> Baths</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-slate-400 text-sm">square_foot</span>
                            <span><?php echo $property['area_sqft']; ?> sqft</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- How It Works & Stats Section (Neutral cream background) -->
<section class="py-24 bg-neutral-light relative">
    <div class="absolute inset-0 blueprint-grid-light opacity-[0.25] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20">
            <span class="text-primary-dark font-display text-[10px] font-bold tracking-[0.25em] uppercase block mb-2">SYSTEM WORKFLOW</span>
            <h2 class="font-display text-4xl md:text-5xl font-black text-slate-900 tracking-tighter uppercase leading-none">
                HOW IT WORKS
            </h2>
        </div>
        
        <!-- Aligned Steps Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-24 relative">
            <!-- Step 1 -->
            <div class="flex flex-col items-start p-8 bg-white border border-slate-200/50 rounded-none relative">
                <div class="font-display font-black text-5xl text-slate-200 mb-6 select-none">01</div>
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase mb-2">Search</h4>
                <p class="text-xs text-slate-500 leading-relaxed font-light">Browse thousands of properties to find your perfect architectural match.</p>
            </div>
            <!-- Step 2 -->
            <div class="flex flex-col items-start p-8 bg-white border border-slate-200/50 rounded-none relative">
                <div class="font-display font-black text-5xl text-slate-200 mb-6 select-none">02</div>
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase mb-2">View</h4>
                <p class="text-xs text-slate-500 leading-relaxed font-light">Schedule a seamless, highly structured viewing at your convenience.</p>
            </div>
            <!-- Step 3 -->
            <div class="flex flex-col items-start p-8 bg-white border border-slate-200/50 rounded-none relative">
                <div class="font-display font-black text-5xl text-slate-200 mb-6 select-none">03</div>
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase mb-2">Book</h4>
                <p class="text-xs text-slate-500 leading-relaxed font-light">Secure your chosen lease or property with a direct digital booking process.</p>
            </div>
            <!-- Step 4 -->
            <div class="flex flex-col items-start p-8 bg-white border border-slate-200/50 rounded-none relative">
                <div class="font-display font-black text-5xl text-slate-200 mb-6 select-none">04</div>
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase mb-2">Pay</h4>
                <p class="text-xs text-slate-500 leading-relaxed font-light">Complete transaction logs securely and prepare for effortless move-in.</p>
            </div>
        </div>

        <!-- System Stats Bar (Solid Charcoal/Yellow container) -->
        <div class="bg-charcoal text-white rounded-none p-12 border border-white/5 relative overflow-hidden">
            <div class="absolute inset-0 blueprint-grid opacity-[0.08] pointer-events-none"></div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10 relative z-10">
                <div class="px-4">
                    <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">500+</p>
                    <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Properties Managed</p>
                </div>
                <div class="px-4">
                    <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">450+</p>
                    <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Happy Residents</p>
                </div>
                <div class="px-4">
                    <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">80+</p>
                    <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Design Awards</p>
                </div>
                <div class="px-4">
                    <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">20+</p>
                    <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Years Active</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
