<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';

Auth::requireRole('manager', 'admin');
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Estate Manager Dashboard</title>
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

<!-- Sidebar Edge Utility Column -->
<div class="w-16 bg-[#EBEBEB] border-r border-slate-200 flex flex-col items-center py-6 gap-6 flex-shrink-0 z-20">
    <div class="w-10 h-10 bg-slate-900 text-white rounded flex items-center justify-center shadow-lg">
        <span class="material-symbols-outlined text-lg">change_history</span>
    </div>
    
    <div class="w-10 h-10 bg-primary text-black font-display font-extrabold text-[13px] rounded flex items-center justify-center border border-slate-300">
        M
    </div>
    
    <button class="w-10 h-10 rounded hover:bg-slate-200 text-slate-500 hover:text-slate-900 transition flex items-center justify-center">
        <span class="material-symbols-outlined text-xl">add</span>
    </button>
</div>

<!-- Main Sidebar Container -->
<aside class="w-56 bg-neutral-light border-r border-slate-200 hidden md:flex flex-col flex-shrink-0 z-20">
    <div class="h-16 flex items-center px-5 border-b border-slate-200/50">
        <div class="flex items-center gap-2">
            <span class="font-display font-black text-xs tracking-[0.18em] text-slate-900 uppercase">PRIME ESTATE</span>
        </div>
    </div>

    <!-- Segmented Toggle Option -->
    <div class="px-5 py-4 border-b border-slate-200/50">
        <div class="bg-slate-200/80 p-0.5 rounded flex text-center font-display text-[9px] font-bold tracking-widest uppercase">
            <div class="flex-1 py-1.5 bg-slate-900 text-white rounded-sm shadow-sm cursor-pointer">General</div>
            <div class="flex-1 py-1.5 text-slate-500 hover:text-slate-900 cursor-pointer">System</div>
        </div>
    </div>

    <!-- Navigation List -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <a href="<?php echo BASE_URL; ?>views/manager/dashboard.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo $current_page == 'dashboard.php' ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">dashboard</span>
            Dashboard
        </a>
        <a href="<?php echo BASE_URL; ?>views/manager/properties.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'properties') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">domain</span>
            Properties
        </a>
        <a href="<?php echo BASE_URL; ?>views/manager/tenants.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'tenants') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">group</span>
            Tenants
        </a>
        <a href="<?php echo BASE_URL; ?>views/manager/rent.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'rent') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">payments</span>
            Rent Tracking
        </a>
        <a href="<?php echo BASE_URL; ?>views/manager/maintenance.php" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'maintenance') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">build</span>
            Maintenance
        </a>
        <a href="<?php echo BASE_URL; ?>controllers/ReportController.php?action=index" class="flex items-center gap-3 px-3 py-2 rounded font-display text-[10px] font-bold tracking-widest uppercase transition-all <?php echo strpos($current_page, 'ReportController.php') !== false ? 'bg-white border border-slate-200/80 text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-900'; ?>">
            <span class="material-symbols-outlined text-base">assessment</span>
            Reports
        </a>
    </nav>

    <!-- Sidebar Profile Details -->
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
            <div class="relative">
                <img alt="Manager Profile" class="w-8 h-8 rounded-sm object-cover" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name'] ?? 'Manager'); ?>&background=EAD44C&color=000000"/>
            </div>
            <div class="truncate">
                <h3 class="text-xs font-bold text-slate-900 truncate"><?php echo $_SESSION['user_name'] ?? 'Manager'; ?></h3>
                <p class="text-[9px] text-slate-400 tracking-wider font-display uppercase font-bold">Manager</p>
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

        <!-- Search Bar -->
        <div class="hidden md:flex flex-1 max-w-sm relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-slate-400 text-sm">search</span>
            </span>
            <input type="text" class="block w-full pl-9 pr-3 py-1.5 border border-slate-200 rounded text-slate-900 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-300 focus:border-slate-300 text-xs" placeholder="Search..." />
        </div>

        <div class="flex items-center gap-4 ml-4">
            <span class="text-xs font-bold text-slate-900 font-display uppercase tracking-widest bg-slate-200/80 px-2.5 py-1 rounded-sm border border-slate-300"><?php echo $_SESSION['user_name'] ?? 'Manager'; ?></span>
            
            <a href="<?php echo BASE_URL; ?>controllers/AuthController.php?action=logout" class="text-slate-500 hover:text-red-600 transition-colors flex items-center justify-center p-2 rounded hover:bg-red-50">
                <span class="material-symbols-outlined text-base">logout</span>
            </a>
        </div>
    </header>

    <!-- Content Area Container -->
    <main class="flex-1 overflow-y-auto bg-background-light p-6 relative">
