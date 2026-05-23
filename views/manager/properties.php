<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Property.php';
require_once __DIR__ . '/../../core/Helper.php';

$propertyModel = new Property();
$properties = $propertyModel->read();
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8">
    <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">PROPERTY MANAGEMENT</h1>
    <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Managed properties and their current status.</p>
</div>

<div class="relative">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-20">
        <div class="w-px h-full bg-slate-200 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200 dark:bg-white/5"></div>
        <div class="w-px h-full bg-slate-200 dark:bg-white/5"></div>
    </div>

    <!-- Stark brutalist property grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10">
        <?php while($p = $properties->fetch(PDO::FETCH_ASSOC)): ?>
        <div class="group bg-white dark:bg-[#151517] rounded-none overflow-hidden border border-slate-200 dark:border-white/10 hover:border-slate-900 dark:hover:border-white hover:shadow-2xl transition-all duration-500 flex flex-col relative">
            
            <!-- Main Image container -->
            <div class="relative h-56 overflow-hidden bg-slate-900 dark:bg-slate-950">
                <span class="absolute top-4 left-4 bg-slate-900 text-white font-display text-[9px] font-bold tracking-widest px-3 py-1.5 uppercase rounded-none border border-white/10 z-10 shadow-sm">
                    For <?php echo ucfirst($p['listing_type']); ?>
                </span>
                
                <div class="absolute top-4 right-4 z-10">
                    <span class="font-display text-[9px] font-bold tracking-widest uppercase px-2.5 py-1.5 border shadow-sm rounded-none <?php 
                        echo match($p['status']) {
                            'available' => 'bg-primary text-black border-slate-300 dark:border-primary/50',
                            'occupied' => 'bg-charcoal text-white border-transparent dark:bg-white dark:text-black',
                            'booked' => 'bg-slate-200 text-slate-700 border-slate-300 dark:bg-slate-800 dark:text-slate-300 dark:border-white/10',
                            default => 'bg-white text-slate-800 border-slate-300 dark:bg-slate-900 dark:text-white dark:border-white/10'
                        };
                    ?> font-bold">
                        <?php echo $p['status']; ?>
                    </span>
                </div>

                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-90 group-hover:opacity-100" 
                     src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $p['main_image'] ?? 'default.jpg'; ?>" 
                     alt="<?php echo $p['title']; ?>"
                     onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80'">
            </div>
            
            <!-- Content Block -->
            <div class="p-6 flex-1 flex flex-col justify-between border-t border-slate-100 dark:border-white/5 bg-white dark:bg-[#151517]">
                <div>
                    <h3 class="font-display font-black text-slate-900 dark:text-white text-xl mb-1 leading-none">
                        <?php echo Helper::formatCurrency($p['price']); ?>
                    </h3>
                    <h4 class="font-display font-bold text-slate-900 dark:text-white text-sm mb-2 uppercase tracking-wide line-clamp-1 group-hover:text-primary transition-colors">
                        <?php echo $p['title']; ?>
                    </h4>
                    <p class="text-slate-400 dark:text-slate-500 font-display text-[9px] font-bold tracking-widest uppercase flex items-center gap-1.5 mb-6">
                        <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 text-xs">location_on</span>
                        <?php echo $p['city'] . ', ' . $p['state']; ?>
                    </p>
                </div>
                
                <!-- Details row -->
                <div class="border-t border-slate-100 dark:border-white/5 pt-4 flex justify-between items-center text-slate-500 dark:text-slate-400 font-display text-[9px] font-bold tracking-widest uppercase">
                    <div class="flex items-center gap-1.5" title="Bedrooms">
                        <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 text-sm">bed</span>
                        <span><?php echo $p['bedrooms']; ?> Beds</span>
                    </div>
                    <div class="flex items-center gap-1.5" title="Bathrooms">
                        <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 text-sm">bathtub</span>
                        <span><?php echo $p['bathrooms']; ?> Baths</span>
                    </div>
                    <div class="flex items-center gap-1.5" title="Square Footage">
                        <span class="material-symbols-outlined text-slate-400 dark:text-slate-500 text-sm">square_foot</span>
                        <span><?php echo $p['area_sqft']; ?> sqft</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php if($properties->rowCount() == 0): ?>
<div class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none p-12 text-center mt-6">
    <span class="material-symbols-outlined text-4xl text-slate-300 dark:text-slate-600 mb-4">domain_disabled</span>
    <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-500 dark:text-slate-400">No properties managed yet.</p>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
