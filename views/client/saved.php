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

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">SAVED LISTINGS</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Review, manage, and book viewings for your saved properties.</p>
    </div>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist properties grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10">
        <?php 
        if($properties->rowCount() > 0):
            while($property = $properties->fetch(PDO::FETCH_ASSOC)):
        ?>
        <div class="group bg-white dark:bg-[#151517] rounded-none overflow-hidden border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white hover:shadow-2xl transition-all duration-500 flex flex-col relative">
            <div class="relative h-48 overflow-hidden bg-slate-900">
                <span class="absolute top-3 left-3 bg-slate-900 text-white font-display text-[8px] font-bold tracking-widest px-2 py-1 uppercase rounded-none border border-white/10 z-20 shadow-sm">
                    FOR <?php echo strtoupper($property['listing_type']); ?>
                </span>
                
                <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="block h-full absolute inset-0 z-10">
                    <span class="sr-only">View details of <?php echo htmlspecialchars($property['title']); ?></span>
                </a>
                
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100" 
                     src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" 
                     alt="<?php echo $property['title']; ?>"
                     onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=300&q=80'">
                
                <form action="<?php echo BASE_URL; ?>controllers/SavedPropertyController.php?action=toggle" method="POST" class="absolute top-3 right-3 z-20">
                    <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                    <button type="submit" 
                            class="p-1.5 bg-slate-900/80 hover:bg-slate-900 border border-white/10 text-red-500 rounded-none transition-colors shadow-sm" 
                            title="Remove from Saved">
                        <span class="material-symbols-outlined text-xs leading-none font-bold">favorite</span>
                    </button>
                </form>
            </div>
            
            <div class="p-5 flex-1 flex flex-col justify-between border-t border-slate-100 dark:border-white/5">
                <div>
                    <h3 class="font-mono font-bold text-base text-slate-900 dark:text-white leading-none mb-2"><?php echo Helper::formatCurrency($property['price']); ?></h3>
                    <h4 class="font-display font-bold text-xs text-slate-900 dark:text-white uppercase tracking-wide truncate mb-1">
                        <a href="<?php echo BASE_URL; ?>views/public/property-details.php?id=<?php echo $property['id']; ?>" class="hover:text-primary transition-colors">
                            <?php echo $property['title']; ?>
                        </a>
                    </h4>
                    <p class="text-slate-400 dark:text-slate-500 font-display text-[8px] font-bold tracking-widest uppercase flex items-center gap-1 mb-4">
                        <span class="material-symbols-outlined text-slate-400 text-[10px]">location_on</span>
                        <?php echo $property['city']; ?>
                    </p>
                </div>
                
                <div class="border-t border-slate-100 dark:border-white/5 pt-3 flex justify-between text-slate-500 dark:text-slate-400 font-display text-[8px] font-bold tracking-widest uppercase mt-auto">
                    <span><?php echo $property['bedrooms']; ?> Beds</span>
                    <span><?php echo $property['bathrooms']; ?> Baths</span>
                    <span><?php echo $property['area_sqft']; ?> SQFT</span>
                </div>
            </div>
        </div>
        <?php 
            endwhile; 
        else:
        ?>
        <div class="col-span-full py-16 text-center bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none">
            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3 animate-pulse">favorite_border</span>
            <h3 class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight mb-2">No Bookmarked Assets</h3>
            <p class="text-xs text-slate-450 dark:text-slate-500 uppercase tracking-widest mb-6">Use the favorite icon on properties you love to save them here for quick access.</p>
            <a href="<?php echo BASE_URL; ?>views/public/properties.php" 
               class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 inline-block shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
                Browse Properties
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
