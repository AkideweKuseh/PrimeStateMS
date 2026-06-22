<!-- Custom Confirm & Alert Modal -->
<div id="customModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6" style="background:rgba(15,15,17,0.75);backdrop-filter:blur(6px);">
    <div id="customModalBox" class="bg-white dark:bg-[#151517] border border-slate-200 dark:border-white/10 rounded-none p-0 max-w-sm w-full shadow-2xl transform scale-95 opacity-0 transition-all duration-200 ease-out">
        <!-- Header -->
        <div class="flex items-center gap-3 px-6 pt-6 pb-4">
            <div id="customModalIconWrap" class="w-10 h-10 border flex items-center justify-center rounded-none flex-shrink-0">
                <span id="customModalIcon" class="material-symbols-outlined text-lg font-bold"></span>
            </div>
            <h3 id="customModalTitle" class="font-display font-black text-sm text-slate-900 dark:text-white uppercase tracking-tight"></h3>
        </div>
        <!-- Body -->
        <div class="px-6 pb-6">
            <p id="customModalMessage" class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed"></p>
        </div>
        <!-- Actions -->
        <div id="customModalActions" class="flex border-t border-slate-200 dark:border-white/10">
            <!-- Confirm mode: Cancel + Confirm buttons -->
            <button id="customModalCancel"
                    class="flex-1 px-5 py-3.5 text-slate-500 hover:text-slate-900 dark:hover:text-white font-display text-[10px] font-bold tracking-widest uppercase transition-colors duration-200 border-r border-slate-200 dark:border-white/10">
                Cancel
            </button>
            <button id="customModalConfirm"
                    class="flex-1 px-5 py-3.5 font-display text-[10px] font-bold tracking-widest uppercase transition-colors duration-200">
                Confirm
            </button>
        </div>
        <!-- Alert mode: single OK button -->
        <div id="customModalAlertActions" class="hidden border-t border-slate-200 dark:border-white/10">
            <button id="customModalOk"
                    class="w-full px-5 py-3.5 font-display text-[10px] font-bold tracking-widest uppercase transition-colors duration-200">
                OK
            </button>
        </div>
    </div>
</div>

<script>
/**
 * Custom Modal System — replaces native confirm() and alert()
 * 
 * Usage (confirm):
 *   showConfirmModal({
 *       title: 'Confirm Booking?',
 *       message: 'This will confirm the selected booking.',
 *       type: 'warning',         // 'warning' | 'danger' | 'info' | 'success'
 *       confirmText: 'Confirm',
 *       cancelText: 'Cancel',
 *       onConfirm: () => { window.location.href = '...'; }
 *   });
 *
 * Usage (alert):
 *   showAlertModal({
 *       title: 'Payment Failed',
 *       message: 'An error occurred while processing your payment.',
 *       type: 'danger'
 *   });
 */
