<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Auth.php';

Auth::requireAdmin();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Estate Admin Dashboard</title>
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
                "primary-light": "#6d41ef", 
                "primary-subtle": "#ece7fd",
                "background-light": "#f6f6f8",
                "background-dark": "#151022",
                "sidebar-bg": "#ffffff",
                },
                fontFamily: {
                "display": ["Inter", "sans-serif"]
                },
                borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
            },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200 h-screen overflow-hidden flex font-display">

<!-- Sidebar -->
<aside class="w-64 bg-white dark:bg-[#1a1625] border-r border-slate-200 dark:border-slate-800 hidden md:flex flex-col flex-shrink-0 z-20">
    <!-- Logo Area -->
    <div class="h-16 flex items-center px-6 border-b border-slate-100 dark:border-slate-800/50">
        <a href="<?php echo BASE_URL; ?>" class="flex items-center gap-2 text-primary font-bold text-xl tracking-tight decoration-0">
            <span class="material-symbols-outlined text-2xl">apartment</span>
            Prime Estate
        </a>
    </div>

    <!-- Admin Profile Summary -->
    <div class="px-6 py-6 border-b border-slate-100 dark:border-slate-800/50">
        <div class="flex items-center gap-3">
            <div class="relative">
                <img alt="Admin Profile Picture" class="w-12 h-12 rounded-full object-cover border-2 border-primary/20" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name'] ?? 'Admin'); ?>&background=random"/>
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white dark:border-[#1a1625] rounded-full"></div>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo $_SESSION['user_name'] ?? 'Administrator'; ?></h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Administrator</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
        <a href="<?php echo BASE_URL; ?>views/admin/dashboard.php" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors <?php echo $current_page == 'dashboard.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-primary'; ?>">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            Dashboard
        </a>
        <a href="<?php echo BASE_URL; ?>views/admin/properties/index.php" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors <?php echo ($current_page == 'index.php' && strpos($_SERVER['PHP_SELF'], 'properties') !== false) ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-primary'; ?>">
            <span class="material-symbols-outlined text-xl">domain</span>
            Properties
        </a>
        <a href="<?php echo BASE_URL; ?>controllers/BookingController.php?action=index" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors <?php echo ($current_page == 'index.php' && strpos($_SERVER['PHP_SELF'], 'bookings') !== false) || $current_page == 'BookingController.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-primary'; ?>">
            <span class="material-symbols-outlined text-xl">event_note</span>
            Bookings
        </a>
        <a href="<?php echo BASE_URL; ?>controllers/PaymentController.php?action=index" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors <?php echo ($current_page == 'index.php' && strpos($_SERVER['PHP_SELF'], 'payments') !== false) || $current_page == 'PaymentController.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-primary'; ?>">
            <span class="material-symbols-outlined text-xl">payments</span>
            Payments
        </a>
        <a href="<?php echo BASE_URL; ?>views/admin/users/index.php" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors <?php echo ($current_page == 'index.php' && strpos($_SERVER['PHP_SELF'], 'users') !== false) || $current_page == 'users.php' ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-primary'; ?>">
            <span class="material-symbols-outlined text-xl">group</span>
            Users
        </a>

        <div class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-800/50">
            <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">System</p>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-xl">settings</span>
                Settings
            </a>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-slate-100 dark:border-slate-800/50">
        <a href="<?php echo BASE_URL; ?>controllers/AuthController.php?action=logout" class="flex items-center gap-2 text-sm text-slate-500 hover:text-red-600 transition-colors w-full px-3 py-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10">
            <span class="material-symbols-outlined text-lg">logout</span>
            Logout
        </a>
    </div>
</aside>

<!-- Main Content Wrapper -->
<div class="flex-1 flex flex-col h-full relative overflow-hidden">
    <!-- Top Bar -->
    <header class="h-16 bg-white dark:bg-[#1a1625] border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-6 z-10 flex-shrink-0">
        <!-- Mobile Menu Button -->
        <button class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <!-- Search -->
        <div class="hidden md:flex flex-1 max-w-lg relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-slate-400 text-lg">search</span>
            </span>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-200 dark:border-slate-700 rounded-lg leading-5 bg-slate-50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out" placeholder="Search properties, bookings, or clients..." />
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-4 ml-4">
            <button class="relative p-2 text-slate-500 dark:text-slate-400 hover:text-primary transition-colors rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white dark:border-[#1a1625]"></span>
            </button>
            <div class="border-l border-slate-200 dark:border-slate-700 h-6 mx-1"></div>
            <button class="flex items-center gap-2 text-sm font-medium text-slate-700 dark:text-slate-200 hover:text-primary transition-colors">
                <span class="hidden sm:inline"><?php echo $_SESSION['user_name'] ?? 'Admin'; ?></span>
                <span class="material-symbols-outlined text-lg">expand_more</span>
            </button>
        </div>
    </header>

    <!-- Main Scrollable Area -->
    <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-6">
