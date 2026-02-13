<?php include __DIR__ . '/../layouts/header.php'; ?>

<!-- Hero Banner -->
<div class="relative bg-slate-900 h-64 md:h-80 w-full overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0 bg-black/50 z-10"></div>
    <img alt="Modern skyscraper" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDYKXomFohduuWNfznGrm-ek8Z-UnRcc7gmlbXhhReytZUICWjtVUn8LzkH2l9JRJNHw3FomNsUA7EZlic_uhJ25kCbNOSpLk-WtZDwl6rxzOZGJfdsOxB75U_ArIjBA0BP5t4ObiIvlBe05Tm1GTW-bI4dcT78J7qRXLW-Sn5x6HMnKMSWyMva7dbs6cu5H5KBsQXfu7a5A2MLiGxpiuFk0HFNr0rwMrq8hFJst57-H7LV3_EBTyGQA48J08VwHv5RIGyVuqc0RMw"/>
    <div class="relative z-20 text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">Contact Us</h1>
        <p class="text-lg md:text-xl text-slate-200 max-w-2xl mx-auto font-light">
            Ready to find your dream property? Get in touch with our expert agents today.
        </p>
    </div>
</div>

<!-- Contact Info Cards -->
<section class="relative z-30 -mt-16 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Address Card -->
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-lg p-8 flex flex-col items-center text-center hover:translate-y-[-2px] transition-transform duration-300 border border-slate-100 dark:border-slate-800">
            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                <span class="material-symbols-outlined">location_on</span>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Our Office</h3>
            <p class="text-slate-600 dark:text-slate-400">123 Independence Avenue, Accra<br/>Ghana</p>
        </div>
        <!-- Phone Card -->
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-lg p-8 flex flex-col items-center text-center hover:translate-y-[-2px] transition-transform duration-300 border border-slate-100 dark:border-slate-800">
            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                <span class="material-symbols-outlined">phone</span>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Phone</h3>
            <p class="text-slate-600 dark:text-slate-400 mb-1">Mon-Fri from 8am to 5pm.</p>
            <a class="text-primary font-semibold hover:underline" href="tel:+233241234567">+233 24 123 4567</a>
        </div>
        <!-- Email Card -->
        <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-lg p-8 flex flex-col items-center text-center hover:translate-y-[-2px] transition-transform duration-300 border border-slate-100 dark:border-slate-800">
            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                <span class="material-symbols-outlined">email</span>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Email</h3>
            <p class="text-slate-600 dark:text-slate-400 mb-1">Our friendly team is here to help.</p>
            <a class="text-primary font-semibold hover:underline" href="mailto:info@primeestate.com">info@primeestate.com</a>
        </div>
    </div>
</section>

<!-- Main Content: Form & Map -->
<section class="flex-grow py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full mb-16">
    <div class="bg-white dark:bg-[#1a1625] rounded-2xl shadow-xl overflow-hidden border border-slate-100 dark:border-slate-800">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <!-- Contact Form Section -->
            <div class="p-8 md:p-12 lg:pr-16">
                <div class="mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-2">Send us a message</h2>
                    <p class="text-slate-600 dark:text-slate-400">Fill out the form below and we'll get back to you within 24 hours.</p>
                </div>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5" for="name">Full Name</label>
                            <input class="block w-full rounded-lg border-slate-300 dark:border-slate-700 shadow-sm focus:border-primary focus:ring-primary dark:bg-[#130f1e] dark:text-white sm:text-sm py-2.5 px-3" id="name" name="name" placeholder="John Doe" type="text"/>
                        </div>
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5" for="email">Email Address</label>
                            <input class="block w-full rounded-lg border-slate-300 dark:border-slate-700 shadow-sm focus:border-primary focus:ring-primary dark:bg-[#130f1e] dark:text-white sm:text-sm py-2.5 px-3" id="email" name="email" placeholder="john@example.com" type="email"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5" for="phone">Phone Number</label>
                            <input class="block w-full rounded-lg border-slate-300 dark:border-slate-700 shadow-sm focus:border-primary focus:ring-primary dark:bg-[#130f1e] dark:text-white sm:text-sm py-2.5 px-3" id="phone" name="phone" placeholder="+233..." type="tel"/>
                        </div>
                        <!-- Subject -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5" for="subject">Subject</label>
                            <select class="block w-full rounded-lg border-slate-300 dark:border-slate-700 shadow-sm focus:border-primary focus:ring-primary dark:bg-[#130f1e] dark:text-white sm:text-sm py-2.5 px-3" id="subject" name="subject">
                                <option>General Inquiry</option>
                                <option>Buying Property</option>
                                <option>Selling Property</option>
                                <option>Careers</option>
                            </select>
                        </div>
                    </div>
                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5" for="message">Message</label>
                        <textarea class="block w-full rounded-lg border-slate-300 dark:border-slate-700 shadow-sm focus:border-primary focus:ring-primary dark:bg-[#130f1e] dark:text-white sm:text-sm py-2.5 px-3" id="message" name="message" placeholder="How can we help you?" rows="4"></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div>
                        <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-lg shadow-primary/30 text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all transform active:scale-[0.98]" type="submit">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
            <!-- Map Section -->
            <div class="relative h-96 lg:h-auto min-h-[400px] w-full bg-slate-100 dark:bg-slate-900 border-t lg:border-t-0 lg:border-l border-slate-200 dark:border-slate-700">
                <!-- Static Map Image Placeholder -->
                <img alt="Map" class="absolute inset-0 w-full h-full object-cover opacity-90 dark:opacity-60 grayscale-[20%]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCt4c7UT_MxN5y60WDxLjhtLNGc7dVRXa1jv4Uig8OQVSBP-GMk80evBDzBSNhLOE9Z57kC5YFAdfjMm5hgs4cSfHuiMOuxPcl1e84C9rMiY8mQb0KvTR2MereSjKqsip0a8msjWgnmCE85kihjdnby04ot2mShvqCHmsfiV2nFxTPTNKxSs0WUK-linZTHNcY8NsD9b5DQI9X0xN7doco1hICSnC6l1cKw2SlfBNY_1NOuvvWIY0PataUqrygoGgyIi9xICxXukBU"/>
                <!-- Map Overlay Pin -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 hidden md:block">
                    <div class="relative flex items-center justify-center">
                        <div class="animate-ping absolute inline-flex h-12 w-12 rounded-full bg-primary opacity-75"></div>
                        <div class="relative inline-flex rounded-full h-8 w-8 bg-primary border-4 border-white dark:border-slate-800 shadow-lg items-center justify-center">
                            <span class="material-symbols-outlined text-white text-[14px]">home</span>
                        </div>
                    </div>
                    <div class="mt-2 bg-white dark:bg-slate-800 py-1 px-3 rounded shadow-lg text-xs font-bold text-slate-800 dark:text-white whitespace-nowrap transform -translate-x-1/2 left-1/2 relative border border-slate-100 dark:border-slate-700">
                        Prime Estate HQ
                    </div>
                </div>
                <!-- Map Controls Mockup -->
                <div class="absolute bottom-4 right-4 bg-white dark:bg-slate-800 rounded-lg shadow-lg p-1 flex flex-col gap-1 z-20">
                    <button class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-lg">add</span>
                    </button>
                    <button class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined text-lg">remove</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
