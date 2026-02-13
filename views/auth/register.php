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
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 min-h-screen flex">
<!-- Split Screen Layout -->
<div class="w-full flex flex-col lg:flex-row h-screen overflow-hidden">
    <!-- Left Side: Hero Image & Branding -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900 items-center justify-center overflow-hidden group">
        <!-- Background Image -->
        <img alt="Modern luxury home exterior" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJmXeA5YFg64IBtVyI0A59cRUHT9q4n6fI1vel5qF48e4eaSDDmkZZIMSa3ioWubzxRUmspsTPMhjyMwO_HV0D08gpYBh48-8d2u3Gp7x1kX2e4UbEJyJaDGkIq-nPpPSvT0sE5QDxo9KE9XvQ1oodwtJAyTwhtkP2WgiTk1jb25jX0dIcwC6vwxm7RBGTkzqVAEyXm_tXRbfjr_hlpN9FHFS0xFrsH8Ih0mTBcgRtTMh5Loy8wXCkqM9MOgG4lASkWOuLblcP94U"/>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-black/30"></div>
        <!-- Content -->
        <div class="relative z-10 text-center p-12 flex flex-col items-center justify-between h-full py-20">
            <div class="flex items-center gap-2 mb-8 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                    <span class="material-symbols-outlined text-primary text-2xl">apartment</span>
                </div>
                <span class="text-white text-2xl font-bold tracking-wide">Prime Estate</span>
            </div>
            <div class="max-w-md">
                <h1 class="text-5xl font-bold text-white mb-6 leading-tight">Join Us Today</h1>
                <p class="text-white/80 text-lg font-light leading-relaxed">
                    Access exclusive property listings and connect with top agents worldwide. Your dream home is just a click away.
                </p>
            </div>
            <div class="flex gap-2">
                <div class="h-1.5 w-1.5 rounded-full bg-white"></div>
                <div class="h-1.5 w-1.5 rounded-full bg-white/40"></div>
                <div class="h-1.5 w-1.5 rounded-full bg-white/40"></div>
            </div>
        </div>
    </div>
    
    <!-- Right Side: Registration Form -->
    <div class="w-full lg:w-1/2 flex flex-col h-full bg-background-light dark:bg-background-dark overflow-y-auto">
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
                <div class="lg:hidden flex items-center justify-center gap-2 mb-8 cursor-pointer" onclick="window.location.href='<?php echo BASE_URL; ?>'">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-lg">apartment</span>
                    </div>
                    <span class="text-slate-900 dark:text-white text-xl font-bold">Prime Estate</span>
                </div>
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Create Your Account</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Start your real estate journey with us.</p>
                </div>

                <!-- Flash Messages / Errors -->
                <?php if(isset($_SESSION['errors'])): ?>
                    <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-600 dark:bg-red-900/30 dark:text-red-200 text-sm">
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
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5" for="full_name">Full Name</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">person</span>
                            <input class="w-full pl-10 pr-4 py-2.5 rounded-lg border-slate-200 dark:border-slate-600 bg-white dark:bg-[#130f1e] text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors text-sm" id="full_name" name="full_name" placeholder="John Doe" type="text" required/>
                        </div>
                    </div>
                    <!-- Email & Phone Group -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5" for="email">Email Address</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">mail</span>
                                <input class="w-full pl-10 pr-4 py-2.5 rounded-lg border-slate-200 dark:border-slate-600 bg-white dark:bg-[#130f1e] text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors text-sm" id="email" name="email" placeholder="john@example.com" type="email" required/>
                            </div>
                        </div>
                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5" for="phone">Phone Number</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">phone</span>
                                <input class="w-full pl-10 pr-4 py-2.5 rounded-lg border-slate-200 dark:border-slate-600 bg-white dark:bg-[#130f1e] text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors text-sm" id="phone" name="phone" placeholder="+233..." type="tel"/>
                            </div>
                        </div>
                    </div>
                    <!-- Password Group -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5" for="password">Password</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">lock</span>
                                <input class="w-full pl-10 pr-4 py-2.5 rounded-lg border-slate-200 dark:border-slate-600 bg-white dark:bg-[#130f1e] text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors text-sm" id="password" name="password" placeholder="••••••••" type="password" required/>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1.5" for="confirm_password">Confirm</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">lock_reset</span>
                                <input class="w-full pl-10 pr-4 py-2.5 rounded-lg border-slate-200 dark:border-slate-600 bg-white dark:bg-[#130f1e] text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-colors text-sm" id="confirm_password" name="confirm_password" placeholder="••••••••" type="password" required/>
                            </div>
                        </div>
                    </div>
                    <!-- Terms Checkbox -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input class="w-4 h-4 border-slate-300 rounded text-primary focus:ring-primary focus:ring-offset-0 bg-white dark:bg-slate-700 dark:border-slate-600" id="terms" type="checkbox" required/>
                        </div>
                        <label class="ml-2 text-sm text-slate-500 dark:text-slate-400" for="terms">
                            I agree to the <a class="text-primary hover:text-primary-dark font-medium underline decoration-primary/30 underline-offset-2" href="#">Terms &amp; Conditions</a> and <a class="text-primary hover:text-primary-dark font-medium underline decoration-primary/30 underline-offset-2" href="#">Privacy Policy</a>.
                        </label>
                    </div>
                    <!-- Submit Button -->
                    <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all shadow-primary/20 hover:shadow-primary/40" type="submit">
                        Create Account
                    </button>
                </form>
                <!-- Footer Link -->
                <div class="mt-8 text-center border-t border-slate-100 dark:border-slate-700 pt-6">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Already have an account? 
                        <a class="font-medium text-primary hover:text-primary-dark transition-colors" href="<?php echo BASE_URL; ?>views/auth/login.php">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
