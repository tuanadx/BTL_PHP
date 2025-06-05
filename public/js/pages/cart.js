// Cart page functionality
document.addEventListener('DOMContentLoaded', () => {
    // Ensure we only initialize once
    if (window.cartInitialized) return;
    window.cartInitialized = true;
    
    initCartPage();
});

function initCartPage() {
    setupQuantityControls();
    setupRemoveItems();
    setupCartActions();
}

// Debounce utility function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        if (timeout) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(() => {
            func.apply(this, args);
            timeout = null;
        }, wait);
    };
}

// Quantity controls in cart
function setupQuantityControls() {
    const quantityControls = document.querySelectorAll('.quantity-controls');
    
    // Tính tổng tiền từ tất cả các sản phẩm
    function calculateSubTotal() {
        let subTotal = 0;
        document.querySelectorAll('.total').forEach(total => {
            subTotal += parseInt(total.textContent.replace(/[^\d]/g, ''));
        });
        return subTotal;
    }

    // Cập nhật tổng tiền và VAT
    function updateTotals(subTotal) {
        const vat = subTotal * 0.1; // VAT 10%
        const shipping = subTotal >= 500000 ? 0 : 30000; // Miễn phí vận chuyển khi mua trên 500k
        const orderTotal = subTotal + vat + shipping;

        // Cập nhật tạm tính
        const subtotalElement = document.querySelector('.subtotal-amount');
        if (subtotalElement) {
            subtotalElement.textContent = utils.formatCurrency(subTotal);
        }

        // Cập nhật VAT
        const vatElement = document.querySelector('.vat-amount');
        if (vatElement) {
            vatElement.textContent = utils.formatCurrency(vat);
        }

        // Cập nhật phí vận chuyển
        const shippingElement = document.querySelector('.shipping-amount');
        if (shippingElement) {
            if (shipping > 0) {
                shippingElement.textContent = utils.formatCurrency(shipping);
            } else {
                shippingElement.innerHTML = '<span class="free-shipping">Miễn phí</span>';
            }
        }

        // Cập nhật tổng cộng
        const totalElement = document.querySelector('.grand-total .total-amount');
        if (totalElement) {
            totalElement.textContent = utils.formatCurrency(orderTotal);
        }

        // Cập nhật thông báo miễn phí vận chuyển
        const shippingNote = document.querySelector('.shipping-note');
        if (shippingNote) {
            if (shipping > 0) {
                const amountToFree = 500000 - subTotal;
                shippingNote.innerHTML = `<i class="fas fa-info-circle"></i> Mua thêm ${utils.formatCurrency(amountToFree)} để được miễn phí vận chuyển`;
                shippingNote.style.display = 'block';
            } else {
                shippingNote.style.display = 'none';
            }
        }
    }
    
    quantityControls.forEach(control => {
        const input = control.querySelector('.quantity-input');
        const decreaseBtn = control.querySelector('button:first-child');
        const increaseBtn = control.querySelector('button:last-child');
        const cartDetailId = input.dataset.cartDetailId;
        const priceElement = control.closest('tr').querySelector('.price');
        const totalElement = control.closest('tr').querySelector('.total');
        const price = parseInt(priceElement.textContent.replace(/[^\d]/g, ''));
        
        // Create a single debounced update function for this control
        const debouncedUpdate = debounce(async (newQuantity) => {
            try {
                // Cập nhật thành tiền ngay lập tức
                const newTotal = price * newQuantity;
                totalElement.textContent = utils.formatCurrency(newTotal);

                // Cập nhật tổng tiền và VAT
                const newSubTotal = calculateSubTotal();
                updateTotals(newSubTotal);

                const response = await fetch(`${baseUrl}/cart/update-quantity`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ 
                        cart_detail_id: cartDetailId, 
                        quantity: newQuantity 
                    })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                if (!data.success) {
                    utils.showNotification(data.message || 'Không thể cập nhật số lượng', 'error');
                    // Reset input value and total if update failed
                    input.value = input.defaultValue;
                    const oldTotal = price * parseInt(input.defaultValue);
                    totalElement.textContent = utils.formatCurrency(oldTotal);
                    // Recalculate totals
                    const subTotal = calculateSubTotal();
                    updateTotals(subTotal);
                }
            } catch (error) {
                utils.showNotification('Không thể kết nối đến máy chủ', 'error');
                // Reset input value and total on error
                input.value = input.defaultValue;
                const oldTotal = price * parseInt(input.defaultValue);
                totalElement.textContent = utils.formatCurrency(oldTotal);
                // Recalculate totals
                const subTotal = calculateSubTotal();
                updateTotals(subTotal);
            }
        }, 500);

        // Remove old event listeners
        const newDecreaseBtn = decreaseBtn.cloneNode(true);
        const newIncreaseBtn = increaseBtn.cloneNode(true);
        const newInput = input.cloneNode(true);
        
        decreaseBtn.parentNode.replaceChild(newDecreaseBtn, decreaseBtn);
        increaseBtn.parentNode.replaceChild(newIncreaseBtn, increaseBtn);
        input.parentNode.replaceChild(newInput, input);
        
        // Store the original value when focusing
        newInput.addEventListener('focus', function() {
            this.defaultValue = this.value;
        });
        
        // Handle decrease button
        newDecreaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(newInput.value);
            if (currentValue > 1) {
                newInput.value = currentValue - 1;
                debouncedUpdate(newInput.value);
            }
        });
        
        // Handle increase button
        newIncreaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(newInput.value);
            const max = parseInt(newInput.getAttribute('max'));
            if (currentValue < max) {
                newInput.value = currentValue + 1;
                debouncedUpdate(newInput.value);
            }
        });
        
        // Handle manual input
        newInput.addEventListener('change', () => {
            let value = parseInt(newInput.value);
            const max = parseInt(newInput.getAttribute('max'));
            
            if (isNaN(value) || value < 1) {
                value = 1;
            } else if (value > max) {
                value = max;
            }
            
            newInput.value = value;
            if (value !== parseInt(newInput.defaultValue)) {
                debouncedUpdate(value);
            }
        });
    });
}

