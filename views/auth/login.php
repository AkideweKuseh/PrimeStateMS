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
</head>
<body class="bg-background-light font-body antialiased text-slate-800 min-h-screen flex items-center justify-center p-0 m-0 overflow-hidden">
<div class="w-full h-screen flex flex-row overflow-hidden bg-white shadow-2xl relative">
    <!-- Left Side: Hero Image Section (Matches landing page Brutalist style) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-charcoal items-center justify-center">
        <!-- Background Image -->
        <img alt="Luxury modern home" class="absolute inset-0 w-full h-full object-cover opacity-60" src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1200&q=80"/>
        <!-- Overlay Gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/30 to-black/40"></div>
        
        <!-- Faint vertical gridlines -->
        <div class="absolute inset-x-0 inset-y-0 z-10 flex justify-between pointer-events-none px-12">
            <div class="w-px h-full bg-white/5"></div>
            <div class="w-px h-full bg-white/5"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-between w-full h-full p-16 text-white">
            <!-- Logo -->
            <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                <div class="w-8 h-8 flex items-center justify-center border border-white/40 rotate-45">
                    <span class="material-symbols-outlined text-white text-sm -rotate-45">change_history</span>
                </div>
                <span class="font-display font-bold text-sm tracking-widest uppercase">Prime Estate</span>
            </div>
            <!-- Hero Content -->
            <div class="mb-12">
                <h1 class="font-arch text-5xl font-black mb-6 leading-none tracking-tighter uppercase">WELCOME BACK</h1>
                <p class="text-sm text-slate-300 font-light max-w-sm leading-relaxed">
                    Sign in to continue your journey finding the perfect space that complements your lifestyle.
                </p>
                <!-- Small feature pill -->
                <div class="mt-8 inline-flex items-center gap-2 px-4 py-2 border border-white/10 text-xs font-bold font-display tracking-wider uppercase bg-white/5">
                    <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                    DESIGN PRECISION IN LIVING
                </div>
            </div>
            <!-- Copyright -->
            <div class="text-[10px] font-display font-bold tracking-widest uppercase text-white/35">
                © <?php echo date('Y'); ?> PRIME ESTATE. ALL RIGHTS RESERVED.
            </div>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex flex-col h-full bg-neutral-light overflow-y-auto">
        <!-- Back to Home Button (Desktop) -->
        <div class="hidden lg:flex p-8 flex-none">
            <a href="<?php echo BASE_URL; ?>" class="flex items-center gap-2 text-xs font-display font-bold tracking-widest uppercase text-slate-500 hover:text-slate-900 transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Back to Home
            </a>
        </div>

        <div class="flex-1 flex flex-col items-center justify-center p-8 lg:p-16 min-h-min">
            <div class="w-full max-w-md bg-white border border-slate-200 p-8 lg:p-12 rounded-none shadow-sm">
                <!-- Mobile Logo -->
                <div class="lg:hidden flex items-center justify-center gap-2 mb-8 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                    <div class="w-6 h-6 flex items-center justify-center border border-slate-900 rotate-45">
                        <span class="material-symbols-outlined text-slate-900 text-xs -rotate-45">change_history</span>
                    </div>
                    <span class="font-display font-bold text-xs tracking-widest uppercase">Prime Estate</span>
                </div>

                <div class="text-center mb-8">
                    <h2 class="font-display text-xl font-bold tracking-wider uppercase text-slate-900">Login to Your Account</h2>
                    <p class="mt-2 text-xs text-slate-400">Enter your credentials to access your dashboard.</p>
                </div>

                <!-- Flash Messages -->
                <?php 
                require_once __DIR__ . '/../../core/Helper.php';
                $flash = Helper::getFlash();
                if ($flash): 
                ?>
                    <div class="mb-6 p-4 rounded-none text-xs font-semibold <?php echo $flash['type'] === 'error' ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-green-50 text-green-600 border border-green-200'; ?>">
                        <?php echo $flash['message']; ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo BASE_URL; ?>controllers/AuthController.php?action=login" class="space-y-5" method="POST">
                    <div class="space-y-5">
                        <!-- Email Input -->
                        <div>
                            <label class="block text-[10px] font-display font-bold text-slate-500 uppercase tracking-widest mb-1.5" for="email">Email address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400 text-sm">mail</span>
                                </div>
                                <input autocomplete="email" class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-none bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 text-xs transition-all" id="email" name="email" placeholder="name@example.com" required="" type="email" value="<?php echo $_SESSION['old_email'] ?? ''; ?>"/>
                            </div>
                        </div>
                        <!-- Password Input -->
                        <div>
                            <label class="block text-[10px] font-display font-bold text-slate-500 uppercase tracking-widest mb-1.5" for="password">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400 text-sm">lock</span>
                                </div>
                                <input autocomplete="current-password" class="block w-full pl-9 pr-10 py-2.5 border border-slate-200 rounded-none bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 text-xs transition-all" id="password" name="password" placeholder="••••••••" required="" type="password"/>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hover:text-slate-900 transition-colors" onclick="const p = document.getElementById('password'); const i = this.querySelector('span'); if(p.type === 'password'){ p.type = 'text'; i.textContent = 'visibility_off'; } else { p.type = 'password'; i.textContent = 'visibility'; }">
                                    <span class="material-symbols-outlined text-slate-400 hover:text-slate-900 text-sm">visibility</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input class="h-3.5 w-3.5 text-slate-900 border-slate-300 rounded-none cursor-pointer bg-white" id="remember-me" name="remember-me" type="checkbox"/>
                            <label class="ml-2 block text-xs font-display font-bold text-slate-500 uppercase tracking-wider cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <div class="text-xs font-display font-bold uppercase tracking-wider">
                            <a class="text-slate-500 hover:text-slate-900 transition-colors" href="#">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-none text-xs font-display font-bold tracking-widest uppercase text-black bg-primary hover:bg-primary-dark transition-colors shadow-sm" type="submit">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative mt-8">
                    <div aria-hidden="true" class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-3 bg-white text-[9px] font-display font-bold tracking-widest uppercase text-slate-400">Or continue with</span>
                    </div>
                </div>

                <!-- Social Logins (Mock) -->
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <button class="flex items-center justify-center w-full px-4 py-2.5 border border-slate-200 rounded-none bg-white text-[10px] font-display font-bold tracking-widest uppercase text-slate-500 hover:bg-slate-50 transition-colors" type="button">
                        <span class="material-symbols-outlined text-slate-400 mr-2 text-sm">mail</span> Google
                    </button>
                    <button class="flex items-center justify-center w-full px-4 py-2.5 border border-slate-200 rounded-none bg-white text-[10px] font-display font-bold tracking-widest uppercase text-slate-500 hover:bg-slate-50 transition-colors" type="button">
                        <span class="material-symbols-outlined text-slate-400 mr-2 text-sm">public</span> Facebook
                    </button>
                </div>

                <!-- Register Link -->
                <p class="mt-8 text-center text-xs text-slate-400">
                    Don't have an account? 
                    <a class="font-display font-bold uppercase tracking-wider text-slate-900 hover:text-primary-dark transition-colors" href="<?php echo BASE_URL; ?>views/auth/register.php">
                        Register here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
</body>
</html>
