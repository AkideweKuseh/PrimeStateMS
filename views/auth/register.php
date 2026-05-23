<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Register - Prime Estate</title>
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
<body class="font-body bg-background-light text-slate-800 min-h-screen flex m-0 p-0 overflow-hidden">
<!-- Split Screen Layout -->
<div class="w-full flex flex-col lg:flex-row h-screen overflow-hidden">
    <!-- Left Side: Hero Image & Branding -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-charcoal items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <img alt="Modern luxury home exterior" class="absolute inset-0 w-full h-full object-cover opacity-60" src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1200&q=80"/>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/30 to-black/40"></div>
        
        <!-- Faint vertical gridlines -->
        <div class="absolute inset-x-0 inset-y-0 z-10 flex justify-between pointer-events-none px-12">
            <div class="w-px h-full bg-white/5"></div>
            <div class="w-px h-full bg-white/5"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-left p-16 flex flex-col justify-between h-full py-20 text-white">
            <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                <div class="w-8 h-8 flex items-center justify-center border border-white/40 rotate-45">
                    <span class="material-symbols-outlined text-white text-xs -rotate-45">change_history</span>
                </div>
                <span class="font-display font-bold text-sm tracking-widest uppercase">Prime Estate</span>
            </div>
            <div>
                <h1 class="font-arch text-5xl font-black mb-6 leading-none tracking-tighter uppercase">JOIN US TODAY</h1>
                <p class="text-sm text-slate-300 font-light max-w-sm leading-relaxed">
                    Access exclusive property listings and connect with top agents worldwide. Your dream home is just a click away.
                </p>
            </div>
            <div class="text-[10px] font-display font-bold tracking-widest uppercase text-white/35">
                © <?php echo date('Y'); ?> PRIME ESTATE. ALL RIGHTS RESERVED.
            </div>
        </div>
    </div>
    
    <!-- Right Side: Registration Form -->
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
                    <h2 class="font-display text-xl font-bold tracking-wider uppercase text-slate-900">Create Your Account</h2>
                    <p class="mt-2 text-xs text-slate-400">Start your real estate journey with us.</p>
                </div>

                <!-- Flash Messages / Errors -->
                <?php 
                require_once __DIR__ . '/../../core/Helper.php';
                $flash = Helper::getFlash();
                if ($flash): 
                ?>
                    <div class="mb-6 p-4 rounded-none text-xs font-semibold <?php echo $flash['type'] === 'error' ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-green-50 text-green-600 border border-green-200'; ?>">
                        <?php echo $flash['message']; ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['errors'])): ?>
                    <div class="mb-6 p-4 rounded-none text-xs font-semibold bg-red-50 text-red-600 border border-red-200">
                        <ul class="list-disc list-inside">
                            <?php foreach($_SESSION['errors'] as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; unset($_SESSION['errors']); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Registration Form -->
                <form action="<?php echo BASE_URL; ?>controllers/AuthController.php?action=register" method="POST" class="space-y-5">
                    <input type="hidden" name="role" value="client">
                    
                    <!-- Full Name -->
                    <div>
                        <label class="block text-[10px] font-display font-bold text-slate-500 uppercase tracking-widest mb-1.5" for="full_name">Full Name</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">person</span>
                            <input class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-none bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 text-xs transition-all" id="full_name" name="full_name" placeholder="John Doe" type="text" required/>
                        </div>
                    </div>
                    
                    <!-- Email & Phone Group -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Email -->
                        <div>
                            <label class="block text-[10px] font-display font-bold text-slate-500 uppercase tracking-widest mb-1.5" for="email">Email Address</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">mail</span>
                                <input class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-none bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 text-xs transition-all" id="email" name="email" placeholder="john@example.com" type="email" required/>
                            </div>
                        </div>
                        <!-- Phone -->
                        <div>
                            <label class="block text-[10px] font-display font-bold text-slate-500 uppercase tracking-widest mb-1.5" for="phone">Phone Number</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">phone</span>
                                <input class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-none bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 text-xs transition-all" id="phone" name="phone" placeholder="+233..." type="tel"/>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Password Group -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-display font-bold text-slate-500 uppercase tracking-widest mb-1.5" for="password">Password</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">lock</span>
                                <input class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-none bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 text-xs transition-all" id="password" name="password" placeholder="••••••••" type="password" required/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-display font-bold text-slate-500 uppercase tracking-widest mb-1.5" for="confirm_password">Confirm</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">lock_reset</span>
                                <input class="block w-full pl-9 pr-3 py-2.5 border border-slate-200 rounded-none bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-slate-400 focus:border-slate-400 text-xs transition-all" id="confirm_password" name="confirm_password" placeholder="••••••••" type="password" required/>
                            </div>
                        </div>
                    </div>
                    <!-- Terms Checkbox -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input class="h-3.5 w-3.5 text-slate-900 border-slate-300 rounded-none cursor-pointer bg-white" id="terms" type="checkbox" required/>
                        </div>
                        <label class="ml-2 text-xs text-slate-400 leading-normal" for="terms">
                            I agree to the <a class="font-display font-bold uppercase tracking-wider text-slate-900 hover:text-primary-dark underline" href="#">Terms</a> &amp; <a class="font-display font-bold uppercase tracking-wider text-slate-900 hover:text-primary-dark underline" href="#">Privacy</a>.
                        </label>
                    </div>
                    <!-- Submit Button -->
                    <button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-none text-xs font-display font-bold tracking-widest uppercase text-black bg-primary hover:bg-primary-dark transition-colors shadow-sm" type="submit">
                        Create Account
                    </button>
                </form>
                <!-- Footer Link -->
                <div class="mt-8 text-center border-t border-slate-100 pt-6">
                    <p class="text-xs text-slate-400">
                        Already have an account? 
                        <a class="font-display font-bold uppercase tracking-wider text-slate-900 hover:text-primary-dark transition-colors" href="<?php echo BASE_URL; ?>views/auth/login.php">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