// Update cart summary
function updateCartSummary(data) {
    // Update subtotal
    const subtotalElement = document.querySelector('.subtotal-amount');
    if (subtotalElement) {
        subtotalElement.textContent = utils.formatCurrency(data.subTotal);
    }

    // Update VAT
    const vatElement = document.querySelector('.vat-amount');
    if (vatElement) {
        vatElement.textContent = utils.formatCurrency(data.vat);
    }

    // Update shipping
    const shippingElement = document.querySelector('.shipping-amount');
    if (shippingElement) {
        shippingElement.textContent = utils.formatCurrency(data.shipping);
    }

    // Update total
    const totalElement = document.querySelector('.total-amount');
    if (totalElement) {
        totalElement.textContent = utils.formatCurrency(data.orderTotal);
    }
}

// Update cart count in header
function updateCartCount(count) {
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
        if (count === 0) {
            cartCountElement.style.display = 'none';
        } else {
            cartCountElement.style.display = 'block';
        }
    }
}

// Remove items from cart
function setupRemoveItems() {
    const removeButtons = document.querySelectorAll('.remove-item');
    
    removeButtons.forEach(button => {
        button.addEventListener('click', async () => {
            const cartDetailId = button.dataset.cartDetailId;
            
            const result = await Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            });

            if (result.isConfirmed) {
                await removeCartItem(cartDetailId);
            }
        });
    });
}

// Check if cart is empty
function isCartEmpty() {
    const cartItems = document.querySelectorAll('.cart-table tbody tr');
    return cartItems.length === 0;
}

