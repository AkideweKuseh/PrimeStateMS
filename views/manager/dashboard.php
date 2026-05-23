<?php
require_once __DIR__ . '/../layouts/manager-sidebar.php';
require_once __DIR__ . '/../../models/Property.php';
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../models/Tenant.php';
require_once __DIR__ . '/../../models/Rent.php';
require_once __DIR__ . '/../../models/Maintenance.php';
require_once __DIR__ . '/../../core/Helper.php';

// Instantiate Models
$propertyModel = new Property();
$bookingModel = new Booking();
$tenantModel = new Tenant();
$rentModel = new Rent();
$maintenanceModel = new Maintenance();

// Fetch Counts
$properties_stmt = $propertyModel->read();
$properties_count = $properties_stmt->rowCount();
$tenants_count = $tenantModel->readAll()->rowCount();
$pending_maintenance = $maintenanceModel->countByStatus('pending');

// Calculate Revenue
$total_revenue = $rentModel->getTotalRevenue();

// Calculate status counts
$avail_count = 0;
$occupied_count = 0;
$properties_stmt_status = $propertyModel->read();
while($p = $properties_stmt_status->fetch(PDO::FETCH_ASSOC)) {
    if (($p['status'] ?? '') === 'occupied') {
        $occupied_count++;
    } else {
        $avail_count++;
    }
}
?>

<!-- Minimalist Header -->
<div class="border-b border-slate-200 pb-5 mb-8">
    <h1 class="font-display font-black text-3xl text-slate-900 tracking-tighter uppercase">MANAGER DASHBOARD</h1>
</div>

