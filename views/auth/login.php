<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login - Prime Estate</title>
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
</head>
<body class="bg-background-light dark:bg-background-dark font-display antialiased text-slate-800 dark:text-slate-100 min-h-screen flex items-center justify-center p-0 m-0 overflow-hidden">
<div class="w-full h-screen flex flex-row overflow-hidden bg-white dark:bg-background-dark shadow-2xl relative">
    <!-- Left Side: Hero Image Section -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900">
        <!-- Background Image -->
        <img alt="Luxury modern home" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB38RE4wedJcyfW-faSFF-ua151weJbPMiBTa-MeXKPKeJG5e8KW-7DPF2xb0LFpFg-S6FCQMCxp4Ou4qfBiMmnJ2Tb4L9FqyfqQh_j9_-z1sFvZlCnqGxJOEm33ZIDIdZm0Y5slcZZ2I59ptC0hG-_VGi31EOacVE6FgF8PascEfapTqVuww0zu-4epXtuy-F0QGbmpUMyd4ZixHwQYoXnIuxSRYFkn0k3Ez-3Gn7yBOX6RrR9Ps32Gc27UO3JB9TQxB_SAJXWzFE"/>
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary/90 to-purple-900/80 mix-blend-multiply"></div>
        <div class="relative z-10 flex flex-col justify-between w-full h-full p-12 text-white">
            <!-- Logo -->
            <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-lg flex items-center justify-center border border-white/30 shadow-lg">
                    <span class="material-symbols-outlined text-white">apartment</span>
                </div>
                <span class="text-2xl font-bold tracking-tight">Prime Estate</span>
            </div>
            <!-- Hero Content -->
            <div class="mb-12">
                <h1 class="text-5xl font-bold mb-6 leading-tight">Welcome Back.</h1>
                <p class="text-lg text-white/80 font-light max-w-md leading-relaxed">
                    Sign in to continue your journey finding the perfect space that complements your lifestyle.
                </p>
                <!-- Small feature pill -->
                <div class="mt-8 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-sm font-medium">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Over 12,000 new listings added this week
                </div>
            </div>
            <!-- Copyright -->
            <div class="text-sm text-white/50">
                © <?php echo date('Y'); ?> Prime Estate, Inc. All rights reserved.
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex flex-col h-full bg-white dark:bg-background-dark overflow-y-auto">
        <!-- Back to Home Button (Desktop) -->
        <div class="hidden lg:flex p-6 lg:p-8 flex-none">
            <a href="<?php echo BASE_URL; ?>" class="flex items-center gap-2 text-sm text-slate-500 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Back to Home
            </a>
        </div>

        <div class="flex-1 flex flex-col items-center justify-center p-6 lg:p-12 min-h-min">
            <div class="w-full max-w-md bg-white dark:bg-slate-800 p-8 lg:p-10 rounded-2xl shadow-xl shadow-primary/5 border border-slate-100 dark:border-slate-700">
                <!-- Mobile Logo -->
                <div class="lg:hidden flex items-center justify-center gap-2 mb-8 text-primary dark:text-white cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                    <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-sm">apartment</span>
                    </div>
                    <span class="text-xl font-bold">Prime Estate</span>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Login to Your Account</h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Enter your credentials to access your dashboard.</p>
                </div>

                <!-- Flash Messages -->
                <?php 
                require_once __DIR__ . '/../../core/Helper.php';
                $flash = Helper::getFlash();
                if ($flash): 
                ?>
                    <div class="mb-6 p-4 rounded-lg text-sm <?php echo $flash['type'] === 'error' ? 'bg-red-50 text-red-600 dark:bg-red-900/30 dark:text-red-200' : 'bg-green-50 text-green-600 dark:bg-green-900/30 dark:text-green-200'; ?>">
                        <?php echo $flash['message']; ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>controllers/AuthController.php?action=login" class="space-y-5" method="POST">
                    <div class="space-y-5">
                        <!-- Email Input -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5" for="email">Email address</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">mail</span>
                                </div>
                                <input autocomplete="email" class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg leading-5 bg-background-light dark:bg-[#130f1e] placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm dark:text-white transition-all duration-200" id="email" name="email" placeholder="name@example.com" required="" type="email"/>
                            </div>
                        </div>
                        <!-- Password Input -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5" for="password">Password</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400 text-lg">lock</span>
                                </div>
                                <input autocomplete="current-password" class="block w-full pl-10 pr-10 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg leading-5 bg-background-light dark:bg-[#130f1e] placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary sm:text-sm dark:text-white transition-all duration-200" id="password" name="password" placeholder="••••••••" required="" type="password"/>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-slate-400 hover:text-primary text-lg">visibility</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input class="h-4 w-4 text-primary focus:ring-primary border-slate-300 rounded cursor-pointer bg-white dark:bg-slate-700 dark:border-slate-600" id="remember-me" name="remember-me" type="checkbox"/>
                            <label class="ml-2 block text-sm text-slate-600 dark:text-slate-400 cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <div class="text-sm">
                            <a class="font-medium text-primary hover:text-primary-dark transition-colors" href="#">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" type="submit">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative mt-8">
                    <div aria-hidden="true" class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200 dark:border-slate-700"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-2 bg-white dark:bg-slate-800 text-sm text-slate-500">Or continue with</span>
                    </div>
                </div>

                <!-- Social Logins (Mock) -->
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <button class="flex items-center justify-center w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg shadow-sm bg-white dark:bg-slate-700/50 text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" type="button">
                        <span class="material-symbols-outlined text-red-500 mr-2 text-base">mail</span> Google
                    </button>
                    <button class="flex items-center justify-center w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg shadow-sm bg-white dark:bg-slate-700/50 text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" type="button">
                        <span class="material-symbols-outlined text-blue-600 mr-2 text-base">public</span> Facebook
                    </button>
                </div>

                <!-- Register Link -->
                <p class="mt-8 text-center text-sm text-slate-500 dark:text-slate-400">
                    Don't have an account? 
                    <a class="font-semibold text-primary hover:text-primary-dark transition-colors" href="<?php echo BASE_URL; ?>views/auth/register.php">
                        Register here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
