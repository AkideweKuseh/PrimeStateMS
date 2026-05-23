<?php include __DIR__ . '/../layouts/header.php'; ?>

<!-- Page Banner (Luxury Charcoal Architectural Banner) -->
<header class="bg-charcoal text-white py-20 pt-36 relative overflow-hidden border-b border-white/10">
    <!-- Faint blueprint grid overlay -->
    <div class="absolute inset-0 blueprint-grid opacity-[0.12] pointer-events-none"></div>
    <!-- Vertical guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-white/5"></div>
        <div class="w-px h-full bg-white/5"></div>
        <div class="w-px h-full bg-white/5"></div>
        <div class="w-px h-full bg-white/5"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-left">
        <span class="text-primary font-display text-[9px] font-bold tracking-[0.25em] uppercase block mb-1">SYSTEM ORIGINS</span>
        <h1 class="font-arch text-5xl md:text-7xl font-black text-white tracking-tighter uppercase leading-[0.8] mb-4">ABOUT US</h1>
        <p class="text-[10px] font-display font-bold tracking-widest text-slate-400 uppercase">PRIME STATE SYSTEM WORKFLOW & VISION</p>
    </div>
</header>

<!-- Company Story Section -->
<section class="py-24 bg-white dark:bg-background-dark relative">
    <!-- Vertical guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-slate-100 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-100 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-100 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-100 dark:bg-white/5"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image Side (Stark Brutalist Outlines) -->
            <div class="relative">
                <div class="absolute -top-4 -left-4 w-24 h-24 border border-slate-200 dark:border-white/5 -z-0"></div>
                <div class="absolute -bottom-4 -right-4 w-32 h-32 border border-slate-200 dark:border-white/5 -z-0"></div>
                <img alt="Modern minimalist concrete corporate office" class="relative z-10 rounded-none border-2 border-slate-900 dark:border-white/20 shadow-xl w-full h-[520px] object-cover" src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80"/>
                
                <!-- Dark Floater Card -->
                <div class="absolute bottom-8 left-8 z-20 bg-slate-950 border border-white/10 p-6 rounded-none shadow-2xl max-w-xs hidden md:block">
                    <p class="text-xs font-display font-bold tracking-widest uppercase text-primary mb-1">FOUNDERS MOTTO</p>
                    <p class="text-xs font-light text-slate-300 leading-relaxed">"Building trust, unmatched architecture, and absolute transactional clarity."</p>
                </div>
            </div>
            
            <!-- Text Side -->
            <div class="space-y-6 text-left">
                <span class="text-primary-dark font-display text-[10px] font-bold tracking-[0.25em] uppercase block mb-1">OUR STORY</span>
                <h3 class="font-display text-3xl md:text-4xl font-black text-slate-900 dark:text-white leading-none uppercase">REDEFINING PROPERTIES FOR THE MODERN ERA</h3>
                <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm font-light">
                    Founded in 2010, Prime Estate began with a simple yet ambitious goal: to transform the typically stressful process of buying, renting, and managing properties into a seamless, transparent, and rewarding digital experience.
                </p>
                <p class="text-slate-600 dark:text-slate-300 leading-relaxed text-sm font-light">
                    What started as a boutique agency has grown into a premier real estate firm, trusted by thousands of families and investors. We combine cutting-edge technology and modern HSL interface layouts with traditional personalized service to deliver results that exceed expectations.
                </p>
                <div class="pt-4">
                    <a class="inline-flex items-center text-slate-900 dark:text-white font-display text-[10px] font-bold tracking-widest uppercase hover:text-primary-dark transition-colors group border-b-2 border-slate-900 dark:border-white pb-1" href="<?php echo BASE_URL; ?>views/public/properties.php">
                        Explore Listings
                        <span class="material-symbols-outlined ml-2 group-hover:translate-x-1 transition-transform text-xs">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Cards (Warm Alabaster backdrop with stark outline boxes) -->
