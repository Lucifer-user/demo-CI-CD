@extends('layout_product')
@section('product')

<section id="cart_items">
    <div class="container">
        
        <div class="review-payment">
            <h2 class="title text-center">Cảm ơn bạn đã đặt hàng tại SALA Beauty</h2>
        </div>
        
        <div class="col-sm-12 text-center" style="padding: 50px 0;">
            <span class="material-symbols-outlined text-success" style="font-size: 64px;">check_circle</span>
            <h3 style="margin: 20px 0; font-weight: 600;">Đơn hàng của bạn đã được đặt thành công!</h3>
            <p>Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận đơn hàng.</p>
            
            <div class="mt-4">
                <a href="{{ URL::to('/') }}" class="btn btn-primary" style="background: #ee2b5b; border: none; padding: 10px 30px;">Tiếp tục mua sắm</a>
            </div>
        </div>

    </div>
</section>

@endsection
