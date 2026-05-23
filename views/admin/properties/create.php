<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">ADD NEW PROPERTY</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Create a new architectural listing in the inventory.</p>
    </div>
    <a href="index.php" 
       class="px-5 py-2.5 bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white text-slate-700 dark:text-slate-300 font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Back to List
    </a>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark Form Card -->
    <div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 p-8 rounded-none relative z-10">
        <form action="<?php echo BASE_URL; ?>controllers/PropertyController.php?action=store" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Property Title</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors" 
                            name="title" required placeholder="e.g. LUXURY VILLA IN EAST LEGON">
                </div>

                <!-- Price -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Price (GHS)</label>
                     <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs font-mono">GHS</span>
                        <input type="number" 
                               class="w-full pl-12 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                               name="price" step="0.01" required placeholder="0.00">
                     </div>
                </div>

                <!-- Property Type -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Property Type</label>
                    <select class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider" 
                            name="property_type" required>
                        <option value="house">House</option>
                        <option value="apartment">Apartment</option>
                        <option value="land">Land</option>
                        <option value="commercial">Commercial</option>
                        <option value="office">Office</option>
                        <option value="villa">Villa</option>
                    </select>
                </div>

                <!-- Listing Type -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Listing Type</label>
                    <select class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider" 
                            name="listing_type" required>
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                    </select>
                </div>

                <!-- Address -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Address</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wide" 
                            name="address" required placeholder="Street name, neighborhood...">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Description</label>
                     <textarea class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors" 
                               name="description" rows="4" required placeholder="Provide descriptive operational details..."></textarea>
                </div>

                <!-- City -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">City</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase" 
                            name="city" required placeholder="Accra">
                </div>

                <!-- State -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">State / Region</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase" 
                            name="state" required placeholder="Greater Accra">
                </div>

                <!-- Zip Code -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Zip Code</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                            name="zip_code" placeholder="Optional">
                </div>
                
                <!-- Technical Parameters Subsection -->
                <div class="md:col-span-2 border-t border-slate-200 dark:border-white/5 my-2 pt-6">
                    <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-4">SPECIFICATIONS</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                         <div>
                             <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Bedrooms</label>
                             <input type="number" 
                                    class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                                    name="bedrooms" value="0">
                        </div>
                         <div>
                             <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Bathrooms</label>
                             <input type="number" 
                                    class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                                    name="bathrooms" value="0">
                        </div>
                         <div>
                             <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Area (SQFT)</label>
                             <input type="number" 
                                    class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                                    name="area_sqft" step="0.01" placeholder="0">
                        </div>
                    </div>
                </div>
                
                <!-- Image Upload -->
                <div class="md:col-span-2">
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Main Image</label>
                     <input type="file" 
                            class="block w-full text-xs text-slate-500
                               file:mr-4 file:py-2.5 file:px-5
                               file:rounded-none file:border file:border-slate-950 dark:file:border-white
                               file:text-[10px] file:font-display file:font-bold file:tracking-widest file:uppercase
                               file:bg-charcoal file:text-white
                               dark:file:bg-white dark:file:text-black
                               hover:file:bg-black dark:hover:file:bg-slate-100 transition duration-300" 
                            name="main_image" accept="image/*" required>
                     <p class="mt-1.5 text-[10px] text-slate-400 dark:text-slate-500 font-display">JPG, PNG, WEBP, or GIF up to 5MB</p>
                </div>
                
                <!-- Featured Checkbox -->
                <div class="md:col-span-2">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_featured" 
                                   name="is_featured" 
                                   type="checkbox" 
                                   class="focus:ring-0 h-4 w-4 text-slate-950 border border-slate-200 dark:border-white/10 rounded-none bg-white dark:bg-[#121214]">
                        </div>
                        <div class="ml-3 text-xs">
                            <label for="is_featured" class="font-bold text-slate-900 dark:text-white font-display text-[10px] tracking-wider uppercase">FEATURE THIS PROPERTY</label>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 uppercase tracking-wide">If checked, this listing will display prominently in the homepage showcased assets.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="md:col-span-2 pt-6 border-t border-slate-200 dark:border-white/5">
                    <button type="submit" 
                            class="px-8 py-3.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                        Add Property
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
