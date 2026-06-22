<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

Auth::requireRole('tenant');
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Estate Tenant Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;family=Syne:wght@700;800&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#EAD44C", // Hudson 8 golden/yellow accent
                        "primary-dark": "#D1BD3C",
                        "charcoal": "#111111",
                        "charcoal-medium": "#1A1A1C",
                        "neutral-light": "#F4F4F5",
                        "neutral-cream": "#EFEFED",
                        "background-light": "#F4F4F5",
                        "background-dark": "#111111",
                    },
                    fontFamily: {
                        "display": ["Outfit", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "arch": ["Syne", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "2xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-background-light text-slate-800 h-screen overflow-hidden flex font-body">

<!-- Main Sidebar Container -->
<aside class="w-56 bg-neutral-light border-r border-slate-200 hidden md:flex flex-col flex-shrink-0 z-20">
    <div class="h-16 flex items-center px-5 border-b border-slate-200/50">
        <div class="flex items-center gap-2">
            <span class="font-display font-black text-xs tracking-[0.18em] text-slate-900 uppercase">PRIME ESTATE</span>
        </div>
    </div>

    <!-- Navigation List -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a href="<?php echo BASE_URL; ?>views/tenant/dashboard.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo $current_page == 'dashboard.php' ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">dashboard</span>
            Dashboard
        </a>
        <a href="<?php echo BASE_URL; ?>views/tenant/rent.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'rent') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">payments</span>
            My Rent
        </a>
        <a href="<?php echo BASE_URL; ?>views/tenant/maintenance.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'maintenance') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">build</span>
            Maintenance
        </a>
        <a href="<?php echo BASE_URL; ?>views/tenant/bookings.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'booking') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">event</span>
            My Bookings
        </a>
        
        <div class="pt-4 mt-4 border-t border-slate-200">
            <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase text-slate-500 hover:bg-slate-200/50 hover:text-slate-900 transition-all">
                <span class="material-symbols-outlined text-base">search</span>
                Browse Listings
            </a>
        </div>
    </nav>

    <!-- Sidebar Profile Details -->
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
            <div class="relative">
                <img alt="Tenant Profile" class="w-8 h-8 rounded-sm object-cover" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name'] ?? 'Tenant'); ?>&background=EAD44C&color=000000"/>
            </div>
            <div class="truncate">
                <h3 class="text-xs font-bold text-slate-900 truncate"><?php echo $_SESSION['user_name'] ?? 'Tenant'; ?></h3>
                <p class="text-[9px] text-slate-400 tracking-wider font-display uppercase font-bold">Tenant</p>
            </div>
        </div>
    </div>
</aside>

<!-- Main Dashboard Frame -->
<div class="flex-1 flex flex-col h-full relative overflow-hidden bg-background-light">
    <!-- Clean Minimal Top Header Bar -->
    <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 z-10 flex-shrink-0">
        <!-- Mobile Menu Trigger -->
        <button class="md:hidden p-2 rounded text-slate-600 hover:bg-slate-100">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <div class="flex items-center gap-4 ml-auto">
            <span class="text-xs font-bold text-slate-900 font-display uppercase tracking-widest bg-slate-200/80 px-2.5 py-1 rounded-sm border border-slate-300"><?php echo $_SESSION['user_name'] ?? 'Tenant'; ?></span>
            
            <a href="<?php echo BASE_URL; ?>controllers/AuthController.php?action=logout" class="text-slate-500 hover:text-red-600 transition-colors flex items-center justify-center p-2 rounded hover:bg-red-50">
                <span class="material-symbols-outlined text-base">logout</span>
            </a>
        </div>
    </header>

    <!-- Content Area Container -->
    <main class="flex-1 overflow-y-auto bg-background-light p-6 relative">