<section class="py-24 bg-neutral-light dark:bg-[#151517] relative">
    <div class="absolute inset-0 blueprint-grid-light opacity-[0.2] pointer-events-none"></div>
    <!-- Vertical guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-slate-200/50 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/50 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/50 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/50 dark:bg-white/5"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Mission Card -->
            <div class="bg-white dark:bg-background-dark p-10 rounded-none border-2 border-slate-900 dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col justify-between min-h-[300px] text-left">
                <div>
                    <div class="w-12 h-12 border border-slate-900/10 dark:border-white/10 flex items-center justify-center mb-6 text-slate-900 dark:text-white bg-slate-50 dark:bg-white/5">
                        <span class="material-symbols-outlined text-lg">flag</span>
                    </div>
                    <h3 class="font-display text-base font-bold text-slate-900 dark:text-white tracking-wider uppercase mb-4">Our Mission</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                        To empower our clients with data-driven insights and exceptional service, enabling them to make the most informed real estate decisions. We strive to find not just a house, but a place designed for your life's best moments.
                    </p>
                </div>
            </div>
            
            <!-- Vision Card -->
            <div class="bg-white dark:bg-background-dark p-10 rounded-none border-2 border-slate-900 dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col justify-between min-h-[300px] text-left">
                <div>
                    <div class="w-12 h-12 border border-slate-900/10 dark:border-white/10 flex items-center justify-center mb-6 text-slate-900 dark:text-white bg-slate-50 dark:bg-white/5">
                        <span class="material-symbols-outlined text-lg">visibility</span>
                    </div>
                    <h3 class="font-display text-base font-bold text-slate-900 dark:text-white tracking-wider uppercase mb-4">Our Vision</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                        To be the most trusted and innovative real estate partner globally, setting the standard for ethics, professionalism, and community building in every market we serve.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-24 bg-white dark:bg-background-dark relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <div class="max-w-3xl mx-auto mb-20">
            <span class="text-primary-dark font-display text-[10px] font-bold tracking-[0.25em] uppercase block mb-1">VALUES SYSTEM</span>
            <h2 class="font-display text-4xl font-black text-slate-900 dark:text-white tracking-tighter uppercase mb-3">OUR CORE VALUES</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 font-light">The principles that guide every interaction and transaction at Prime Estate.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Value 1 -->
            <div class="p-8 border border-slate-200 dark:border-white/5 bg-slate-50/50 dark:bg-white/5 text-center group hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                <div class="w-14 h-14 mx-auto border border-slate-900/10 dark:border-white/10 rounded-full flex items-center justify-center mb-6 bg-white dark:bg-background-dark group-hover:bg-primary transition-all duration-300">
                    <span class="material-symbols-outlined text-slate-900 dark:text-white text-xl">verified_user</span>
                </div>
                <h3 class="font-display text-xs font-bold text-slate-900 dark:text-white tracking-widest uppercase mb-3">Integrity</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                    We operate with absolute transparency. Honest communication is the foundation of our long-term client relationships.
                </p>
            </div>
            <!-- Value 2 -->
            <div class="p-8 border border-slate-200 dark:border-white/5 bg-slate-50/50 dark:bg-white/5 text-center group hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                <div class="w-14 h-14 mx-auto border border-slate-900/10 dark:border-white/10 rounded-full flex items-center justify-center mb-6 bg-white dark:bg-background-dark group-hover:bg-primary transition-all duration-300">
                    <span class="material-symbols-outlined text-slate-900 dark:text-white text-xl">star</span>
                </div>
                <h3 class="font-display text-xs font-bold text-slate-900 dark:text-white tracking-widest uppercase mb-3">Excellence</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                    We don't settle for average. From our marketing materials to our digital layouts, we aim for the highest quality.
                </p>
            </div>
            <!-- Value 3 -->
            <div class="p-8 border border-slate-200 dark:border-white/5 bg-slate-50/50 dark:bg-white/5 text-center group hover:bg-slate-50 dark:hover:bg-slate-800/20 transition-colors">
                <div class="w-14 h-14 mx-auto border border-slate-900/10 dark:border-white/10 rounded-full flex items-center justify-center mb-6 bg-white dark:bg-background-dark group-hover:bg-primary transition-all duration-300">
                    <span class="material-symbols-outlined text-slate-900 dark:text-white text-xl">handshake</span>
                </div>
                <h3 class="font-display text-xs font-bold text-slate-900 dark:text-white tracking-widest uppercase mb-3">Trust</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                    Earned, not given. We work tirelessly to protect your investment portfolio and ensure absolute transactional peace of mind.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Ribbon (Solid Charcoal) -->
