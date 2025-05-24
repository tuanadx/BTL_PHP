// Book detail page functionality
document.addEventListener('DOMContentLoaded', () => {
    initDetailPage();
});

function initDetailPage() {
    setupQuantityControls();
    setupAddToCart();
    setupBuyNow();
    setupTabs();
}

// Quantity controls
function setupQuantityControls() {
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.querySelector('.quantity-btn.decrease');
    const increaseBtn = document.querySelector('.quantity-btn.increase');
    
    if (quantityInput && decreaseBtn && increaseBtn) {
        decreaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value);
            const maxQuantity = parseInt(quantityInput.getAttribute('max'));
            if (currentValue < maxQuantity) {
                quantityInput.value = currentValue + 1;
            }
        });

        // Validate manual input
        quantityInput.addEventListener('change', () => {
            const value = parseInt(quantityInput.value);
            const max = parseInt(quantityInput.getAttribute('max'));
            if (isNaN(value) || value < 1) {
                quantityInput.value = 1;
            } else if (value > max) {
                quantityInput.value = max;
            }
        });
    }
}

// Add to cart functionality
function setupAddToCart() {
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', async () => {
            const bookId = addToCartBtn.dataset.bookId;
            const quantity = document.getElementById('quantity').value;

            try {
                utils.showLoading();
                const response = await fetch(`${baseUrl}/cart/add`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ book_id: bookId, quantity: quantity })
                });

                const data = await response.json();
                utils.hideLoading();

                if (data.success) {
                    utils.showNotification('Thêm vào giỏ hàng thành công', 'success');
                    updateCartCount(data.cartCount);
                } else {
                    utils.showNotification(data.message || 'Có lỗi xảy ra', 'error');
                }
            } catch (error) {
                utils.hideLoading();
                utils.showNotification('Có lỗi xảy ra', 'error');
            }
        });
    }
}

// Buy now functionality
function setupBuyNow() {
    const buyNowBtn = document.querySelector('.buy-now-btn');
    if (buyNowBtn) {
        buyNowBtn.addEventListener('click', () => {
            const bookId = buyNowBtn.dataset.bookId;
            const quantity = document.getElementById('quantity').value;
            window.location.href = `${baseUrl}/checkout?book_id=${bookId}&quantity=${quantity}`;
        });
    }
}

// Tab functionality
function setupTabs() {
    const tabHeaders = document.querySelectorAll('.tab-header');
    const tabContents = document.querySelectorAll('.tab-pane');

    tabHeaders.forEach(header => {
        header.addEventListener('click', () => {
            // Remove active class from all headers and contents
            tabHeaders.forEach(h => h.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            // Add active class to clicked header and corresponding content
            header.classList.add('active');
            const tabId = header.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
}

// Update cart count in header
function updateCartCount(count) {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        cartCount.textContent = count;
    }
} 