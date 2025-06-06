$(document).ready(function () {
    // Xử lý khi checkbox thay đổi
    $('.country-filter').change(function () {
        filterProducts();
    });

    // Xử lý khi click vào option sắp xếp
    $('.sort-option').click(function (e) {
        e.preventDefault();
        $('.sort-option').removeClass('active');
        $(this).addClass('active');
        filterProducts();
    });

    // Xử lý nút thêm vào giỏ hàng
    $('.add-to-cart').click(function (e) {
        e.preventDefault();
        const bookId = $(this).data('book-id');
        addToCart(bookId, 1, false);
    });

    // Xử lý nút mua ngay
    $('.buy-now').click(function (e) {
        e.preventDefault();
        const bookId = $(this).data('book-id');
        buyNow(bookId, 1);
    });
});

// Hàm mua ngay
async function buyNow(bookId, quantity) {
    try {
        // Hiển thị loading
        Swal.fire({
            title: 'Đang xử lý...',
            text: 'Vui lòng đợi trong giây lát',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Gửi request thêm vào giỏ hàng với flag buy_now
        const response = await fetch('/cart/add', {
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
        });

        const data = await response.json();

        if (data.success) {
            // Cập nhật số lượng trong giỏ hàng
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement && data.cartCount) {
                cartCountElement.textContent = data.cartCount;
                cartCountElement.style.display = 'block';
            }

            // Chuyển đến trang checkout
            window.location.href = '/cart/checkout';
        } else {
            throw new Error(data.message || 'Không thể thêm sản phẩm vào giỏ hàng');
        }
    } catch (error) {
        console.error('Lỗi:', error);
        Swal.fire({
            title: 'Có lỗi xảy ra!',
            text: error.message || 'Không thể thêm sản phẩm vào giỏ hàng',
            icon: 'error',
            confirmButtonText: 'Đóng',
            confirmButtonColor: '#2a5a4c'
        });
    }
}

// Hàm thêm vào giỏ hàng
async function addToCart(bookId, quantity, redirectToCart = false) {
    try {
        // Hiển thị loading
        Swal.fire({
            title: 'Đang xử lý...',
            text: 'Vui lòng đợi trong giây lát',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Gửi request thêm vào giỏ hàng
        const response = await fetch('/cart/add', {
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
            // Cập nhật số lượng trong giỏ hàng
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement && data.cartCount) {
                cartCountElement.textContent = data.cartCount;
                cartCountElement.style.display = 'block';
            }

            // Hiển thị thông báo thành công
            const bookTitle = $(`.product-item button[data-book-id="${bookId}"]`)
                .closest('.product-item')
                .find('.product-info h3 a')
                .text();

            Swal.fire({
                title: 'Thành công!',
                text: `Đã thêm "${bookTitle}" vào giỏ hàng`,
                icon: 'success',
                confirmButtonText: 'Xem giỏ hàng',
                showCancelButton: true,
                cancelButtonText: 'Tiếp tục mua sắm',
                confirmButtonColor: '#2a5a4c',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/cart';
                }
            });
        } else {
            throw new Error(data.message || 'Không thể thêm sản phẩm vào giỏ hàng');
        }
    } catch (error) {
        console.error('Lỗi:', error);
        Swal.fire({
            title: 'Có lỗi xảy ra!',
            text: error.message || 'Không thể thêm sản phẩm vào giỏ hàng',
            icon: 'error',
            confirmButtonText: 'Đóng',
            confirmButtonColor: '#2a5a4c'
        });
    }
}

// Hàm lọc sản phẩm
function filterProducts() {
    // Lấy danh sách quốc gia được chọn
    var selectedCountries = [];
    $('.country-filter:checked').each(function () {
        selectedCountries.push($(this).val());
    });

    // Lấy kiểu sắp xếp
    var sortType = $('.sort-option.active').data('sort');

    // Hiển thị loading
    Swal.fire({
        title: 'Đang tải...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Gọi AJAX để lấy dữ liệu
    $.ajax({
        url: '/',
        type: 'GET',
        data: {
            country: selectedCountries,
            sort: sortType
        },
        success: function (response) {
            // Parse HTML response
            var html = $(response);

            // Cập nhật grid sản phẩm
            $('#product-grid').html(html.find('#product-grid').html());

            // Cập nhật phân trang
            $('#pagination').html(html.find('#pagination').html());

            // Đóng loading
            Swal.close();

            // Cập nhật URL để có thể share
            var params = {};
            if (selectedCountries.length > 0) {
                params.country = selectedCountries;
            }
            if (sortType) {
                params.sort = sortType;
            }
            var newUrl = window.location.origin + window.location.pathname;
            if (Object.keys(params).length > 0) {
                newUrl += '?' + $.param(params);
            }
            window.history.pushState({}, '', newUrl);
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Đã có lỗi xảy ra khi lọc sản phẩm'
            });
        }
    });
} 