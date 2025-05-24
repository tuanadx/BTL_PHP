// Main JavaScript file
document.addEventListener('DOMContentLoaded', () => {
    initApp();
});

// Initialize application
function initApp() {
    setupMobileMenu();
    setupBackToTop();
    setupAjaxDefaults();
}

// Mobile menu functionality
function setupMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navList = document.querySelector('.nav-list');
    
    if (mobileMenuToggle && navList) {
        mobileMenuToggle.addEventListener('click', () => {
            navList.classList.toggle('active');
        });
    }
}

// Back to top functionality
function setupBackToTop() {
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            backToTop.style.display = window.pageYOffset > 300 ? 'flex' : 'none';
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
}

// Setup Ajax defaults
function setupAjaxDefaults() {
    // Add CSRF token to all AJAX requests
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (token) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
    }
    
    // Set base URL from meta tag
    window.baseUrl = document.querySelector('meta[name="base-url"]')?.getAttribute('content') || '';
}

// Utility functions
window.utils = {
    formatCurrency: (amount) => {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    },

    showNotification: (message, type = 'success') => {
        Swal.fire({
            text: message,
            icon: type,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    },

    showLoading: () => {
        Swal.fire({
            text: 'Đang xử lý...',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    },

    hideLoading: () => {
        Swal.close();
    }
}; 