(function() {
    const modal       = document.getElementById('customModal');
    const box         = document.getElementById('customModalBox');
    const iconWrap    = document.getElementById('customModalIconWrap');
    const icon        = document.getElementById('customModalIcon');
    const title       = document.getElementById('customModalTitle');
    const message     = document.getElementById('customModalMessage');
    let cancelBtn   = document.getElementById('customModalCancel');
    let confirmBtn  = document.getElementById('customModalConfirm');
    let okBtn       = document.getElementById('customModalOk');
    const confirmActions = document.getElementById('customModalActions');
    const alertActions   = document.getElementById('customModalAlertActions');

    const typeStyles = {
        warning: {
            icon: 'warning',
            iconWrap: 'border-yellow-300 bg-yellow-500/10 text-yellow-600 dark:text-primary dark:border-primary/30',
            confirmBtn: 'bg-primary/10 text-yellow-700 hover:bg-primary/20 dark:text-primary',
            okBtn: 'bg-primary/10 text-yellow-700 hover:bg-primary/20 dark:text-primary'
        },
        danger: {
            icon: 'error',
            iconWrap: 'border-red-200 bg-red-500/10 text-red-600 dark:text-red-400 dark:border-red-800/30',
            confirmBtn: 'bg-red-500/10 text-red-700 hover:bg-red-500/20 dark:text-red-400',
            okBtn: 'bg-red-500/10 text-red-700 hover:bg-red-500/20 dark:text-red-400'
        },
        info: {
            icon: 'info',
            iconWrap: 'border-blue-200 bg-blue-500/10 text-blue-600 dark:text-blue-400 dark:border-blue-800/30',
            confirmBtn: 'bg-blue-500/10 text-blue-700 hover:bg-blue-500/20 dark:text-blue-400',
            okBtn: 'bg-blue-500/10 text-blue-700 hover:bg-blue-500/20 dark:text-blue-400'
        },
        success: {
            icon: 'check_circle',
            iconWrap: 'border-green-200 bg-green-500/10 text-green-600 dark:text-green-400 dark:border-green-800/30',
            confirmBtn: 'bg-green-500/10 text-green-700 hover:bg-green-500/20 dark:text-green-400',
            okBtn: 'bg-green-500/10 text-green-700 hover:bg-green-500/20 dark:text-green-400'
        }
    };

    let _prevIconWrapClasses = '';
    let _prevConfirmBtnClasses = '';
    let _prevOkBtnClasses = '';

    function clearDynamicClasses() {
        if (_prevIconWrapClasses) iconWrap.className = 'w-10 h-10 border flex items-center justify-center rounded-none flex-shrink-0';
        if (_prevConfirmBtnClasses) confirmBtn.className = 'flex-1 px-5 py-3.5 font-display text-[10px] font-bold tracking-widest uppercase transition-colors duration-200';
        if (_prevOkBtnClasses) okBtn.className = 'w-full px-5 py-3.5 font-display text-[10px] font-bold tracking-widest uppercase transition-colors duration-200';
    }

    function applyType(type) {
        const style = typeStyles[type] || typeStyles.warning;
        clearDynamicClasses();

        icon.textContent = style.icon;
        iconWrap.className += ' ' + style.iconWrap;
        confirmBtn.className += ' ' + style.confirmBtn;
        okBtn.className += ' ' + style.okBtn;

        _prevIconWrapClasses = style.iconWrap;
        _prevConfirmBtnClasses = style.confirmBtn;
        _prevOkBtnClasses = style.okBtn;
    }

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        // Trigger animation on next frame
        requestAnimationFrame(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeModal() {
        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
    }

    // --- Confirm Modal ---
    window.showConfirmModal = function(opts) {
        const type = opts.type || 'warning';
        applyType(type);
        title.textContent    = opts.title || 'Are you sure?';
        message.textContent  = opts.message || '';
        cancelBtn.textContent = opts.cancelText || 'Cancel';
        confirmBtn.textContent = opts.confirmText || 'Confirm';

        // Show confirm actions, hide alert actions
        confirmActions.classList.remove('hidden');
        alertActions.classList.add('hidden');

        // Wire up handlers (replace old listeners by cloning)
        const newCancel  = cancelBtn.cloneNode(true);
        const newConfirm = confirmBtn.cloneNode(true);
        cancelBtn.parentNode.replaceChild(newCancel, cancelBtn);
        confirmBtn.parentNode.replaceChild(newConfirm, confirmBtn);

        // Re-assign references to newly created elements
        cancelBtn = newCancel;
        confirmBtn = newConfirm;

        cancelBtn.addEventListener('click', function() { closeModal(); });
        confirmBtn.addEventListener('click', function() {
            closeModal();
            if (typeof opts.onConfirm === 'function') opts.onConfirm();
        });

        openModal();
    };

    // --- Alert Modal ---
    window.showAlertModal = function(opts) {
        const type = opts.type || 'danger';
        applyType(type);
        title.textContent   = opts.title || 'Notice';
        message.textContent = opts.message || '';

        // Show alert actions, hide confirm actions
        confirmActions.classList.add('hidden');
        alertActions.classList.remove('hidden');

        okBtn.textContent = opts.okText || 'OK';

        const newOk = okBtn.cloneNode(true);
        okBtn.parentNode.replaceChild(newOk, okBtn);

        // Re-assign reference to newly created element
        okBtn = newOk;

        okBtn.addEventListener('click', function() {
            closeModal();
            if (typeof opts.onClose === 'function') opts.onClose();
        });

        openModal();
    };

    // Close on backdrop click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
})();
</script>
