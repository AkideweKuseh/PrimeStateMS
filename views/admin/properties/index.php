<?php 
require_once __DIR__ . '/../../layouts/admin-sidebar.php'; 
require_once __DIR__ . '/../../../models/Property.php';
require_once __DIR__ . '/../../../core/Helper.php';

$propertyModel = new Property();
$properties = $propertyModel->read();
?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Properties</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manage all property listings.</p>
    </div>
    <a href="create.php" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium shadow-md shadow-primary/20 hover:bg-primary-light transition flex items-center gap-2">
        <span class="material-symbols-outlined text-base">add</span>
        Add New Property
    </a>
</div>

<!-- Properties Table -->
<div class="bg-white dark:bg-[#1a1625] rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col">
    <div class="overflow-x-auto custom-scrollbar flex-1 rounded-xl">
        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Listing</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-[#1a1625] divide-y divide-slate-100 dark:divide-slate-800">
                <?php while($property = $properties->fetch(PDO::FETCH_ASSOC)): ?>
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-lg object-cover" src="<?php echo BASE_URL; ?>uploads/properties/<?php echo $property['main_image'] ?? 'default.jpg'; ?>" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-slate-900 dark:text-white"><?php echo $property['title']; ?></div>
                                <div class="text-xs text-slate-500 dark:text-slate-400"><?php echo $property['city']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                        <?php echo ucfirst($property['property_type']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-800 dark:text-slate-300">
                            <?php echo ucfirst($property['listing_type']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                        <?php echo Helper::formatCurrency($property['price']); ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                            <?php echo ucfirst($property['status']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="edit.php?id=<?php echo $property['id']; ?>" class="text-primary hover:text-primary-light mr-3 transition-colors">
                            <span class="material-symbols-outlined text-lg">edit</span>
                        </a>
                        <a href="delete.php?id=<?php echo $property['id']; ?>" class="text-red-500 hover:text-red-700 transition-colors" onclick="return confirm('Are you sure you want to delete this property?');">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
                
                <?php if($properties->rowCount() == 0): ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">domain_disabled</span>
                        <p>No properties found.</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/admin-footer.php'; ?>
