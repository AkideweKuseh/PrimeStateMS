<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../core/Helper.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Estate - Find Your Dream Home</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;family=Syne:wght@700;800&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#EAD44C", // Luxury pale gold/yellow
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
        .hero-pattern {
            background-image: linear-gradient(rgba(17, 17, 17, 0.4), rgba(17, 17, 17, 0.8)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuDnp5Itr32QkH9icJmdUDcQod0jKm9uN5SW9Sm2LzAUf-a6JhcWGCcq_CrV8H3a9Bw7i9kN0Gzp4l6umj6a_A92tzTUSKQFZ_IUoQTv21hHz-XjlgLRdAwyAr4iasqWgA4f9TJDOMCl5F58Ejj2jCj3xZMnHBHo1X9n903tSrnb8Fq5LA_E0fmOGVYufF1Yga-RwgqBnaytI5QX1BkDYnaJapOFYgshi4nG33hpTFG8yVqEA2t2xfMHZhz6E9FEImHlchsSjiVJTd0);
            background-size: cover;
            background-position: center
        }
    </style>
</head>
<body class="font-body bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 antialiased overflow-x-hidden">

<?php
$nav_bg_class = "bg-charcoal border-b border-white/5";
if (isset($no_header_padding) && $no_header_padding) {
    $nav_bg_class = "bg-transparent border-0";
}
?>
<!-- Navigation -->
<nav class="absolute w-full z-50 <?php echo $nav_bg_class; ?> transition-all duration-300">
    <!-- Faint structural thin top layout gridline -->
    <div class="absolute bottom-0 left-0 w-full h-px bg-white/10 z-10"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between md:grid md:grid-cols-3 h-32 items-center w-full">
            <!-- Logo (Column 1) -->
            <div class="flex items-center justify-start">
                <a href="<?php echo BASE_URL; ?>" class="flex items-center decoration-none">
                    <!-- Premium 3D Isometric Cube SVG Logo -->
                    <svg viewBox="0 0 24 24" class="w-8 h-8 fill-none stroke-white stroke-[1.5]" stroke-linejoin="round">
                        <polygon points="12,3 20,7.5 12,12 4,7.5" class="fill-white/10" />
                        <polygon points="4,7.5 12,12 12,21 4,16.5" class="fill-white/20" />
                        <polygon points="12,12 20,7.5 20,16.5 12,21" class="fill-white/30" />
                    </svg>
                </a>
            </div>

            <!-- Horizontal Inline Navigation Links (Column 2) - Matches the architectural grid alignment -->
            <div class="hidden md:flex items-center justify-center space-x-10">
                <a class="text-white/80 hover:text-primary font-display text-[11px] font-bold tracking-widest uppercase transition-colors" href="<?php echo BASE_URL; ?>views/public/properties.php">Properties</a>
                <a class="text-white/80 hover:text-primary font-display text-[11px] font-bold tracking-widest uppercase transition-colors" href="<?php echo BASE_URL; ?>views/public/about.php">About Us</a>
                <a class="text-white/80 hover:text-primary font-display text-[11px] font-bold tracking-widest uppercase transition-colors" href="<?php echo BASE_URL; ?>views/public/contact.php">Contact</a>
            </div>

            <!-- Auth & Pill CTA Button (Column 3) -->
            <div class="hidden md:flex items-center justify-end space-x-6">
                <?php if (Auth::check()): ?>
                    <?php if (Auth::isAdmin()): ?>
                        <a href="<?php echo BASE_URL; ?>views/admin/dashboard.php" class="font-display text-[11px] font-bold tracking-widest uppercase text-white hover:text-primary transition-colors">Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo BASE_URL; ?>views/client/dashboard.php" class="font-display text-[11px] font-bold tracking-widest uppercase text-white hover:text-primary transition-colors">Dashboard</a>
                    <?php endif; ?>
                    <a href="<?php echo BASE_URL; ?>controllers/AuthController.php?action=logout" class="font-display text-[11px] font-bold tracking-widest uppercase text-red-400 hover:text-red-300 transition-colors">Logout</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>views/auth/login.php" class="font-display text-[11px] font-bold tracking-widest uppercase text-white/80 hover:text-white transition-colors">Log In</a>
                    <a href="<?php echo BASE_URL; ?>views/auth/register.php" class="font-display text-[11px] font-bold tracking-widest uppercase text-white/80 hover:text-white transition-colors">Register</a>
                <?php endif; ?>
                
                <a href="<?php echo BASE_URL; ?>views/public/properties.php" class="font-display text-[11px] font-semibold tracking-widest uppercase px-6 py-2.5 rounded-full bg-white text-black hover:bg-slate-100 hover:scale-105 transition-all flex items-center gap-2 shadow-md">
                    Book a Viewing
                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center justify-end">
                <button class="text-white hover:text-primary p-2">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content Wrapper (Conditionally push content down depending on landing overlay setup) -->
<div class="<?php echo (isset($no_header_padding) && $no_header_padding) ? '' : 'pt-20'; ?>">
    <!-- Flash Messages (Only rendered when message is present, avoiding top margin-collapse gaps) -->
    <?php 
    $flash = Helper::getFlash();
    if ($flash): 
    ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 mb-4 text-sm text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-800 rounded-lg bg-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-50 dark:bg-gray-800 dark:text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-400" role="alert">
                <div class="flex items-center">
                    <span class="font-medium"><?php echo $flash['message']; ?></span>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-50 text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-500 rounded-lg focus:ring-2 focus:ring-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-400 p-1.5 hover:bg-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-<?php echo $flash['type'] === 'error' ? 'red' : 'green'; ?>-400 dark:hover:bg-gray-700" onclick="this.parentElement.parentElement.style.display='none'">
                        <span class="sr-only">Close</span>
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
