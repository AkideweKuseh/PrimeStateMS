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
        <span class="text-primary font-display text-[9px] font-bold tracking-[0.25em] uppercase block mb-1">CONNECT WITH US</span>
        <h1 class="font-arch text-5xl md:text-7xl font-black text-white tracking-tighter uppercase leading-[0.8] mb-4">CONTACT US</h1>
        <p class="text-[10px] font-display font-bold tracking-widest text-slate-400 uppercase">Discover the perfect home - Get in touch with our agents today</p>
    </div>
</header>

<!-- Main Wrapper -->
<div class="bg-neutral-light dark:bg-background-dark py-16 relative">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 max-w-7xl mx-auto px-6 lg:px-8 flex justify-between pointer-events-none">
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200/40 dark:bg-white/5"></div>
    </div>

    <!-- Contact Info Cards (Floating Brutalist Squares Offset) -->
    <section class="relative z-25 -mt-28 pb-12 px-6 lg:px-8 max-w-7xl mx-auto w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Address Card -->
            <div class="bg-white dark:bg-[#151517] border-2 border-slate-900 dark:border-white/10 p-8 flex flex-col items-center text-center hover:shadow-2xl transition-all duration-300 rounded-none">
                <div class="w-12 h-12 border border-slate-900/10 dark:border-white/10 flex items-center justify-center mb-6 text-slate-900 dark:text-white bg-slate-50 dark:bg-white/5">
                    <span class="material-symbols-outlined text-lg">location_on</span>
                </div>
                <h3 class="font-display text-xs font-bold text-slate-900 dark:text-white tracking-widest uppercase mb-3">Our Office</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-light">123 Independence Avenue, Airport Residential Area<br/>Accra, Ghana</p>
            </div>
            <!-- Phone Card -->
            <div class="bg-white dark:bg-[#151517] border-2 border-slate-900 dark:border-white/10 p-8 flex flex-col items-center text-center hover:shadow-2xl transition-all duration-300 rounded-none">
                <div class="w-12 h-12 border border-slate-900/10 dark:border-white/10 flex items-center justify-center mb-6 text-slate-900 dark:text-white bg-slate-50 dark:bg-white/5">
                    <span class="material-symbols-outlined text-lg">phone</span>
                </div>
                <h3 class="font-display text-xs font-bold text-slate-900 dark:text-white tracking-widest uppercase mb-3">Phone</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2 font-light">Mon-Fri from 8am to 5pm.</p>
                <a class="font-display text-xs font-bold text-primary-dark hover:text-primary transition-colors tracking-wider" href="tel:+233241234567">+233 24 123 4567</a>
            </div>
            <!-- Email Card -->
            <div class="bg-white dark:bg-[#151517] border-2 border-slate-900 dark:border-white/10 p-8 flex flex-col items-center text-center hover:shadow-2xl transition-all duration-300 rounded-none">
                <div class="w-12 h-12 border border-slate-900/10 dark:border-white/10 flex items-center justify-center mb-6 text-slate-900 dark:text-white bg-slate-50 dark:bg-white/5">
                    <span class="material-symbols-outlined text-lg">email</span>
                </div>
                <h3 class="font-display text-xs font-bold text-slate-900 dark:text-white tracking-widest uppercase mb-3">Email</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2 font-light">Our friendly team is here to help.</p>
                <a class="font-display text-xs font-bold text-primary-dark hover:text-primary transition-colors tracking-wider" href="mailto:info@primeestate.com">info@primeestate.com</a>
            </div>
        </div>
    </section>

    <!-- Main Content: Form & Map (Stark Brutalist Block) -->
    <section class="px-6 lg:px-8 max-w-7xl mx-auto w-full relative z-10">
        <div class="bg-white dark:bg-[#151517] border-2 border-slate-900 dark:border-white/10 rounded-none overflow-hidden shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Contact Form Section -->
                <div class="p-8 md:p-12 lg:pr-16 text-left">
                    <div class="mb-8 border-b border-slate-100 dark:border-white/5 pb-4">
                        <span class="text-primary-dark font-display text-[9px] font-bold tracking-[0.25em] uppercase block mb-1">INQUIRY DESK</span>
                        <h2 class="font-display text-xl font-black text-slate-900 dark:text-white tracking-widest uppercase">SEND US A MESSAGE</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-light mt-1">Fill out the form below and we'll get back to you within 24 hours.</p>
                    </div>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5" for="name">Full Name</label>
                                <input class="block w-full bg-slate-50 dark:bg-white/5 border-2 border-slate-900 dark:border-white/10 text-xs py-3 px-4 focus:ring-0 focus:border-slate-900 dark:focus:border-white transition-all font-medium rounded-none text-slate-900 dark:text-white placeholder-slate-400" id="name" name="name" placeholder="John Doe" type="text"/>
                            </div>
                            <!-- Email -->
                            <div>
                                <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5" for="email">Email Address</label>
                                <input class="block w-full bg-slate-50 dark:bg-white/5 border-2 border-slate-900 dark:border-white/10 text-xs py-3 px-4 focus:ring-0 focus:border-slate-900 dark:focus:border-white transition-all font-medium rounded-none text-slate-900 dark:text-white placeholder-slate-400" id="email" name="email" placeholder="john@example.com" type="email"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Phone -->
                            <div>
                                <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5" for="phone">Phone Number</label>
                                <input class="block w-full bg-slate-50 dark:bg-white/5 border-2 border-slate-900 dark:border-white/10 text-xs py-3 px-4 focus:ring-0 focus:border-slate-900 dark:focus:border-white transition-all font-medium rounded-none text-slate-900 dark:text-white placeholder-slate-400" id="phone" name="phone" placeholder="+233 24 123 4567" type="tel"/>
                            </div>
                            <!-- Subject -->
                            <div>
                                <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5" for="subject">Subject</label>
                                <select class="block w-full bg-slate-50 dark:bg-white/5 border-2 border-slate-900 dark:border-white/10 text-xs py-2.5 px-4 focus:ring-0 focus:border-slate-900 dark:focus:border-white cursor-pointer transition-all font-medium rounded-none text-slate-900 dark:text-white placeholder-slate-400 uppercase font-bold tracking-wider" id="subject" name="subject">
                                    <option class="bg-white dark:bg-charcoal text-slate-900 dark:text-white">General Inquiry</option>
                                    <option class="bg-white dark:bg-charcoal text-slate-900 dark:text-white">Buying Property</option>
                                    <option class="bg-white dark:bg-charcoal text-slate-900 dark:text-white">Selling Property</option>
                                    <option class="bg-white dark:bg-charcoal text-slate-900 dark:text-white">Careers</option>
                                </select>
                            </div>
                        </div>
                        <!-- Message -->
                        <div>
                            <label class="block font-display text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1.5" for="message">Message</label>
                            <textarea class="block w-full bg-slate-50 dark:bg-white/5 border-2 border-slate-900 dark:border-white/10 text-xs py-3 px-4 focus:ring-0 focus:border-slate-900 dark:focus:border-white transition-all font-medium rounded-none text-slate-900 dark:text-white placeholder-slate-400" id="message" name="message" placeholder="How can we help you?" rows="4"></textarea>
                        </div>
                        <!-- Submit Button -->
                        <div>
                            <button class="w-full bg-slate-900 hover:bg-black dark:bg-primary dark:hover:bg-primary-dark text-white dark:text-black font-display text-[10px] font-bold tracking-widest uppercase py-4 shadow-md transition-all rounded-none flex justify-center items-center gap-2" type="submit">
                                <span class="material-symbols-outlined text-sm">send</span>
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Map Section (Mockup) -->
                <div class="relative h-96 lg:h-auto min-h-[450px] w-full bg-slate-100 dark:bg-slate-900 border-t lg:border-t-0 lg:border-l-2 border-slate-900 dark:border-white/10">
                    <!-- Static Map Image Background -->
                    <img alt="Office location mockup satellite map details" class="absolute inset-0 w-full h-full object-cover opacity-90 dark:opacity-50 grayscale hover:grayscale-0 transition-all duration-700" src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=800&q=80"/>
                    <!-- Map Overlay Pin -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                        <div class="relative flex items-center justify-center">
                            <div class="animate-ping absolute inline-flex h-12 w-12 rounded-full bg-primary opacity-75"></div>
                            <div class="relative inline-flex rounded-full h-8 w-8 bg-slate-950 border-2 border-white text-white shadow-2xl items-center justify-center">
                                <span class="material-symbols-outlined text-[14px]">home</span>
                            </div>
                        </div>
                        <div class="mt-2 bg-slate-950 border border-white/15 py-1 px-3 rounded-none text-[9px] font-display font-bold text-white uppercase tracking-widest whitespace-nowrap transform -translate-x-1/2 left-1/2 relative">
                            Prime Estate HQ
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
