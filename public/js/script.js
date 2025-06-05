document.addEventListener('DOMContentLoaded', function() {
    // Chức năng nút "Trở về đầu trang"
    const backToTopButton = document.querySelector('.back-to-top');
    if (backToTopButton) {
        // Xử lý sự kiện click vào nút
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0, // Cuộn lên đầu trang
                behavior: 'smooth' // Hiệu ứng cuộn mượt
            });
        });

        // Hiển thị/ẩn nút dựa trên vị trí cuộn
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) { // Nếu cuộn xuống hơn 300px
                backToTopButton.style.display = 'flex'; // Hiện nút
            } else {
                backToTopButton.style.display = 'none'; // Ẩn nút
            }
        });

        // Ban đầu ẩn nút
        backToTopButton.style.display = 'none';
    }

    // Hàm thêm vào giỏ hàng
    async function addToCart(bookId, quantity, redirectToCart = false) {
        if (!bookId) {
            console.error('Không tìm thấy ID sách!');
            Swal.fire({
                title: 'Có lỗi xảy ra!',
                text: 'Không tìm thấy ID sách',
                icon: 'error',
                confirmButtonText: 'Đóng',
                confirmButtonColor: '#2a5a4c'
            });
            return false;
        }

        try {
            // Hiển thị thông báo đang xử lý
            Swal.fire({
                title: 'Đang xử lý...',
                text: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Gửi yêu cầu AJAX
            const url = typeof baseUrl !== 'undefined' ? baseUrl + '/cart/add' : '/cart/add';
            const response = await fetch(url, {
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
            
            if (data.success) {
                // Cập nhật số lượng sản phẩm trong giỏ hàng
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement && data.cartCount) {
                    cartCountElement.textContent = data.cartCount;
                    cartCountElement.style.display = 'block';
                }

                if (redirectToCart) {
                    // Nếu là "Mua ngay" thì chuyển đến trang giỏ hàng
                    window.location.href = `${baseUrl}/cart`;
                } else {
                    // Nếu là "Thêm vào giỏ hàng" thì hiển thị thông báo
                    const productItem = document.querySelector(`[data-book-id="${bookId}"]`).closest('.product-item');
                    const bookTitle = productItem ? productItem.querySelector('.product-info h3 a').textContent : 'sản phẩm';

                    Swal.fire({
                        title: 'Thêm vào giỏ hàng thành công!',
                        text: `Đã thêm "${bookTitle}" vào giỏ hàng`,
                        icon: 'success',
                        confirmButtonText: 'Xem giỏ hàng',
                        showCancelButton: true,
                        cancelButtonText: 'Tiếp tục mua sắm',
                        confirmButtonColor: '#2a5a4c',
                        cancelButtonColor: '#6c757d'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `${baseUrl}/cart`;
                        }
                    });
                }
                return true;
            } else {
                throw new Error(data.message || 'Không thể thêm sản phẩm vào giỏ hàng');
            }
        } catch (error) {
            console.error('Lỗi:', error);
            Swal.fire({
                title: 'Có lỗi xảy ra!',
                text: error.message || 'Không thể kết nối đến máy chủ',
                icon: 'error',
                confirmButtonText: 'Đóng',
                confirmButtonColor: '#2a5a4c'
            });
            return false;
        }
    }

    // Xử lý nút "Thêm vào giỏ hàng"
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const bookId = this.dataset.bookId;
            await addToCart(bookId, 1, false);
        });
    });

    // Xử lý nút "Mua ngay"
    const buyNowButtons = document.querySelectorAll('.buy-now');
    buyNowButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const bookId = this.dataset.bookId;
            await addToCart(bookId, 1, true);
        });
    });
});