<section class="py-20 bg-charcoal text-white relative border-y border-white/5">
    <div class="absolute inset-0 blueprint-grid opacity-[0.08] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10">
            <div class="px-4">
                <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">500+</p>
                <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Properties Sold</p>
            </div>
            <div class="px-4">
                <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">98%</p>
                <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Client Satisfaction</p>
            </div>
            <div class="px-4">
                <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">120+</p>
                <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Expert Agents</p>
            </div>
            <div class="px-4 border-r-0">
                <p class="font-display font-black text-4xl md:text-5xl text-primary leading-none mb-3">15</p>
                <p class="font-display text-[9px] font-bold tracking-widest text-slate-400 uppercase">Years Experience</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-24 bg-neutral-light dark:bg-[#151517] relative">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6 text-left">
            <div>
                <span class="text-primary-dark font-display text-[10px] font-bold tracking-[0.25em] uppercase block mb-1">OUR EXPERTS</span>
                <h2 class="font-display text-4xl font-black text-slate-900 dark:text-white tracking-tighter uppercase leading-none">MEET THE TEAM</h2>
            </div>
            <p class="max-w-sm text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                Our highly-qualified architectural agents and digital brokers are available around the clock to support your property journey.
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Member 1 -->
            <div class="bg-white dark:bg-background-dark border-2 border-slate-900 dark:border-white/10 rounded-none overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="h-72 overflow-hidden relative bg-slate-900">
                    <img alt="Sarah Jenkins portrait" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 opacity-90" src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80"/>
                </div>
                <div class="p-6 text-center bg-white dark:bg-background-dark border-t border-slate-100 dark:border-white/5">
                    <h3 class="font-display font-bold text-sm text-slate-900 dark:text-white tracking-wider uppercase mb-1">Sarah Jenkins</h3>
                    <p class="font-display text-[9px] font-bold text-primary-dark uppercase tracking-widest">CEO &amp; Founder</p>
                </div>
            </div>
            <!-- Member 2 -->
            <div class="bg-white dark:bg-background-dark border-2 border-slate-900 dark:border-white/10 rounded-none overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="h-72 overflow-hidden relative bg-slate-900">
                    <img alt="David Lee portrait" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 opacity-90" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80"/>
                </div>
                <div class="p-6 text-center bg-white dark:bg-background-dark border-t border-slate-100 dark:border-white/5">
                    <h3 class="font-display font-bold text-sm text-slate-900 dark:text-white tracking-wider uppercase mb-1">David Lee</h3>
                    <p class="font-display text-[9px] font-bold text-primary-dark uppercase tracking-widest">Senior Agent</p>
                </div>
            </div>
            <!-- Member 3 -->
            <div class="bg-white dark:bg-background-dark border-2 border-slate-900 dark:border-white/10 rounded-none overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="h-72 overflow-hidden relative bg-slate-900">
                    <img alt="Emily Chen portrait" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 opacity-90" src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80"/>
                </div>
                <div class="p-6 text-center bg-white dark:bg-background-dark border-t border-slate-100 dark:border-white/5">
                    <h3 class="font-display font-bold text-sm text-slate-900 dark:text-white tracking-wider uppercase mb-1">Emily Chen</h3>
                    <p class="font-display text-[9px] font-bold text-primary-dark uppercase tracking-widest">Head of Marketing</p>
                </div>
            </div>
            <!-- Member 4 -->
            <div class="bg-white dark:bg-background-dark border-2 border-slate-900 dark:border-white/10 rounded-none overflow-hidden group hover:shadow-2xl transition-all duration-300">
                <div class="h-72 overflow-hidden relative bg-slate-900">
                    <img alt="Michael Ross portrait" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 opacity-90" src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80"/>
                </div>
                <div class="p-6 text-center bg-white dark:bg-background-dark border-t border-slate-100 dark:border-white/5">
                    <h3 class="font-display font-bold text-sm text-slate-900 dark:text-white tracking-wider uppercase mb-1">Michael Ross</h3>
                    <p class="font-display text-[9px] font-bold text-primary-dark uppercase tracking-widest">Senior Broker</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
