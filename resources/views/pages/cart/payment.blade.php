@extends('layout_product')
@section('product')
<link href="{{ asset('fontend/css/payment.css') }}" rel="stylesheet" />

<div class="container" style="padding: 40px 0; ">
    <form action="{{ URL::to('/order-place') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                
                <!-- 1. Địa chỉ nhận hàng -->
                <div class="payment-card">
                    <div class="card-header-custom">
                        <h4>Địa chỉ nhận hàng</h4>
                        <a href="javascript:void(0)" class="change-link" onclick="document.getElementById('address-selection-modal').style.display='flex'">Thay đổi</a>
                    </div>
                    <?php 
                        $shopping_id = Session::get('shopping_id');
                        $shopping = DB::table('shopping')->where('shopping_id', $shopping_id)->first();
                    ?>
                     @if($shopping)
                    <div class="address-info">
                        <span class="badge-home">Nhà riêng</span>
                        <strong>{{ $shopping->shopping_name }} - {{ $shopping->shopping_phone }}</strong>
                        <p class="mt-2 text-muted">{{ $shopping->shopping_address }}</p>
                    </div>
                    @else
                    <div class="text-danger">Vui lòng cập nhật địa chỉ giao hàng.</div>
                    @endif
                </div>

                <!-- 2. Hình thức thanh toán -->
                <div class="payment-card mt-3">
                <div class="card-header-custom">
                        <h4>Hình thức thanh toán</h4>
                        <a href="javascript:void(0)" class="change-link" onclick="document.getElementById('payment-method-modal').style.display='flex'">Thay đổi</a>
                    </div>
                    <div class="payment-method-row">
                        <label class="radio-container">
                            <input type="radio" name="payment_option" value="1" checked>
                            <span class="checkmark"></span>
                            <span class="method-text">
                                <img src="https://example.com/cod-icon.png" class="method-icon" alt="" style="display:none;"> <!-- Icon placeholder -->
                                <span class="material-symbols-outlined text-warning" style="vertical-align: middle; margin-right: 5px;">payments</span>
                                Thanh toán khi nhận hàng (COD)
                            </span>
                        </label>
                    </div>
                </div>

                <!-- 3. Phiếu mua hàng -->
                <div class="payment-card mt-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Phiếu mua hàng</h4>
                    <a href="#" class="change-link">Chọn phiếu mua hàng</a>
                </div>

                <!-- 4. Mã giảm giá -->
                <div class="payment-card mt-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Mã giảm giá</h4>
                    <a href="#" class="change-link">Nhập mã giảm giá</a>
                </div>

                <!-- 5. Thông tin kiện hàng -->
                <div class="payment-card mt-3">
                    <div class="card-header-custom"><h4>Thông tin kiện hàng</h4></div>
                    <div class="delivery-estimate">
                        <span class="material-symbols-outlined text-success">local_shipping</span>
                        <div class="estimate-text">
                            <strong>Giao trong 4-6 ngày</strong><br>
                            <span class="text-muted text-sm">Giao hàng tiêu chuẩn</span>
                        </div>
                        <div class="shipping-fee text-end flex-grow-1">
                            <span class="badge-fee">10.000 ₫</span>
                        </div>
                    </div>

                    <div class="card-body-custom mt-3">
                        <?php $content = Cart::content(); ?>
                        @foreach($content as $v_content)
                        <div class="item-row">
                            <img src="{{ asset('uploads/product/'.$v_content->options->image) }}" width="60">
                            <div class="item-detail">
                                <span class="badge-hotosu">Hot</span>
                                <p class="name">{{ $v_content->name }}</p>
                                <p class="qty text-muted">{{ $v_content->options->product_weight ?? '1 gói' }}</p>
                            </div>
                            <div class="item-meta text-end">
                                <div class="item-qty">Qty: {{ $v_content->qty }}</div>
                                <div class="item-price">{{ number_format($v_content->price * $v_content->qty, 0, ',', '.') }}₫</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- 6. Ghi chú & Đặt hàng Footer -->
                <div class="payment-card mt-3">
                    <div class="row align-items-center">
                         <div class="col-md-7">
                            <input type="text" name="order_note" class="form-control note-input" placeholder="Ghi chú">
                         </div>
                         <div class="col-md-5 text-end">
                             <span class="text-muted">Tổng tiền ({{ Cart::count() }})</span>
                             <span class="total-price-large text-danger ms-2">{{ Cart::total(0, ',', '.') }}₫</span>
                             <button type="submit" class="btn btn-order-confirm-lg ms-3">Đặt hàng</button>
                             <p class="policy-text-sm mt-2">Nhấn "Đặt hàng" đồng nghĩa việc bạn đồng ý tuân theo <a href="#">Chính sách Hasaki</a></p>
                         </div>
                    </div>
                </div>

            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="payment-summary sticky-top" style="top: 20px;">
                    <button type="submit" class="btn btn-order-confirm w-100 mb-3">Đặt hàng</button>
                    
                    <div class="d-flex justify-content-between bg-light p-2 rounded mb-3">
                        <span class="text-muted">Thông tin xuất hóa đơn</span>
                        <a href="#" class="change-link">Nhập</a>
                    </div>

                    <div class="summary-header">
                        <h4>Đơn hàng</h4>
                        <a href="{{ URL::to('/show_cart') }}" class="change-link">Thay đổi</a>
                    </div>
                    
                    <div class="summary-row">
                        <span>Tạm tính ({{ Cart::count() }})</span>
                        <span>{{ Cart::subtotal(0, ',', '.') }} ₫</span>
                    </div>
                    <div class="summary-row">
                        <span>Giảm giá</span>
                        <span>-0 ₫</span>
                    </div>
                    <div class="summary-row">
                        <span>Phí vận chuyển</span>
                        <span>10.000 ₫</span>
                    </div>
                    
                    <div class="divider my-3"></div>

                    <div class="summary-row total">
                        <span>Thành tiền (Đã VAT)</span>
                        <span class="price-final">{{ Cart::total(0, ',', '.') }} ₫</span>
                    </div>
                    
                    <p class="policy-text mt-3">Đã bao gồm VAT, phí đóng gói, phí vận chuyển và các chi phí khác vui lòng xem <a href="#">Chính sách vận chuyển</a></p>
                </div>
            </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Payment Method Modal Confirmation
        const confirmPaymentBtn = document.querySelector('#payment-method-modal .btn-confirm');
        if(confirmPaymentBtn) {
            confirmPaymentBtn.addEventListener('click', function() {
                // Get selected option from modal
                const selectedOption = document.querySelector('input[name="modal_payment_option"]:checked');
                if(selectedOption) {
                    const val = selectedOption.value;
                    const text = selectedOption.closest('.radio-container').querySelector('.method-text').innerText.trim();
                    
                    // Update main form input
                    // We assume there's a radio in the main form with name 'payment_option'
                    // If the main form only has one radio that is always checked/hidden, we update its value
                    const mainInput = document.querySelector('input[name="payment_option"]');
                    if(mainInput) {
                        mainInput.value = val;
                    }

                    // Update UI Text
                    const mainMethodText = document.querySelector('.payment-method-row .method-text');
                    if(mainMethodText) {
                        // Clear existing content
                        mainMethodText.innerHTML = '';
                        // Add icon based on val
                        let iconName = 'payments'; // default for COD
                        let iconClass = 'text-warning';
                        
                        if(val == '1') { iconName = 'payments'; iconClass = 'text-warning'; }
                        else if(val == '2') { iconName = 'credit_card'; iconClass = 'text-primary'; }
                        else { iconName = 'account_balance'; iconClass = 'text-info'; } // General for others

                        mainMethodText.innerHTML = `<span class="material-symbols-outlined ${iconClass}" style="vertical-align: middle; margin-right: 5px;">${iconName}</span> ${text}`;
                    }
                }
                
                // Close modal
                document.getElementById('payment-method-modal').style.display='none';
            });
        }
    });

    // Handle Address Modal Confirmation (Placeholder for now)
    const confirmAddressBtn = document.querySelector('#address-selection-modal .btn-confirm');
        if(confirmAddressBtn) {
            confirmAddressBtn.addEventListener('click', function() {
                // Logic to update address would go here
                document.getElementById('address-selection-modal').style.display='none';
            });
        }
</script>


@endsection



@include('pages.cart.payment_modal_snippet')
@include('pages.cart.payment_method_modal')

