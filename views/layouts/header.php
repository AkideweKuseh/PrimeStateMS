<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Estate - Find Your Dream Home</title>
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
                        "primary-dark": "#370eb3",
                        "background-light": "#f6f6f8",
                        "background-dark": "#151022",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .hero-pattern {
            background-image: linear-gradient(rgba(16, 28, 34, 0.6), rgba(16, 28, 34, 0.6)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuDnp5Itr32QkH9icJmdUDcQod0jKm9uN5SW9Sm2LzAUf-a6JhcWGCcq_CrV8H3a9Bw7i9kN0Gzp4l6umj6a_A92tzTUSKQFZ_IUoQTv21hHz-XjlgLRdAwyAr4iasqWgA4f9TJDOMCl5F58Ejj2jCj3xZMnHBHo1X9n903tSrnb8Fq5LA_E0fmOGVYufF1Yga-RwgqBnaytI5QX1BkDYnaJapOFYgshi4nG33hpTFG8yVqEA2t2xfMHZhz6E9FEImHlchsSjiVJTd0);
            background-size: cover;
            background-position: center
        }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-800 dark:text-white antialiased">

<!-- Navigation -->
<nav class="fixed w-full z-50 bg-white/95 dark:bg-background-dark/95 backdrop-blur-sm border-b border-slate-200 dark:border-slate-800 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2">
                <a href="<?php echo BASE_URL; ?>" class="flex items-center gap-2 decoration-0">
                    <span class="material-symbols-outlined text-primary text-3xl">real_estate_agent</span>
                    <span class="font-bold text-2xl tracking-tight text-slate-900 dark:text-white">Prime<span class="text-primary">Estate</span></span>
                </a>
            </div>
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary font-medium transition-colors" href="<?php echo BASE_URL; ?>views/public/properties.php">Properties</a>
                <a class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary font-medium transition-colors" href="<?php echo BASE_URL; ?>views/public/about.php">About Us</a>
                <a class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary font-medium transition-colors" href="<?php echo BASE_URL; ?>views/public/contact.php">Contact</a>
            </div>
            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <?php if (Auth::check()): ?>
                    <?php if (Auth::isAdmin()): ?>
                        <a href="<?php echo BASE_URL; ?>views/admin/dashboard.php" class="px-4 py-2 rounded-lg text-primary border border-primary hover:bg-primary/5 font-medium transition-colors">Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo BASE_URL; ?>views/client/dashboard.php" class="px-4 py-2 rounded-lg text-primary border border-primary hover:bg-primary/5 font-medium transition-colors">Dashboard</a>
                    <?php endif; ?>
                    <a href="<?php echo BASE_URL; ?>controllers/AuthController.php?action=logout" class="px-4 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 font-medium transition-colors">Logout</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>views/auth/login.php" class="px-4 py-2 rounded-lg text-primary hover:bg-primary/5 font-medium transition-colors">Log In</a>
                    <a href="<?php echo BASE_URL; ?>views/auth/register.php" class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary-dark shadow-lg shadow-primary/30 font-medium transition-all transform hover:-translate-y-0.5">Register</a>
                <?php endif; ?>
            </div>
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="text-slate-600 dark:text-white hover:text-primary p-2">
                    <span class="material-symbols-outlined text-3xl">menu</span>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content Wrapper (Optional, to push content down below fixed nav) -->
<div class="pt-20">
    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <?php 
        $flash = Helper::getFlash();
        if ($flash): 
        ?>
            <div class="p-4 mb-4 text-sm text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-800 rounded-lg bg-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-50 dark:bg-gray-800 dark:text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-400" role="alert">
                <div class="flex items-center">
                    <span class="font-medium"><?php echo $flash['message']; ?></span>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-50 text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-500 rounded-lg focus:ring-2 focus:ring-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-400 p-1.5 hover:bg-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-400 dark:hover:bg-gray-700" onclick="this.parentElement.parentElement.style.display='none'">
                        <span class="sr-only">Close</span>
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>

