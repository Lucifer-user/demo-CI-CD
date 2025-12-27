@extends('admin_layout')
@section('admin_content')

<style>
    /* CSS cũ giữ nguyên */
    .invoice-title h2, .invoice-title h3 { display: inline-block; }
    .table > tbody > tr > .no-line { border-top: none; }
    .table >thead > tr > .no-line { border-bottom: none; }
    .table > tbody > tr > .thick-line { border-top: 2px solid; }
    
    /* CSS cho Card/Panel */
    .card {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid #e7e7e7;
        border-radius: 4px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .card-header {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
    }
    
    /* Màu sắc Card */
    .card-info { border-top: 3px solid #31708f; }
    .card-info > .card-header { color: #31708f; background-color: #d9edf7; }
    
    .card-success { border-top: 3px solid #3c763d; }
    .card-success > .card-header { color: #3c763d; background-color: #dff0d8; }
    
    .card-default { border-top: 3px solid #ddd; }
    
    /* Căn lề khi in */
    @media print { .no-print { display: none !important; } }
</style>

<div class="table-agile-info" style="padding: 30px; background-color: #f0f3f4;">
    
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">
            <div class="invoice-title">
                <h3 style="margin-top: 0; font-weight: bold;">CHI TIẾT ĐƠN HÀNG #{{$order_by_id->order_id}}</h3>
            </div>
            <div class="pull-right no-print">
                <a href="javascript:window.print()" class="btn btn-primary"><i class="fa fa-print"></i> In hóa đơn</a>
                <a href="{{URL::to('/admin/manage_order')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <i class="fa fa-user"></i> Thông tin khách hàng
                </div>
                <div class="card-body" style="padding: 15px;">
                    <address style="margin-bottom: 0;">
                        <strong>Tên khách hàng:</strong> {{$order_by_id->customer_name}}<br>
                       
                        <strong>Email:</strong> {{$order_by_id->customer_email ?? '---'}}
                    </address>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <i class="fa fa-truck"></i> Thông tin vận chuyển
                </div>
                <div class="card-body" style="padding: 15px;">
                    <address style="margin-bottom: 0;">
                        <strong>Người nhận:</strong> {{$order_by_id->shopping_name}}<br>
                        <strong>SĐT nhận hàng:</strong> {{$order_by_id->shopping_phone}}<br>
                        <strong>Địa chỉ:</strong> {{$order_by_id->shopping_address}}, {{$order_by_id->shopping_wards}}, {{$order_by_id->shopping_province}}, {{$order_by_id->shopping_city}}
                    </address>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header" style="background-color: #f9f9f9;">
                    <i class="fa fa-credit-card"></i> Phương thức thanh toán
                </div>
                <div class="card-body" style="padding: 15px;">
                    @if($order_by_id->payment_method == 1)
                        Tiền mặt khi nhận hàng (COD)
                    @elseif($order_by_id->payment_method == 2)
                        Chuyển khoản ngân hàng
                    @else
                        Thanh toán qua thẻ
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header" style="background-color: #f9f9f9;">
                    <i class="fa fa-history"></i> Trạng thái đơn hàng
                </div>
                <div class="card-body" style="padding: 15px;">
                    <span style="font-weight: bold; color: #d35400;">
                        {{$order_by_id->order_status}}
                    </span>
                    <br>
                    <small>Ngày đặt: {{ \Carbon\Carbon::parse($order_by_id->created_at)->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="border-top: 3px solid #333;">
                <div class="panel-heading" style="background: #fff; padding: 15px;">
                    <h3 class="panel-title" style="font-weight: bold; font-size: 18px;">Tóm tắt đơn hàng</h3>
                </div>
                <div class="panel-body" style="padding: 1px;">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background-color: #f5f5f5;">
                                    <td style="padding: 15px;"><strong>Sản phẩm</strong></td>
                                    <td class="text-center" style="padding: 15px;"><strong>Giá</strong></td>
                                    <td class="text-center" style="padding: 15px;"><strong>Số lượng</strong></td>
                                    <td class="text-right" style="padding: 15px;"><strong>Tổng tiền</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_details as $key => $details)
                                <tr>
                                    <td style="padding: 15px;">{{$details->product_name}}</td>
                                    <td class="text-center" style="padding: 15px;">{{number_format($details->product_price,0,',','.')}}đ</td>
                                    <td class="text-center" style="padding: 15px;">{{$details->product_sales_quantity}}</td>
                                    <td class="text-right" style="padding: 15px;">{{number_format($details->product_price * $details->product_sales_quantity,0,',','.')}}đ</td>
                                </tr>
                                @endforeach
                                
                                <tr style="background-color: #fff;">
                                    <td colspan="3" class="text-right" style="padding: 20px; font-weight: bold; font-size: 16px;">Tổng cộng:</td>
                                    <td class="text-right" style="padding: 20px;">
                                        <strong style="font-size: 20px; color: #d35400;">{{number_format($order_by_id->order_total,0,',','.')}}đ</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection