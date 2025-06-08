@extends('layouts.app')

@section('content')
<div class="checkout-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout-section">
                    <h2>Thông tin giao hàng</h2>
                    <form id="checkoutForm">
                        @csrf
                        <div class="mb-3">
                            <label for="ho_ten" class="form-label">Họ tên người nhận <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ Auth::guard('khach_hang')->user()->ho_ten }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="so_dien_thoai" name="so_dien_thoai" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::guard('khach_hang')->user()->email }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="dia_chi" class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="dia_chi" name="dia_chi" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ghi_chu" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="ghi_chu" name="ghi_chu" rows="3"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="order-summary">
                    <h2>Đơn hàng của bạn</h2>
                    <div class="order-items">
                        @foreach($cartItems as $item)
                        <div class="order-item">
                            <div class="item-info">
                                <img src="{{ !empty($item->sach->anh) ? asset('storage/' . $item->sach->anh) : asset('images/default-book.jpg') }}" 
                                     alt="{{ $item->sach->ten_sach }}" class="item-image">
                                <div class="item-details">
                                    <h4>{{ $item->sach->ten_sach }}</h4>
                                    <p>Số lượng: {{ $item->so_luong }}</p>
                                    <p>Đơn giá: {{ number_format($item->gia_tien, 0, ',', '.') }}₫</p>
                                </div>
                            </div>
                            <div class="item-total">
                                <!-- {{ number_format($item->thanh_tien, 0, ',', '.') }}₫ -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="order-totals">
                        <div class="total-line">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($subTotal, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="total-line">
                            <span>VAT (10%):</span>
                            <span>{{ number_format($vat, 0, ',', '.') }}₫</span>
                        </div>
                        <div class="total-line">
                            <span>Phí vận chuyển:</span>
                            <span>
                                @if($shipping > 0)
                                    {{ number_format($shipping, 0, ',', '.') }}₫
                                @else
                                    <span class="free-shipping">Miễn phí</span>
                                @endif
                            </span>
                        </div>
                        @if($shipping > 0)
                        <div class="shipping-note">
                            <i class="fas fa-info-circle"></i>
                            Mua thêm {{ number_format($free_shipping_threshold - $subTotal, 0, ',', '.') }}₫ để được miễn phí vận chuyển
                        </div>
                        @endif
                        <div class="total-line grand-total">
                            <span>Tổng cộng:</span>
                            <span>{{ number_format($orderTotal, 0, ',', '.') }}₫</span>
                        </div>
                    </div>
                    
                    <div class="payment-methods">
                        <h3>Phương thức thanh toán</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">
                                <i class="fas fa-money-bill-wave"></i>
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="vnpay">
                            <label class="form-check-label" for="vnpay">
                                <i class="fas fa-credit-card"></i>
                                Thanh toán qua VNPAY
                            </label>
                        </div>
                    </div>
                    
                    <button type="button" class="btn-place-order" onclick="submitOrder()">
                        Đặt hàng
                    </button>

                    <form id="codForm" action="{{ route('cart.process-checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ho_ten" id="cod_ho_ten">
                        <input type="hidden" name="so_dien_thoai" id="cod_so_dien_thoai">
                        <input type="hidden" name="email" id="cod_email">
                        <input type="hidden" name="dia_chi" id="cod_dia_chi">
                        <input type="hidden" name="ghi_chu" id="cod_ghi_chu">
                        <input type="hidden" name="payment_method" value="cod">
                    </form>

                    <form id="vnpayForm" action="{{ route('payment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ho_ten" id="vnpay_ho_ten">
                        <input type="hidden" name="so_dien_thoai" id="vnpay_so_dien_thoai">
                        <input type="hidden" name="email" id="vnpay_email">
                        <input type="hidden" name="dia_chi" id="vnpay_dia_chi">
                        <input type="hidden" name="ghi_chu" id="vnpay_ghi_chu">
                        <input type="hidden" name="payment_method" value="vnpay">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.checkout-container {
    padding: 40px 0;
}

.checkout-section, .order-summary {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 30px;
    margin-bottom: 30px;
}

.btn-place-order {
    width: 100%;
    padding: 15px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
    text-transform: uppercase;
}

.btn-place-order:hover {
    background-color: #218838;
}

.btn-place-order:disabled {
    background-color: #6c757d;
    cursor: not-allowed;
}

.payment-methods {
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #dee2e6;
    border-radius: 5px;
}

.payment-methods h3 {
    margin-bottom: 15px;
    font-size: 18px;
}

.form-check {
    margin-bottom: 10px;
}

.form-check-label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.form-check-label i {
    font-size: 20px;
}

.form-check-input {
    cursor: pointer;
}

/* ... Rest of the styles ... */
</style>
@endpush

@push('scripts')
<script>
function submitOrder() {
    // Reset validation errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').hide();
    
    // Disable submit button
    const submitButton = $('.btn-place-order');
    submitButton.prop('disabled', true);
    
    // Get form data
    const formData = new FormData();
    formData.append('ho_ten', $('#ho_ten').val());
    formData.append('so_dien_thoai', $('#so_dien_thoai').val());
    formData.append('email', $('#email').val());
    formData.append('dia_chi', $('#dia_chi').val());
    formData.append('ghi_chu', $('#ghi_chu').val());
    formData.append('payment_method', $('input[name="payment_method"]:checked').val());
    formData.append('_token', $('input[name="_token"]').val());

    // Get selected payment method
    const paymentMethod = $('input[name="payment_method"]:checked').val();
    
    const endpoint = paymentMethod === 'cod' 
        ? '{{ route("cart.process-checkout") }}'
        : '{{ route("payment") }}';
    
    // Send request
    $.ajax({
        url: endpoint,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (paymentMethod === 'cod') {
                // Show success popup for COD
                Swal.fire({
                    icon: 'success',
                    title: 'Đặt hàng thành công!',
                    text: 'Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được xác nhận.',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/'; // Redirect to home page
                    }
                });
            } else if (response.data) {
                // Redirect to VNPay payment page
                window.location.href = response.data;
            }
        },
        error: function(xhr) {
            submitButton.prop('disabled', false);
            
            if (xhr.status === 422) {
                // Validation errors
                const errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(field => {
                    $(`#${field}`).addClass('is-invalid');
                    $(`#${field}_error`).text(errors[field][0]).show();
                });
            } else {
                // Other errors
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: xhr.responseJSON?.message || 'Có lỗi xảy ra'
                });
            }
        }
    });
}
</script>
@endpush
@endsection