@extends('layout_product')
@section('product')
 
<!-- Main Content -->
        <main class="main-content">
            <div class="container">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/sanpham') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng Của Tôi</li>
                    </ol>
                </nav>

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-md-8">
                            <h1 class="page-title">Giỏ Hàng Của Tôi (3)</h1>
                            <p class="page-subtitle">Các mặt hàng được giữ trong 60 phút</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ URL::to('/sanpham') }}" class="continue-shopping">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>

                <!-- Cart Content -->
                <div class="row">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="cart-table-container">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th style="width: 45%;">Sản phẩm</th>
                                        <th style="width: 15%; text-align: center;">Giá tiền</th>
                                        <th style="width: 20%; text-align: center;">Số lượng</th>
                                        <th style="width: 20%; text-align: right;">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $v_cart)
                                    <tr>
                                        <td class="product-col">
                                            <div class="product-wrapper">
                                                <div class="product-image" 
                                                     style="background-image: url('{{ asset('uploads/product/'.$v_cart->options->image) }}')">
                                                </div>
                                                <div class="product-info">
                                                    <div class="product-brand"><a href="{{ URL::to('/thuong-hieu-san-pham/'.$v_cart->options->brand_id) }}">{{ $v_cart->options->brand_name ?? 'THƯƠNG HIỆU' }}</a></div>
                                                    <h3 class="product-name"><a href="{{ URL::to('/sanpham') }}">{{ $v_cart->name }}</a></h3>
                                                    @if(isset($v_cart->options->product_weight))
                                                        <p class="product-variant">({{ $v_cart->options->product_weight }})</p>
                                                    @endif
                                                    <div class="product-actions-links">
                                                        <a href="#" class="action-link"><span class="material-symbols-outlined">favorite</span> Yêu thích</a>
                                                        <a href="{{ URL::to('/delete-to-cart/'.$v_cart->rowId) }}" class="action-link delete"><span class="material-symbols-outlined">close</span> Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price-col">
                                            <div class="price-wrapper">
                                                <span class="current-price">{{ number_format($v_cart->price, 0, ',', '.') }} ₫</span>
                                                {{-- <span class="original-price">330.000 ₫</span> --}}
                                            </div>
                                        </td>
                                        <td class="quantity-col">
                                            <div class="quantity-box">
                                               <form action="{{ URL::to('/update-cart-quantity') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="rowId_cart" value="{{ $v_cart->rowId }}">
                                                    
                                                    <input type="number" name="cart_qty" value="{{ $v_cart->qty }}" min="1" class="qty-input" onchange="this.form.submit()">
                                                </form>
                                            </div>
                                        </td>
                                        <td class="total-col">
                                            <span class="total-price">{{ number_format($v_cart->price * $v_cart->qty, 0, ',', '.') }} ₫</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <!-- Order Summary -->
                    @if(Cart::count() > 0)
                    <div class="col-lg-4">
                        <div class="order-summary">
                            <h2 class="summary-title">Hóa đơn của bạn </h2>
                            <div class="summary-details">
                                <div class="summary-row">
                                    <span>Tạm tính</span>
                                    <span>{{ Cart::priceTotal(0, ',', '.') }}đ</span>
                                </div>
                                <div class="summary-row">
                                    <span>Giảm giá</span>
                                    <span>{{ Cart::discount(0, ',', '.') }}đ</span>
                                 </div>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="summary-total">
                                <span>Tổng cộng:</span>
                                <span class="text-primary">{{ Cart::priceTotal(0, ',', '.') }}đ</span>
                            </div>
                            <div style="text-align: right; font-size: 12px; color: #777; margin-top: 5px; margin-bottom: 10px;">(Đã bao gồm VAT)</div>
                            <?php
                                $customer_id = Session::get('customer_id');
                                $shopping_id = Session::get('shopping_id');
                            ?>

                            <div class="checkout-btn-area">
                                {{-- TRƯỜNG HỢP 1: Đã đăng nhập nhưng chưa có địa chỉ --}}
                                @if($customer_id != NULL && $shopping_id == NULL)
                                    <button type="button" class="btn-block btn-checkout" onclick="document.getElementById('address-modal').style.display='flex'">
                                        Tiến hành Thanh toán
                                    </button>

                                {{-- TRƯỜNG HỢP 2: Đã có địa chỉ rồi --}}
                                @elseif($customer_id != NULL && $shopping_id != NULL)
                                    <a href="{{ URL::to('/payment') }}" class="btn-block">
                                        <button class="btn-checkout">Thanh toán ngay</button>
                                    </a>

                                {{-- TRƯỜNG HỢP 3: Chưa đăng nhập --}}
                                @else
                                    <a href="{{ URL::to('/login-checkout') }}" class="btn-block">
                                        <button class="btn-checkout">Đăng nhập để Thanh toán</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </main>

        <!-- form địa chỉ -->
<div id="address-modal" class="modal-overlay" style="display: {{ ($errors->has('shopping_name') || $errors->has('shopping_phone') || $errors->has('shopping_city') || $errors->has('shopping_province') || $errors->has('shopping_wards') || $errors->has('shopping_address')) ? 'flex' : 'none' }};">
    <div class="modal-container">
        <div class="modal-header">
            <h3>Thêm địa chỉ mới</h3>
            <span class="close-btn" onclick="document.getElementById('address-modal').style.display='none'">&times;</span>
        </div>

        <form action="{{ URL::to('/save-checkout-customer') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group half">
                        <input type="text" name="shopping_phone" placeholder="Số điện thoại" value="{{ old('shopping_phone') }}">
                        
                        @error('shopping_phone')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group half">
                        <input type="text" name="shopping_name" value="{{ old('shopping_name', Session::get('customer_name')) }}" placeholder="Họ và tên">
                        
                        @error('shopping_name')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <select name="shopping_city" id="city">
                        <option value="">Chọn Tỉnh/ TP, Quận/ Huyện</option>
                    </select>
                    @error('shopping_city')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <select name="shopping_province" id="district">
                        <option value="">Chọn Quận/Huyện</option>
                    </select>
                    @error('shopping_province')
                        <span class="error-msg">Vui lòng chọn Quận/Huyện</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <select name="shopping_wards" id="ward">
                        <option value="">Chọn Phường/ Xã</option>
                    </select>
                    @error('shopping_wards')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" name="shopping_address" placeholder="Số nhà + Tên đường" value="{{ old('shopping_address') }}">
                    @error('shopping_address')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <p class="warning-text">Vui lòng chọn địa chỉ chính xác để giao hàng nhanh nhất.</p>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('address-modal').style.display='none'">Hủy</button>
                    <button type="submit" class="btn-confirm">Tiếp tục</button>
                </div>
            </div>
        </form>
    </div>
</div>





@endsection