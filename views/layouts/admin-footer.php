
    <!-- Toast Notification -->
    <?php 
    require_once __DIR__ . '/../../core/Helper.php';
    $flash = Helper::getFlash();
    if($flash): 
        $toastColor = $flash['type'] === 'success' ? 'bg-green-500' : ($flash['type'] === 'error' ? 'bg-red-500' : 'bg-blue-500');
        $toastIcon = $flash['type'] === 'success' ? 'check_circle' : ($flash['type'] === 'error' ? 'error' : 'info');
    ?>
    <div id="toast-notification" class="fixed bottom-5 right-5 z-50 transform transition-all duration-300 translate-y-20 opacity-0">
        <div class="flex items-center w-full max-w-xs p-4 mb-4 text-white rounded-lg shadow-lg <?php echo $toastColor; ?>" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-white rounded-lg bg-white/20">
                <span class="material-symbols-outlined text-xl"><?php echo $toastIcon; ?></span>
            </div>
            <div class="ml-3 text-sm font-medium"><?php echo $flash['message']; ?></div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-transparent text-white hover:text-white/80 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-white/10 inline-flex h-8 w-8 items-center justify-center" aria-label="Close" onclick="hideToast()">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-notification');
            if(toast) {
                // Show toast
                setTimeout(() => {
                    toast.classList.remove('translate-y-20', 'opacity-0');
                }, 100);

                // Auto hide after 5 seconds
                setTimeout(() => {
                    hideToast();
                }, 5000);
            }
        });

        function hideToast() {
            const toast = document.getElementById('toast-notification');
            if(toast) {
                toast.classList.add('translate-y-20', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }
    </script>
    <?php endif; ?>

    </main>
</div>
<!-- Custom JS -->
<script src="<?php echo BASE_URL; ?>public/js/main.js"></script>
</body>
</html>
