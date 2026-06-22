<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../models/Property.php';
require_once __DIR__ . '/../../../core/Helper.php';

$propertyModel = new Property();
$properties = $propertyModel->read();
?>

<!-- Minimalist Header Block -->
<div class="border-b border-slate-200 dark:border-white/10 pb-5 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
    <div>
        <h1 class="font-display font-black text-3xl text-slate-900 dark:text-white tracking-tighter uppercase">PROPERTIES INVENTORY</h1>
        <p class="text-slate-400 dark:text-slate-500 font-display text-[10px] font-bold tracking-widest uppercase mt-1">Manage and update all property listings across the system.</p>
    </div>
    <a href="create.php" 
       class="px-5 py-2.5 bg-primary hover:bg-[#d9c441] border border-slate-900 dark:border-primary text-black font-display text-[10px] font-bold tracking-widest uppercase rounded-none transition duration-300 flex items-center gap-2 shadow-[4px_4px_0px_0px_#111111] dark:shadow-[4px_4px_0px_0px_rgba(255,255,255,0.1)]">
        <span class="material-symbols-outlined text-sm font-bold">add</span>
        Add New Property
    </a>
</div>

<div class="relative z-10">
    <!-- Thin vertical architectural guide lines -->
    <div class="absolute inset-x-0 inset-y-0 z-0 flex justify-between pointer-events-none opacity-10">
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
        <div class="w-px h-full bg-slate-400 dark:bg-white/10"></div>
    </div>

    <!-- Stark brutalist properties list table -->
    <div class="bg-white dark:bg-[#151517] rounded-none border border-slate-200 dark:border-white/10 relative z-10">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full divide-y divide-slate-250 dark:divide-white/10">
                <thead class="bg-slate-50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Property</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Type</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Listing</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Price</th>
                        <th class="px-6 py-4 text-left font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right font-display text-[9px] font-bold text-slate-450 dark:text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 bg-white dark:bg-[#151517]">
                    <?php while($property = $properties->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-[#1d1d20]/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 border border-slate-200 dark:border-white/10 bg-slate-900 overflow-hidden">
                                    <img class="h-full w-full object-cover" 
                                         src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" 
                                         alt="<?php echo $property['title']; ?>"
                                         onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=120&q=80'">
                                </div>
                                <div class="ml-4">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white uppercase"><?php echo $property['title']; ?></div>
                                    <div class="text-[9px] font-bold tracking-wider uppercase text-slate-400 dark:text-slate-500 flex items-center gap-1 mt-1">
                                        <span class="material-symbols-outlined text-[10px]">location_on</span>
                                        <?php echo $property['city']; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-650 dark:text-slate-355 font-mono uppercase">
                            <?php echo $property['property_type']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 border border-slate-200 dark:border-white/10 rounded-none text-[9px] font-bold uppercase tracking-wider bg-slate-50 dark:bg-slate-900/50 text-slate-600 dark:text-slate-300">
                                FOR <?php echo strtoupper($property['listing_type']); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-slate-900 dark:text-white font-mono">
                            <?php echo Helper::formatCurrency($property['price']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-none border text-[9px] font-bold uppercase tracking-wider <?php 
                                echo match(strtolower($property['status'])) {
                                    'available' => 'bg-primary/20 text-yellow-750 border-primary/20 dark:text-primary dark:border-primary/10',
                                    'occupied' => 'bg-charcoal text-white border-slate-950 dark:bg-white dark:text-black dark:border-white',
                                    default => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:border-white/10'
                                };
                            ?>">
                                <?php echo $property['status']; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                            <div class="inline-flex gap-2">
                                <a href="edit.php?id=<?php echo $property['id']; ?>" 
                                   class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-primary hover:border-slate-900 dark:hover:border-white rounded-none transition duration-300"
                                   title="Edit Property">
                                    <span class="material-symbols-outlined text-sm leading-none">edit</span>
                                </a>
                                <a href="javascript:void(0)" 
                                   class="p-2 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-red-650 hover:border-red-650 rounded-none transition duration-300"
                                   onclick="showConfirmModal({title:'Delete Property',message:'Are you sure you want to delete this property? This action is permanent and cannot be reversed.',type:'danger',confirmText:'Yes, Delete',onConfirm:()=>{window.location.href='delete.php?id=<?php echo $property['id']; ?>'}})"
                                   title="Delete Property">
                                    <span class="material-symbols-outlined text-sm leading-none">delete</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    
                    <?php if($properties->rowCount() == 0): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <span class="material-symbols-outlined text-4xl text-slate-305 dark:text-slate-650 mb-3">domain_disabled</span>
                            <p class="font-display text-[10px] font-bold tracking-widest uppercase text-slate-400 dark:text-slate-500">No properties listed in database.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
