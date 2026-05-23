<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Property.php';
require_once __DIR__ . '/../../core/Helper.php';

$propertyModel = new Property();
$properties = $propertyModel->read();
?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Property Management</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Managed properties and their current status.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php while($p = $properties->fetch(PDO::FETCH_ASSOC)): ?>
    <div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden group">
        <div class="relative h-48 overflow-hidden">
            <img src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $p['main_image'] ?? 'default.jpg'; ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="">
            <div class="absolute top-4 right-4">
                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?php 
                    echo match($p['status']) {
                        'available' => 'bg-green-100 text-green-800',
                        'occupied' => 'bg-blue-100 text-blue-800',
                        'booked' => 'bg-yellow-100 text-yellow-800',
                        default => 'bg-slate-100 text-slate-800'
                    };
                ?>">
                    <?php echo $p['status']; ?>
                </span>
            </div>
        </div>
        <div class="p-5">
            <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-1 truncate"><?php echo $p['title']; ?></h3>
            <p class="text-xs text-slate-500 mb-4 flex items-center gap-1">
                <span class="material-symbols-outlined text-xs">location_on</span>
                <?php echo $p['city']; ?>, <?php echo $p['state']; ?>
            </p>
            <div class="flex items-center justify-between pt-4 border-t border-slate-50 dark:border-slate-800/50">
                <span class="text-primary font-bold"><?php echo Helper::formatCurrency($p['price']); ?></span>
                <span class="text-xs text-slate-400"><?php echo ucfirst($p['listing_type']); ?></span>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
