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

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Property</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Update property details.</p>
    </div>
    <a href="index.php" class="px-4 py-2 bg-white dark:bg-[#1a1625] border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-300 shadow-sm hover:bg-slate-50 transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">arrow_back</span>
        Back to List
    </a>
</div>

<!-- Form Card -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800">
    <div class="p-6">
        <form action="<?php echo BASE_URL; ?>controllers/PropertyController.php?action=update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $property_data['id']; ?>">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2 lg:col-span-2">
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Property Title</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="title" required value="<?php echo htmlspecialchars($property_data['title']); ?>">
                </div>

                <!-- Price -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Price (GHS)</label>
                     <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">GHS</span>
                        <input type="number" class="w-full pl-12 rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="price" step="0.01" required value="<?php echo $property_data['price']; ?>">
                     </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                    <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="status" required>
                        <option value="available" <?php echo $property_data['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
                        <option value="sold" <?php echo $property_data['status'] == 'sold' ? 'selected' : ''; ?>>Sold</option>
                        <option value="rented" <?php echo $property_data['status'] == 'rented' ? 'selected' : ''; ?>>Rented</option>
                    </select>
                </div>
                
                <!-- Property Type -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Property Type</label>
                    <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="property_type" required>
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
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Listing Type</label>
                    <select class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="listing_type" required>
                        <option value="sale" <?php echo $property_data['listing_type'] == 'sale' ? 'selected' : ''; ?>>For Sale</option>
                        <option value="rent" <?php echo $property_data['listing_type'] == 'rent' ? 'selected' : ''; ?>>For Rent</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Description</label>
                     <textarea class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="description" rows="4" required><?php echo htmlspecialchars($property_data['description']); ?></textarea>
                </div>
                
                <!-- Address -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Address</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="address" required value="<?php echo htmlspecialchars($property_data['address']); ?>">
                </div>

                <!-- City -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">City</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="city" required value="<?php echo htmlspecialchars($property_data['city']); ?>">
                </div>

                <!-- State -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">State/Region</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="state" required value="<?php echo htmlspecialchars($property_data['state']); ?>">
                </div>

                <!-- Zip Code -->
                 <div>
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Zip Code</label>
                     <input type="text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="zip_code" value="<?php echo htmlspecialchars($property_data['zip_code']); ?>">
                </div>
                
                <div class="md:col-span-2 border-t border-slate-100 dark:border-slate-800 my-2 pt-4">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">Property Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                         <div>
                             <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bedrooms</label>
                             <input type="number" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="bedrooms" value="<?php echo $property_data['bedrooms']; ?>">
                        </div>
                         <div>
                             <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bathrooms</label>
                             <input type="number" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="bathrooms" value="<?php echo $property_data['bathrooms']; ?>">
                        </div>
                         <div>
                             <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Area (sqft)</label>
                             <input type="number" class="w-full rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-primary focus:ring-primary shadow-sm" name="area_sqft" step="0.01" value="<?php echo $property_data['area_sqft']; ?>">
                        </div>
                    </div>
                </div>
                
                <!-- Image Upload -->
                 <div class="md:col-span-2">
                     <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Main Image</label>
                     
                     <?php if(!empty($property_data['main_image'])): ?>
                     <div class="mb-2">
                         <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property_data['main_image']; ?>" alt="Current Image" class="h-32 w-auto object-cover rounded-lg border border-slate-200 dark:border-slate-700">
                         <p class="text-xs text-slate-500 mt-1">Current image</p>
                     </div>
                     <?php endif; ?>
                     
                     <input type="file" class="block w-full text-sm text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-primary/10 file:text-primary
                        hover:file:bg-primary/20
                        dark:file:bg-primary/20 dark:file:text-primary-light" 
                        name="main_image" accept="image/*">
                     <p class="mt-1 text-xs text-slate-500">Upload new image to replace current one. JPG, PNG, GIF up to 5MB</p>
                </div>
                
                 <!-- Featured Checkbox -->
                 <div class="md:col-span-2">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_featured" name="is_featured" type="checkbox" class="focus:ring-primary h-4 w-4 text-primary border-slate-300 rounded" <?php echo $property_data['is_featured'] ? 'checked' : ''; ?>>
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
                        Update Property
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