// Remove cart item
async function removeCartItem(cartDetailId) {
    try {
        utils.showLoading();
        const response = await fetch(`${baseUrl}/cart/remove`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ cart_detail_id: cartDetailId })
        });

        const data = await response.json();
        utils.hideLoading();

        // Kiểm tra response success từ server
        if (data && data.success) {
            // Remove item row from DOM
            const itemRow = document.querySelector(`tr[data-cart-detail-id="${cartDetailId}"]`);
            if (itemRow) {
                itemRow.remove();
            }
            
            // Cập nhật số lượng trong giỏ hàng
            if (typeof data.cartCount !== 'undefined') {
                updateCartCount(data.cartCount);
            }

            // Kiểm tra còn sản phẩm trong giỏ hàng không
            const cartItems = document.querySelectorAll('.cart-table tbody tr');
            if (cartItems.length === 0) {
                // Ẩn phần cart-summary nếu không còn sản phẩm
                const cartSummary = document.querySelector('.cart-summary');
                if (cartSummary) {
                    cartSummary.style.display = 'none';
                }
                
                // Hiển thị thông báo giỏ hàng trống
                const cartContent = document.querySelector('.cart-content');
                if (cartContent) {
                    cartContent.innerHTML = `
                        <h1 class="cart-title">Giỏ hàng của bạn</h1>
                        <div class="empty-cart">
                            <p>Giỏ hàng của bạn hiện đang trống.</p>
                            <a href="${baseUrl}" class="continue-btn">Tiếp tục mua hàng</a>
                        </div>
                    `;
                }
            } else {
                // Update cart summary if items remain
                updateCartSummary({
                    subTotal: data.subTotal,
                    vat: data.vat,
                    shipping: data.shipping,
                    orderTotal: data.total
                });
            }

            // Hiển thị thông báo thành công
            Swal.fire({
                title: 'Thành công!',
                text: 'Đã xóa sản phẩm khỏi giỏ hàng',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        } else {
            // Hiển thị thông báo lỗi từ server
            Swal.fire({
                title: 'Lỗi!',
                text: data.message || 'Không thể xóa sản phẩm khỏi giỏ hàng',
                icon: 'error'
            });
        }
    } catch (error) {
        utils.hideLoading();
        console.error('Error removing item:', error);
        // Hiển thị thông báo lỗi khi có lỗi kết nối hoặc parse JSON
        Swal.fire({
            title: 'Lỗi!',
            text: 'Có lỗi xảy ra khi xử lý yêu cầu',
            icon: 'error'
        });
    }
}

// Setup cart actions (clear cart, save cart)
function setupCartActions() {
    const clearCartBtn = document.querySelector('.clear-btn');
    const saveCartBtn = document.querySelector('.save-cart-btn');
    
    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', async () => {
            const result = await Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc muốn xóa tất cả sản phẩm khỏi giỏ hàng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa tất cả',
                cancelButtonText: 'Hủy',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            });

            if (result.isConfirmed) {
                await clearCart();
            }
        });
    }

    if (saveCartBtn) {
        saveCartBtn.addEventListener('click', async () => {
            try {
                utils.showLoading();
                const response = await fetch(`${baseUrl}/cart/save`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                utils.hideLoading();

                if (data.success) {
                    utils.showNotification('Đã lưu giỏ hàng', 'success');
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

// Clear cart
async function clearCart() {
    try {
        utils.showLoading();
        const response = await fetch(`${baseUrl}/cart/clear`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await response.json();
        utils.hideLoading();

        if (data.success) {
            showEmptyCartMessage();
            updateCartCount(0);
            utils.showNotification('Đã xóa tất cả sản phẩm khỏi giỏ hàng', 'success');
        } else {
            utils.showNotification(data.message || 'Có lỗi xảy ra', 'error');
        }
    } catch (error) {
        utils.hideLoading();
        utils.showNotification('Có lỗi xảy ra', 'error');
    }
}

// Update cart total
function updateCartTotal(total) {
    const totalElement = document.querySelector('.total-amount');
    if (totalElement) {
        totalElement.textContent = utils.formatCurrency(total);
    }
}

// Update item total
function updateItemTotal(bookId, total) {
    const totalElement = document.querySelector(`tr[data-book-id="${bookId}"] .total-col`);
    if (totalElement) {
        totalElement.textContent = utils.formatCurrency(total);
    }
}

// Show empty cart message
function showEmptyCartMessage() {
    // Xóa bảng giỏ hàng
    const cartTable = document.querySelector('.cart-table');
    if (cartTable) {
        cartTable.remove();
    }

    // Xóa nút tiếp tục mua hàng
    const cartActions = document.querySelector('.cart-actions');
    if (cartActions) {
        cartActions.remove();
    }

    // Xóa phần tổng tiền
    const cartSummary = document.querySelector('.cart-summary');
    if (cartSummary) {
        cartSummary.parentElement.remove(); // Xóa cả container cha của cart-summary
    }

    // Xóa nút thanh toán
    const checkoutButton = document.querySelector('.checkout-button');
    if (checkoutButton) {
        checkoutButton.remove();
    }

    // Thêm thông báo giỏ hàng trống vào cart-content
    const cartContent = document.querySelector('.cart-content');
    if (cartContent) {
        cartContent.innerHTML = `
            <h1 class="cart-title">Giỏ hàng của bạn</h1>
            <div class="empty-cart">
                <p>Giỏ hàng của bạn hiện đang trống.</p>
                <a href="${baseUrl}" class="continue-btn">Tiếp tục mua hàng</a>
            </div>
        `;
    }
} 