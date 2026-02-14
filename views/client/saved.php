<?php 
require_once __DIR__ . '/../layouts/client-sidebar.php'; 
require_once __DIR__ . '/../../models/SavedProperty.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

Auth::requireLogin();
$user_id = Auth::user()['id'];

$savedPropertyModel = new SavedProperty();
$properties = $savedPropertyModel->readByUser($user_id); 
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Saved Properties</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Properties you've bookmarked for later.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php 
    if($properties->rowCount() > 0):
        while($property = $properties->fetch(PDO::FETCH_ASSOC)):
    ?>
    <div class="bg-white dark:bg-[#1a1625] rounded-xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
        <div class="relative h-48 overflow-hidden">
            <span class="absolute top-3 left-3 bg-white dark:bg-background-dark text-slate-900 dark:text-white text-xs font-bold px-3 py-1 rounded-full z-10 shadow-sm uppercase tracking-wide">
                For <?php echo ucfirst($property['listing_type']); ?>
            </span>
            <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="block h-full">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                     src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" 
                     alt="<?php echo $property['title']; ?>"
                     onerror="this.src='https://via.placeholder.com/600x400?text=Property+Image'">
            </a>
            
            <form action="<?php echo BASE_URL; ?>controllers/SavedPropertyController.php?action=toggle" method="POST" class="absolute top-3 right-3 z-20">
                <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                <button type="submit" class="p-2 bg-white/80 dark:bg-black/50 hover:bg-white dark:hover:bg-black/70 rounded-full text-red-500 transition-colors shadow-sm" title="Remove from Saved">
                    <span class="material-symbols-outlined text-sm">favorite</span>
                </button>
            </form>
        </div>
        <div class="p-5 flex-1 flex flex-col">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-primary font-bold text-lg mb-0 text-nowrap"><?php echo Helper::formatCurrency($property['price']); ?></h3>
            </div>
            <h4 class="font-bold text-slate-900 dark:text-white text-lg mb-1 line-clamp-1">
                <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="hover:text-primary transition-colors">
                    <?php echo $property['title']; ?>
                </a>
            </h4>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-4 flex items-center gap-1">
                <span class="material-symbols-outlined text-base">location_on</span>
                <?php echo $property['city']; ?>
            </p>
            
            <div class="flex items-center gap-4 text-sm text-slate-600 dark:text-slate-300 mt-auto pt-4 border-t border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-lg text-slate-400">bed</span>
                    <span class="font-semibold"><?php echo $property['bedrooms']; ?></span> Beds
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-lg text-slate-400">bathtub</span>
                    <span class="font-semibold"><?php echo $property['bathrooms']; ?></span> Baths
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-lg text-slate-400">square_foot</span>
                    <span class="font-semibold"><?php echo $property['area_sqft']; ?></span> sqft
                </div>
            </div>
        </div>
    </div>
    <?php 
        endwhile; 
    else:
    ?>
    <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-3xl text-slate-400">favorite_border</span>
        </div>
        <h3 class="text-lg font-medium text-slate-900 dark:text-white">No saved properties</h3>
        <p class="text-slate-500 dark:text-slate-400 mt-1 max-w-sm">Use the heart icon on properties you love to save them here for quick access.</p>
        <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="mt-4 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition">
            Browse Properties
        </a>
    </div>
    <?php endif; ?>
</div>

</div> <!-- Close Main Content -->
</div> <!-- Close Flex Container -->
</body>
</html>
