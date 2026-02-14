<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Auth.php';

Auth::requireLogin();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - Prime Estate</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4913ec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#151022",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-white font-display min-h-screen flex flex-col">

<!-- Top Navigation Bar -->
<header class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 fixed top-0 w-full z-20 flex items-center justify-between px-6 shadow-sm">
    <!-- Logo -->
    <a href="<?php echo BASE_URL; ?>" class="flex items-center gap-3 w-64 text-decoration-none">
        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-xl">P</div>
        <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Prime Estate</span>
    </a>

    <!-- Search Bar -->
    <div class="flex-1 max-w-lg mx-auto hidden md:block">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-slate-400 text-xl">search</span>
            </span>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-lg leading-5 bg-slate-50 dark:bg-slate-800 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out" placeholder="Search for properties, agents, or bookings...">
        </div>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center gap-4 w-64 justify-end">
        <!-- Notification -->
        <button class="relative p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-900"></span>
        </button>
        <!-- Profile Dropdown -->
        <div class="flex items-center gap-2 cursor-pointer p-1 pr-2 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg transition-colors border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
            <img class="h-8 w-8 rounded-full object-cover shadow-sm" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name'] ?? 'Client'); ?>&background=random" alt="Profile">
            <span class="text-sm font-medium hidden lg:block"><?php echo $_SESSION['user_name'] ?? 'Client'; ?></span>
            <span class="material-symbols-outlined text-slate-400 text-lg hidden lg:block">expand_more</span>
        </div>
    </div>
</header>

<div class="flex flex-1 pt-16">
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 hidden md:flex flex-col fixed h-full z-10 top-16 pb-16">
        <!-- Client Profile Summary -->
        <div class="p-6 flex flex-col items-center border-b border-slate-100 dark:border-slate-800">
            <div class="relative">
                <img class="w-20 h-20 rounded-full object-cover border-4 border-slate-50 dark:border-slate-800 shadow-md" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name'] ?? 'Client'); ?>&background=random" alt="Avatar">
                <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 border-4 border-white dark:border-slate-900 rounded-full"></div>
            </div>
            <h3 class="mt-4 font-semibold text-lg text-slate-900 dark:text-white"><?php echo $_SESSION['user_name'] ?? 'Client'; ?></h3>
            <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-0.5 rounded-full mt-1">Client</span>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="<?php echo BASE_URL; ?>views/client/dashboard.php" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $current_page == 'dashboard.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-primary/5 hover:text-primary'; ?>">
                <span class="material-symbols-outlined mr-3 <?php echo $current_page == 'dashboard.php' ? 'text-white/90' : 'text-slate-400 group-hover:text-primary transition-colors'; ?>">dashboard</span>
                Dashboard
            </a>
            <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-primary/5 hover:text-primary transition-colors">
                <span class="material-symbols-outlined mr-3 text-slate-400 group-hover:text-primary transition-colors">explore</span>
                Browse Properties
            </a>
            <a href="<?php echo BASE_URL; ?>views/client/bookings.php" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $current_page == 'bookings.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-primary/5 hover:text-primary'; ?>">
                <span class="material-symbols-outlined mr-3 <?php echo $current_page == 'bookings.php' ? 'text-white/90' : 'text-slate-400 group-hover:text-primary transition-colors'; ?>">event_available</span>
                My Bookings
            </a>
            <a href="<?php echo BASE_URL; ?>views/client/payments.php" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $current_page == 'payments.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-primary/5 hover:text-primary'; ?>">
                <span class="material-symbols-outlined mr-3 <?php echo $current_page == 'payments.php' ? 'text-white/90' : 'text-slate-400 group-hover:text-primary transition-colors'; ?>">receipt_long</span>
                My Payments
            </a>
            <a href="<?php echo BASE_URL; ?>views/client/profile.php" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $current_page == 'profile.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-primary/5 hover:text-primary'; ?>">
                <span class="material-symbols-outlined mr-3 <?php echo $current_page == 'profile.php' ? 'text-white/90' : 'text-slate-400 group-hover:text-primary transition-colors'; ?>">settings</span>
                Profile Settings
            </a>
        </nav>

        <!-- Bottom Actions -->
        <div class="p-4 border-t border-slate-100 dark:border-slate-800">
            <a href="<?php echo BASE_URL; ?>controllers/AuthController.php?action=logout" class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg text-slate-500 hover:bg-red-50 hover:text-red-600 transition-colors">
                <span class="material-symbols-outlined mr-3 text-slate-400 group-hover:text-red-500">logout</span>
                Sign Out
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 md:ml-64 p-6 lg:p-10 overflow-x-hidden">
        
        <?php 
        require_once __DIR__ . '/../../core/Helper.php';
        $flash = Helper::getFlash();
        if ($flash): 
        ?>
            <div class="mb-6 p-4 rounded-lg flex items-center justify-between <?php echo $flash['type'] === 'error' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'; ?>">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl"><?php echo $flash['type'] === 'error' ? 'error' : 'check_circle'; ?></span>
                    <?php echo $flash['message']; ?>
                </div>
                <button onclick="this.parentElement.remove()" class="text-current hover:opacity-75">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        <?php endif; ?>
