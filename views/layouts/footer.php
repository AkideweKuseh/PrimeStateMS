<!-- Footer -->
</div> <!-- End Main Content Wrapper -->
<footer class="bg-slate-900 text-slate-300 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary text-3xl">real_estate_agent</span>
                    <span class="font-bold text-2xl text-white">Prime<span class="text-primary">Estate</span></span>
                </div>
                <p class="text-slate-400 mb-6 leading-relaxed">
                    Your trusted partner in finding the perfect property. We bring you premium listings with exceptional service and transparency.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 rounded bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                        <span class="font-bold">fb</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                        <span class="font-bold">tw</span>
                    </a>
                    <a href="#" class="w-10 h-10 rounded bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                        <span class="font-bold">in</span>
                    </a>
                </div>
            </div>
            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="<?php echo BASE_URL; ?>" class="hover:text-primary transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-xs text-primary">chevron_right</span>Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>views/public/properties.php" class="hover:text-primary transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-xs text-primary">chevron_right</span>Properties</a></li>
                    <li><a href="<?php echo BASE_URL; ?>views/public/about.php" class="hover:text-primary transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-xs text-primary">chevron_right</span>About Us</a></li>
                    <li><a href="<?php echo BASE_URL; ?>views/public/contact.php" class="hover:text-primary transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-xs text-primary">chevron_right</span>Contact</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors flex items-center gap-2"><span class="material-symbols-outlined text-xs text-primary">chevron_right</span>Privacy Policy</a></li>
                </ul>
            </div>
            <!-- Contact Info -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Contact Us</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary mt-1">location_on</span>
                        <span>123 Prime Avenue, Airport Residential Area, Accra, Ghana</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">phone</span>
                        <span>+233 20 123 4567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">email</span>
                        <span>info@primeestate.com</span>
                    </li>
                </ul>
            </div>
            <!-- Newsletter -->
            <div>
                <h4 class="text-white font-bold text-lg mb-6">Newsletter</h4>
                <p class="text-slate-400 mb-4 text-sm">Subscribe to get the latest properties and news update.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Your email address" class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded text-white placeholder-slate-500 focus:outline-none focus:border-primary transition-colors">
                    <button class="w-full py-3 bg-primary hover:bg-primary-dark text-white rounded font-bold transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-slate-800 mt-16 pt-8 text-center text-slate-500 text-sm">
            <p>&copy; 2023 Prime Estate. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Custom JS -->
<script src="<?php echo BASE_URL; ?>public/js/main.js"></script>
</body>
</html>
