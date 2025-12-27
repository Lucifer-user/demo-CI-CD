@extends('admin_layout')
@section('admin_content')

 <!-- SECTION: Orders -->
                    <div class="section-content" id="section-orders" style="padding: 30px; background: #f0f3f4; min-height: 100vh;">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h1 class="page-title">Quản lý Đơn hàng</h1>
                                    <p class="page-subtitle">Theo dõi và xử lý đơn hàng</p>
                                </div>
                                
                            </div>
                        </div>

                        <!-- Search and Filters -->
                        <div class="search-section mb-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="search-box">
                                        <span class="material-icons search-icon">search</span>
                                        <input type="text" class="search-input" id="order-search"
                                            placeholder="Tìm theo mã đơn, tên khách hàng, SĐT...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="order-status-filter">
                                        <option value="all">Tất cả trạng thái</option>
                                        <option value="pending">Chờ xử lý</option>
                                        <option value="processing">Đang xử lý</option>
                                        <option value="shipping">Đang giao</option>
                                        <option value="completed">Hoàn thành</option>
                                        <option value="cancelled">Đã hủy</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="order-payment-filter">
                                        <option value="all">Tất cả thanh toán</option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline - COD</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="filter-tabs">
                            <button class="filter-tab active" data-filter="all">Tất cả <span
                                    class="tab-badge">23</span></button>
                            <button class="filter-tab" data-filter="pending">Chờ xử lý <span
                                    class="tab-badge">12</span></button>
                            <button class="filter-tab" data-filter="shipping">Đang giao <span
                                    class="tab-badge">8</span></button>
                            <button class="filter-tab" data-filter="completed">Hoàn thành <span
                                    class="tab-badge">3</span></button>
                        </div>

                        <div class="products-table" >
                            <div class="table-responsive"style="padding: 1px">
                                <table class="table" id="orders-table" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Khách hàng</th>
                                       
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày đặt</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders-tbody">
                                        @foreach($all_order as $key => $order)
                                        <tr data-order-id="{{ $order->order_id }}">
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div>
                                                    <div class="product-name">#{{ $order->order_id }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="fw-medium">{{ $order->customer_name }}</div>
                                                    {{-- <div class="product-id">SĐT</div> --}}
                                                </div>
                                            </td>
                                           
                                            <td><span class="current-price">{{ number_format($order->order_total, 0, ',', '.') }}đ</span></td>
                                            <td>
                                                <span class="status-badge 
                                                    {{ $order->order_status == 'Đang chờ xử lý' ? 'status-pending' : '' }}
                                                    {{ $order->order_status == 'Đang giao' ? 'status-shipping' : '' }}
                                                    {{ $order->order_status == 'Hoàn thành' ? 'status-completed' : '' }}
                                                ">
                                                    {{ $order->order_status }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="btn-action view" title="Xem chi tiết">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    {{-- <button class="btn-action edit" data-order-id="{{ $order->order_id }}"
                                                        title="Chỉnh sửa">
                                                        <span class="material-icons">edit</span>
                                                    </button> --}}
                                                    <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="btn-action delete" title="Xóa">
                                                        <span class="material-icons">delete</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                     @endsection