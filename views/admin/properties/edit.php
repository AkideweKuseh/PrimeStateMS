<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../models/Property.php';
require_once __DIR__ . '/../../../core/Helper.php';

if(!isset($_GET['id'])) {
    Helper::redirect('views/admin/properties/index.php');
}

$propertyModel = new Property();
$propertyModel->id = $_GET['id'];
$property_data = $propertyModel->readOne();

if(!$property_data) {
    Helper::setFlash('error', 'Property not found.');
    Helper::redirect('views/admin/properties/index.php');
}
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">EDIT PROPERTY</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Update operational details for listing #<?php echo $property_data['id']; ?></p>
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
        <form action="<?php echo BASE_URL; ?>controllers/PropertyController.php?action=update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $property_data['id']; ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Property Title</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase" 
                            name="title" required value="<?php echo htmlspecialchars($property_data['title']); ?>">
                </div>

                <!-- Price -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Price (GHS)</label>
                     <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs font-mono">GHS</span>
                        <input type="number" 
                               class="w-full pl-12 rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                               name="price" step="0.01" required value="<?php echo $property_data['price']; ?>">
                     </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Status</label>
                    <select class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider" 
                            name="status" required>
                        <option value="available" <?php echo $property_data['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
                        <option value="sold" <?php echo $property_data['status'] == 'sold' ? 'selected' : ''; ?>>Sold</option>
                        <option value="rented" <?php echo $property_data['status'] == 'rented' ? 'selected' : ''; ?>>Rented</option>
                    </select>
                </div>

                <!-- Property Type -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Property Type</label>
                    <select class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider" 
                            name="property_type" required>
                        <option value="house" <?php echo $property_data['property_type'] == 'house' ? 'selected' : ''; ?>>House</option>
                        <option value="apartment" <?php echo $property_data['property_type'] == 'apartment' ? 'selected' : ''; ?>>Apartment</option>
                        <option value="land" <?php echo $property_data['property_type'] == 'land' ? 'selected' : ''; ?>>Land</option>
                        <option value="commercial" <?php echo $property_data['property_type'] == 'commercial' ? 'selected' : ''; ?>>Commercial</option>
                        <option value="office" <?php echo $property_data['property_type'] == 'office' ? 'selected' : ''; ?>>Office</option>
                        <option value="villa" <?php echo $property_data['property_type'] == 'villa' ? 'selected' : ''; ?>>Villa</option>
                    </select>
                </div>

                <!-- Listing Type -->
                <div>
                    <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Listing Type</label>
                    <select class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wider" 
                            name="listing_type" required>
                        <option value="sale" <?php echo $property_data['listing_type'] == 'sale' ? 'selected' : ''; ?>>For Sale</option>
                        <option value="rent" <?php echo $property_data['listing_type'] == 'rent' ? 'selected' : ''; ?>>For Rent</option>
                    </select>
                </div>

                <!-- Address -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Address</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase tracking-wide" 
                            name="address" required value="<?php echo htmlspecialchars($property_data['address']); ?>">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Description</label>
                     <textarea class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors" 
                               name="description" rows="4" required><?php echo htmlspecialchars($property_data['description']); ?></textarea>
                </div>

                <!-- City -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">City</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase" 
                            name="city" required value="<?php echo htmlspecialchars($property_data['city']); ?>">
                </div>

                <!-- State -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">State / Region</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors uppercase" 
                            name="state" required value="<?php echo htmlspecialchars($property_data['state']); ?>">
                </div>

                <!-- Zip Code -->
                <div>
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Zip Code</label>
                     <input type="text" 
                            class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                            name="zip_code" value="<?php echo htmlspecialchars($property_data['zip_code']); ?>">
                </div>
                
                <!-- Technical Parameters Subsection -->
                <div class="md:col-span-2 border-t border-slate-200 dark:border-white/5 my-2 pt-6">
                    <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-4">SPECIFICATIONS</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                         <div>
                             <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Bedrooms</label>
                             <input type="number" 
                                    class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                                    name="bedrooms" value="<?php echo $property_data['bedrooms']; ?>">
                        </div>
                         <div>
                             <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Bathrooms</label>
                             <input type="number" 
                                    class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                                    name="bathrooms" value="<?php echo $property_data['bathrooms']; ?>">
                        </div>
                         <div>
                             <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Area (SQFT)</label>
                             <input type="number" 
                                    class="w-full rounded-none border border-slate-200 dark:border-white/10 bg-white dark:bg-[#121214] text-slate-900 dark:text-white focus:border-slate-950 dark:focus:border-white focus:ring-0 text-xs px-3.5 py-2.5 transition-colors font-mono" 
                                    name="area_sqft" step="0.01" value="<?php echo $property_data['area_sqft']; ?>">
                        </div>
                    </div>
                </div>
                
                <!-- Image Upload -->
                <div class="md:col-span-2">
                     <label class="font-display text-[9px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500 mb-1.5 block">Main Image</label>
                     
                     <?php if(!empty($property_data['main_image'])): ?>
                     <div class="mb-4">
                         <div class="w-48 border border-slate-200 dark:border-white/10 bg-slate-900 overflow-hidden relative">
                             <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property_data['main_image']; ?>" 
                                  alt="Current Image" 
                                  class="w-full h-32 object-cover"
                                  onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=200&q=80'">
                         </div>
                         <p class="text-[9px] font-bold uppercase tracking-widest text-slate-450 dark:text-slate-500 mt-2">Active Featured Image</p>
                     </div>
                     <?php endif; ?>
                     
                     <input type="file" 
                            class="block w-full text-xs text-slate-500
                               file:mr-4 file:py-2.5 file:px-5
                               file:rounded-none file:border file:border-slate-950 dark:file:border-white
                               file:text-[10px] file:font-display file:font-bold file:tracking-widest file:uppercase
                               file:bg-charcoal file:text-white
                               dark:file:bg-white dark:file:text-black
                               hover:file:bg-black dark:hover:file:bg-slate-100 transition duration-300" 
                            name="main_image" accept="image/*">
                     <p class="mt-1.5 text-[10px] text-slate-400 dark:text-slate-500 font-display">Upload new image to overwrite existing. JPG, PNG, WEBP, or GIF up to 5MB</p>
                </div>
                
                <!-- Featured Checkbox -->
                <div class="md:col-span-2">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_featured" 
                                   name="is_featured" 
                                   type="checkbox" 
                                   class="focus:ring-0 h-4 w-4 text-slate-950 border border-slate-200 dark:border-white/10 rounded-none bg-white dark:bg-[#121214]" 
                                   <?php echo $property_data['is_featured'] ? 'checked' : ''; ?>>
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
                        Update Property
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
