<!-- Footer -->
</div> <!-- End Main Content Wrapper -->
<footer class="bg-charcoal text-slate-400 py-20 border-t border-white/5 relative">
    <!-- Faint blueprint grid overlay for a high-end architectural drawing feel -->
    <div class="absolute inset-0 blueprint-grid opacity-[0.15] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16">
            <!-- Brand -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-6 h-6 flex items-center justify-center border border-primary/50 rotate-45">
                        <span class="material-symbols-outlined text-primary text-[11px] -rotate-45">change_history</span>
                    </div>
                    <span class="font-display font-bold text-base tracking-widest text-white uppercase">PRIME ESTATE</span>
                </div>
                <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                    Your trusted partner in finding the perfect property. We bring you premium listings with exceptional service, design precision, and total transparency.
                </p>
                <div class="flex space-x-3">
                    <a href="#" class="w-8 h-8 border border-white/10 flex items-center justify-center hover:border-primary hover:text-white transition-all text-xs">
                        <span>FB</span>
                    </a>
                    <a href="#" class="w-8 h-8 border border-white/10 flex items-center justify-center hover:border-primary hover:text-white transition-all text-xs">
                        <span>TW</span>
                    </a>
                    <a href="#" class="w-8 h-8 border border-white/10 flex items-center justify-center hover:border-primary hover:text-white transition-all text-xs">
                        <span>LN</span>
                    </a>
                </div>
            </div>
            <!-- Quick Links -->
            <div>
                <h4 class="text-white font-display text-[11px] font-bold tracking-widest uppercase mb-6">Quick Links</h4>
                <ul class="space-y-3 font-display text-[10px] tracking-widest uppercase">
                    <li><a href="<?php echo BASE_URL; ?>" class="hover:text-primary transition-colors flex items-center gap-2">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>views/public/properties.php" class="hover:text-primary transition-colors flex items-center gap-2">Project</a></li>
                    <li><a href="<?php echo BASE_URL; ?>views/public/about.php" class="hover:text-primary transition-colors flex items-center gap-2">About Us</a></li>
                    <li><a href="<?php echo BASE_URL; ?>views/public/contact.php" class="hover:text-primary transition-colors flex items-center gap-2">Contact</a></li>
                </ul>
            </div>
            <!-- Contact Info -->
            <div>
                <h4 class="text-white font-display text-[11px] font-bold tracking-widest uppercase mb-6">Contact Us</h4>
                <ul class="space-y-4 text-xs">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-sm mt-0.5">location_on</span>
                        <span>123 Prime Avenue, Airport Residential Area, Accra, Ghana</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-sm">phone</span>
                        <span>+233 20 123 4567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-sm">email</span>
                        <span>info@primeestate.com</span>
                    </li>
                </ul>
            </div>
            <!-- Newsletter -->
            <div>
                <h4 class="text-white font-display text-[11px] font-bold tracking-widest uppercase mb-6">Newsletter</h4>
                <p class="text-slate-400 mb-4 text-xs">Subscribe to get the latest property and project updates.</p>
                <form class="space-y-3">
                    <input type="email" placeholder="Your email address" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-none text-white text-xs placeholder-slate-500 focus:outline-none focus:border-primary transition-colors">
                    <button class="w-full py-3 bg-primary hover:bg-primary-dark text-black font-display text-[11px] font-bold tracking-widest uppercase rounded-none transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-white/5 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center text-slate-500 text-[10px] font-display tracking-widest uppercase">
            <p>&copy; <?php echo date('Y'); ?> Prime Estate. All rights reserved.</p>
            <p class="mt-4 md:mt-0">DESIGN PRECISION IN LIVING</p>
        </div>
    </div>
</footer>

<!-- Custom JS -->
<script src="<?php echo BASE_URL; ?>public/js/main.js"></script>
</body>
</html>
