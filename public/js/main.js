/**
 * Prime Estate - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-hide flash messages after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Sidebar Toggler for Mobile (Admin/Client Dashboard)
    // You'll need to add a button with id="sidebarToggle" to your layout
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('d-none');
            sidebar.classList.toggle('d-block');
            sidebar.classList.toggle('position-fixed');
            sidebar.classList.toggle('w-75'); // Make it wide on mobile
            sidebar.style.zIndex = '1050';
            sidebar.style.height = '100vh';
            
            // Add backdrop
            if (!document.getElementById('sidebarBackdrop')) {
                const backdrop = document.createElement('div');
                backdrop.id = 'sidebarBackdrop';
                backdrop.className = 'modal-backdrop fade show';
                document.body.appendChild(backdrop);
                
                backdrop.addEventListener('click', function() {
                    sidebarToggle.click();
                });
            } else {
                document.getElementById('sidebarBackdrop').remove();
            }
        });
    }

    // Form Validation Feedback
    const forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

});
