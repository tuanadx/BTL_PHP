// Chức năng chuyển đổi tab
document.addEventListener('DOMContentLoaded', function() {
    const tabHeaders = document.querySelectorAll('.tab-header');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Xóa lớp active khỏi tất cả các header và pane
            tabHeaders.forEach(h => h.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));
            
            // Thêm lớp active vào header và pane hiện tại
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Chức năng chọn số lượng
    const minusBtn = document.querySelector('.quantity-btn.minus');
    const plusBtn = document.querySelector('.quantity-btn.plus');
    const quantityInput = document.querySelector('#quantity');
    const maxQuantity = parseInt(quantityInput.getAttribute('max'));
    
    minusBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if(value > 1) {
            quantityInput.value = value - 1;
        }
    });
    
    plusBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if(value < maxQuantity) {
            quantityInput.value = value + 1;
        }
    });
    
    // Chức năng thêm vào giỏ hàng
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    if(addToCartBtn) {
        // Remove any existing event listeners
        const clone = addToCartBtn.cloneNode(true);
        addToCartBtn.parentNode.replaceChild(clone, addToCartBtn);
        
        let isProcessing = false;
        clone.addEventListener('click', async function() {
            if (isProcessing) return;
            
            const bookId = this.getAttribute('data-book-id');
            const quantity = document.querySelector('#quantity').value;
            const bookTitle = document.querySelector('.book-title').textContent;
            
            // Disable button and set processing state
            isProcessing = true;
            this.disabled = true;
            
            // Hiển thị trạng thái đang xử lý
            Swal.fire({
                title: 'Đang xử lý...',
                text: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            try {
                const response = await fetch(`${baseUrl}/cart/add`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        book_id: bookId,
                        quantity: quantity
                    })
                });
                
                const data = await response.json();
                
                if(data.success) {
                    // Cập nhật số lượng giỏ hàng
                    const cartCountElement = document.querySelector('.cart-count');
                    if (cartCountElement && data.cart_count) {
                        cartCountElement.textContent = data.cart_count;
                    }
                    
                    // Hiển thị thông báo thành công
                    Swal.fire({
                        title: 'Thêm vào giỏ hàng thành công!',
                        text: `Đã thêm ${quantity} cuốn "${bookTitle}" vào giỏ hàng`,
                        icon: 'success',
                        confirmButtonText: 'Xem giỏ hàng',
                        showCancelButton: true,
                        cancelButtonText: 'Tiếp tục mua sắm',
                        customClass: {
                            confirmButton: 'swal-confirm-button',
                            cancelButton: 'swal-cancel-button'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `${baseUrl}/cart`;
                        }
                    });
                } else {
                    // Hiển thị thông báo lỗi
                    Swal.fire({
                        title: 'Có lỗi xảy ra!',
                        text: data.message || 'Không thể thêm sản phẩm vào giỏ hàng',
                        icon: 'error',
                        confirmButtonText: 'Đóng'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                // Hiển thị thông báo lỗi
                Swal.fire({
                    title: 'Có lỗi xảy ra!',
                    text: 'Không thể kết nối đến máy chủ',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            } finally {
                // Re-enable button and reset processing state
                isProcessing = false;
                this.disabled = false;
            }
        });
    }
    
    // Chức năng mua ngay
    const buyNowBtn = document.querySelector('.buy-now-btn');
    if(buyNowBtn) {
        buyNowBtn.addEventListener('click', function() {
            const bookId = this.getAttribute('data-book-id');
            const quantity = document.querySelector('#quantity').value;
            
            // Hiển thị trạng thái đang xử lý
            Swal.fire({
                title: 'Đang xử lý...',
                text: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Đầu tiên thêm vào giỏ hàng sau đó chuyển hướng đến trang thanh toán
            fetch(`${baseUrl}/cart/add`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    book_id: bookId,
                    quantity: quantity,
                    buy_now: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.href = `${baseUrl}/cart/checkout`;
                } else {
                    // Hiển thị thông báo lỗi
                    Swal.fire({
                        title: 'Có lỗi xảy ra!',
                        text: data.message || 'Không thể tiến hành mua ngay',
                        icon: 'error',
                        confirmButtonText: 'Đóng'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Hiển thị thông báo lỗi
                Swal.fire({
                    title: 'Có lỗi xảy ra!',
                    text: 'Không thể kết nối đến máy chủ',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            });
        });
    }
    
    // Thêm style cho SweetAlert2
    const style = document.createElement('style');
    style.textContent = `
        .swal-confirm-button {
            background-color: #2a5a4c !important;
        }
        .swal-cancel-button {
            background-color: #6c757d !important;
        }
    `;
    document.head.appendChild(style);
});