<!-- Main Split Grid (Stats left, Hudson 8 Right Column) -->
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8 items-start">
    <!-- Left 3 Columns for Stat Cards & Status Charts -->
    <div class="lg:col-span-3 space-y-6">
        <!-- Hudson 3-Card Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between h-36">
                <div class="flex justify-between items-start">
                    <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Collected Rent</p>
                    <div class="p-1 bg-slate-900 text-white rounded-sm">
                        <span class="material-symbols-outlined text-xs">payments</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-display font-black text-2xl text-slate-900 tracking-tighter uppercase leading-none mt-2">
                        <?php echo Helper::formatCurrency($total_revenue); ?>
                    </h3>
                    <p class="text-[9px] font-semibold text-green-600 tracking-widest uppercase mt-2">Total income</p>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between h-36">
                <div class="flex justify-between items-start">
                    <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Active Residents</p>
                    <div class="p-1 bg-slate-900 text-white rounded-sm">
                        <span class="material-symbols-outlined text-xs">group</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-display font-black text-3xl text-slate-900 tracking-tighter uppercase leading-none mt-2">
                        <?php echo $tenants_count; ?>
                    </h3>
                    <p class="text-[9px] font-semibold text-slate-400 tracking-widest uppercase mt-2">Active Tenants</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between h-36">
                <div class="flex justify-between items-start">
                    <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Pending Issues</p>
                    <div class="p-1 bg-slate-900 text-white rounded-sm">
                        <span class="material-symbols-outlined text-xs">build</span>
                    </div>
                </div>
                <div>
                    <h3 class="font-display font-black text-3xl text-slate-900 tracking-tighter uppercase leading-none mt-2">
                        <?php echo $pending_maintenance; ?>
                    </h3>
                    <p class="text-[9px] font-semibold text-orange-600 tracking-widest uppercase mt-2">Requires Attention</p>
                </div>
            </div>
        </div>

        <!-- Units per Status (Segmented color bar card precisely matching screenshot) -->
        <div class="bg-white border border-slate-200 rounded p-6 shadow-sm">
            <h4 class="font-display text-[10px] font-bold tracking-widest text-slate-400 uppercase mb-6">Units per Status</h4>
            
            <div class="flex flex-wrap items-center gap-x-8 gap-y-3 mb-6 border-b border-slate-100 pb-5">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 bg-primary"></div>
                    <span class="font-display text-[10px] font-bold tracking-widest text-slate-900 uppercase">
                        <?php echo $avail_count; ?> Available Units
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 bg-[#222222]"></div>
                    <span class="font-display text-[10px] font-bold tracking-widest text-slate-900 uppercase">
                        <?php echo $occupied_count; ?> Occupied Units
                    </span>
                </div>
            </div>

            <div class="w-full h-8 flex overflow-hidden rounded-sm">
                <?php 
                $total_calc = max(1, $properties_count);
                $avail_pct = ($avail_count / $total_calc) * 100;
                $occupied_pct = ($occupied_count / $total_calc) * 100;
                ?>
                <div class="h-full bg-primary" style="width: <?php echo $avail_pct; ?>%"></div>
                <div class="h-full bg-[#222222]" style="width: <?php echo $occupied_pct; ?>%"></div>
            </div>
        </div>
    </div>

    <!-- Hudson 8 Right Column (Tall stat & mini bar chart card) -->
    <div class="bg-white border border-slate-200 rounded p-6 shadow-sm space-y-8">
        <div>
            <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Remaining Units</p>
            <h3 class="font-display font-black text-4xl text-slate-900 tracking-tighter uppercase mt-1 leading-none">
                <?php echo $avail_count; ?>
            </h3>
        </div>

        <div class="border-t border-slate-100 pt-6">
            <p class="font-display text-[9px] font-bold text-slate-400 tracking-widest uppercase">Total Listings</p>
            <h3 class="font-display font-black text-2xl text-slate-900 tracking-tighter uppercase mt-1 leading-none">
                <?php echo $properties_count; ?>
            </h3>
        </div>

        <!-- Sold / Remaining progress indicators -->
        <div class="border-t border-slate-100 pt-6 space-y-4">
            <div class="flex justify-between items-center font-display text-[9px] font-bold tracking-widest uppercase">
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 bg-[#222222] rounded-sm"></span>Occupied</span>
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 bg-primary rounded-sm"></span>Available</span>
            </div>
            
            <div class="space-y-2">
                <div class="w-full h-8 bg-[#222222] rounded-sm transition-all hover:opacity-90"></div>
                <div class="w-full h-8 bg-primary rounded-sm transition-all hover:opacity-90"></div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Row: Daily Activity custom SVG Bar Chart & Table -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Maintenance Requests (Manager specific) -->
    <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center mb-6">
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase">Recent Maintenance</h4>
                <a href="maintenance.php" class="font-display text-[9px] font-bold tracking-widest uppercase text-primary-dark hover:text-black transition-colors">View All</a>
            </div>
            <div class="space-y-4">
                <?php 
                $requests = $maintenanceModel->readAll();
                $count = 0;
                while($req = $requests->fetch(PDO::FETCH_ASSOC)): 
                    if($count >= 4) break; $count++;
                ?>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 last:border-0">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-100 rounded-sm">
                            <span class="material-symbols-outlined text-sm text-slate-900">build</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900 truncate max-w-[150px]"><?php echo $req['property_title']; ?></p>
                            <p class="text-[9px] text-slate-400 font-display tracking-widest uppercase font-bold"><?php echo $req['tenant_name']; ?></p>
                        </div>
                    </div>
                    <span class="font-display text-[8px] font-bold tracking-widest uppercase px-2 py-1 rounded-sm border border-slate-200 shadow-sm <?php echo $req['status'] === 'pending' ? 'bg-primary text-black' : 'bg-slate-950 text-white'; ?>">
                        <?php echo $req['status']; ?>
                    </span>
                </div>
                <?php endwhile; ?>
                
                <?php if($count == 0): ?>
                    <p class="text-center text-xs text-slate-400 py-4">No recent maintenance found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Rent Records -->
    <div class="bg-white border border-slate-200 rounded p-6 shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center mb-6">
                <h4 class="font-display text-sm font-bold text-slate-900 tracking-widest uppercase">Recent Payments</h4>
                <a href="rent.php" class="font-display text-[9px] font-bold tracking-widest uppercase text-primary-dark hover:text-black transition-colors">View All</a>
            </div>
            <div class="space-y-4">
                <?php 
                $rent_stmt = $rentModel->readAll();
                $count = 0;
                while($r = $rent_stmt->fetch(PDO::FETCH_ASSOC)): 
                    if($count >= 4) break; $count++;
                ?>
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 last:border-0">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-100 rounded-sm">
                            <span class="material-symbols-outlined text-sm text-slate-900">payments</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900"><?php echo $r['tenant_name']; ?></p>
                            <p class="text-[9px] text-slate-400 font-display tracking-widest uppercase font-bold"><?php echo Helper::formatCurrency($r['amount']); ?></p>
                        </div>
                    </div>
                    <span class="font-display text-[8px] font-bold tracking-widest uppercase px-2 py-1 rounded-sm border border-slate-200 shadow-sm <?php echo $r['status'] === 'paid' ? 'bg-slate-950 text-white' : 'bg-red-500 text-white'; ?>">
                        <?php echo $r['status']; ?>
                    </span>
                </div>
                <?php endwhile; ?>
                
                <?php if($count == 0): ?>
                    <p class="text-center text-xs text-slate-400 py-4">No recent payments found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/admin-footer.php'; ?>
