<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
?>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Add New Property</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Create a new property listing.</p>
    </div>
    <a href="index.php" class="px-4 py-2 bg-white dark:bg-[#1a1625] border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        Back to List
    </a>
</div>

<!-- Form Card -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
    <div class="p-6">
        <form action="<?php echo BASE_URL; ?>controllers/PropertyController.php?action=store" method="POST" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2 lg:col-span-2">
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Property Title</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="title" required placeholder="e.g. Luxury Villa in East Legon">
                </div>

                <!-- Price -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Price (GHS)</label>
                     <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">GHS</span>
                        <input type="number" class="w-full pl-12 rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="price" step="0.01" required placeholder="0.00">
                     </div>
                </div>

                <!-- Status (Hidden/Default) can vary, but form asked for Types -->
                
                <!-- Property Type -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Property Type</label>
                    <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="property_type" required>
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
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Listing Type</label>
                    <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="listing_type" required>
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                     <textarea class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="description" rows="4" required placeholder="Describe the property..."></textarea>
                </div>
                
                <!-- Address -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Address</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="address" required placeholder="Street name, area...">
                </div>

                <!-- City -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">City</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="city" required placeholder="e.g. Accra">
                </div>

                <!-- State -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">State/Region</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="state" required placeholder="e.g. Greater Accra">
                </div>

                <!-- Zip Code -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Zip Code</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="zip_code" placeholder="Optional">
                </div>
                
                <div class="md:col-span-2 border-t border-slate-100 dark:border-slate-800 my-2 pt-4">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">Property Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                         <div>
                             <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bedrooms</label>
                             <input type="number" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="bedrooms" value="0">
                        </div>
                         <div>
                             <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bathrooms</label>
                             <input type="number" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="bathrooms" value="0">
                        </div>
                         <div>
                             <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Area (sqft)</label>
                             <input type="number" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="area_sqft" step="0.01">
                        </div>
                    </div>
                </div>
                
                <!-- Image Upload -->
                 <div class="md:col-span-2">
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Main Image</label>
                     <input type="file" class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-primary/10 file:text-primary
                        hover:file:bg-primary/20
                        dark:file:bg-primary/20 dark:file:text-primary-light" 
                        name="main_image" accept="image/*" required>
                     <p class="mt-1 text-xs text-slate-500">JPG, PNG, GIF up to 5MB</p>
                </div>
                
                 <!-- Featured Checkbox -->
                 <div class="md:col-span-2">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_featured" name="is_featured" type="checkbox" class="focus:ring-primary h-4 w-4 text-primary border-slate-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_featured" class="font-medium text-slate-700 dark:text-slate-300">Feature this property</label>
                            <p class="text-slate-500 dark:text-slate-400">If checked, this property will appear in the featured section on the homepage.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="md:col-span-2 pt-4">
                    <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg shadow-lg shadow-primary/30 transition-all transform hover:-translate-y-0.5">
                        Add Property
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</main>
</div>
</body>
</html>
