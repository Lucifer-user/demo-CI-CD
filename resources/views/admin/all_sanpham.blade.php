@extends('admin_layout')
@section('admin_content')
<div class="section-content active" id="section-products" style="padding: 50px">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="page-title">Quản lý Sản phẩm</h1>
                <p class="page-subtitle">Danh sách sản phẩm hiện có</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ URL::to('/admin/add_sanpham') }}" class="btn btn-primary">
                    <span class="material-icons">add</span>
                    Thêm sản phẩm
                </a>
            </div>
        </div>
    </div>
    <br>

    <div class="products-table" style="padding: 0.1px;" >
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_sanpham as $key => $pro)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('uploads/product/'.$pro->product_image) }}"
                                    alt="{{ $pro->product_name }}" class="product-image" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="product-details">
                                    <div class="product-name">{{ $pro->product_name }}</div>
                                    <div class="product-id">ID: {{ $pro->product_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $pro->brand_name }}</td>
                        <td>
                            <span class="category-badge">{{ $pro->category_name }}</span>
                        </td>
                        <td>
                            <div class="current-price">{{ number_format($pro->product_price) }}đ</div>
                        </td>
                        <td>
                            <?php
                            if($pro->product_status==0){
                            ?>
                            <a href="{{URL::to('/unactive-sanpham/'.$pro->product_id)}}"><span class="status-badge in-stock text-success">Hiển thị</span></a>
                            <?php
                            }else{
                            ?>
                            <a href="{{URL::to('/active-sanpham/'.$pro->product_id)}}"><span class="status-badge out-of-stock text-danger">Ẩn</span></a>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="javascript:void(0)" 
                                   class="btn-action view btn-view-details" 
                                   style="color: #6c5ce7;"
                                   data-name="{{ $pro->product_name }}"
                                   data-image="{{ asset('uploads/product/'.$pro->product_image) }}"
                                   data-id="{{ $pro->product_id }}"
                                   data-price="{{ number_format($pro->product_price) }}"
                                   data-cate="{{ $pro->category_name }}"
                                   data-brand="{{ $pro->brand_name }}"
                                   data-desc="{{ $pro->product_description }}"
                                   data-ingredient="{{ $pro->product_ingredient }}"
                                   data-weight="{{ $pro->product_weight }}"
                                   data-origin="{{ $pro->product_origin }}"
                                   data-expiry="{{ $pro->product_expiry }}"
                                   data-usage="{{ $pro->product_usage }}"
                                   data-status="{{ $pro->product_status }}">
                                    <span class="material-icons">visibility</span>
                                </a>
                                <a href="{{URL::to('/edit-sanpham/'.$pro->product_id)}}" class="btn-action edit" title="Chỉnh sửa">
                                    <span class="material-icons">edit</span>
                                </a>
                                <a href="{{URL::to('/delete-sanpham/'.$pro->product_id)}}" class="btn-action delete" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
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

<!-- chi tiết sản phẩm -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4">
                <div class="row">
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        <div class="p-3 bg-light rounded-3 h-100 d-flex align-items-center justify-content-center">
                            <img id="modalProImage" src="" alt="Product Image" class="img-fluid" style="max-height: 300px; object-fit: contain;">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <small class="text-muted">ID: <span id="modalProID"></span></small>
                                <h3 id="modalProName" class="mb-0 text-primary mt-1"></h3>
                            </div>
                            <div id="modalProStatus"></div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 h-100" style="background-color: #f8f9fa;">
                                    <small class="text-uppercase text-muted fw-bold d-block mb-1">Giá bán</small>
                                    <span id="modalProPrice" class="fs-4 fw-bold text-danger"></span> <span class="text-danger">VNĐ</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-3 h-100" style="background-color: #f8f9fa;">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <small class="text-uppercase text-muted fw-bold d-block mb-1">Danh mục</small>
                                            <span id="modalProCate" class="fw-bold"></span>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-uppercase text-muted fw-bold d-block mb-1">Thương hiệu</small>
                                            <span id="modalProBrand" class="fw-bold"></span>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <small class="text-muted d-block">Trọng lượng</small>
                                            <span id="modalProWeight" class="fw-bold fs-6"></span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Xuất xứ</small>
                                            <span id="modalProOrigin" class="fw-bold fs-6"></span>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block">Hạn dùng</small>
                                            <span id="modalProExpiry" class="fw-bold fs-6"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- thuộc tính riêng -->
                        <div id="modalDynamicAttributesContainer" class="mb-4" style="display: none;">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">Thông số kỹ thuật riêng</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <tbody id="modalDynamicAttributesBody">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <ul class="nav nav-tabs mb-3" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc-content" type="button" role="tab" aria-selected="true">Mô tả sản phẩm</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="ingredient-tab" data-bs-toggle="tab" data-bs-target="#ingredient-content" type="button" role="tab" aria-selected="false">Thành phần</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="usage-tab" data-bs-toggle="tab" data-bs-target="#usage-content" type="button" role="tab" aria-selected="false">Hướng dẫn sử dụng</button>
                            </li>
                        </ul>
                        <div class="tab-content border rounded-3 p-3" style="height: 250px; overflow-y: auto; background: #fff;">
                            <div class="tab-pane fade show active" id="desc-content" role="tabpanel">
                                <p id="modalProDesc" class="text-secondary" style="white-space: pre-line;"></p>
                            </div>
                            <div class="tab-pane fade" id="ingredient-content" role="tabpanel">
                                <p id="modalProIngredient" class="text-secondary" style="white-space: pre-line;"></p>
                            </div>
                            <div class="tab-pane fade" id="usage-content" role="tabpanel">
                                <p id="modalProUsage" class="text-secondary" style="white-space: pre-line;"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.btn-view-details');
        
        viewButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var name = this.getAttribute('data-name');
                var image = this.getAttribute('data-image');
                var id = this.getAttribute('data-id');
                var price = this.getAttribute('data-price');
                var cate = this.getAttribute('data-cate');
                var brand = this.getAttribute('data-brand');
                var desc = this.getAttribute('data-desc');
                var ingredient = this.getAttribute('data-ingredient');
                var weight = this.getAttribute('data-weight');
                var origin = this.getAttribute('data-origin');
                var expiry = this.getAttribute('data-expiry');
                var usage = this.getAttribute('data-usage');
                var status = this.getAttribute('data-status');

                document.getElementById('modalProName').innerText = name;
                document.getElementById('modalProImage').src = image;
                document.getElementById('modalProID').innerText = id;
                document.getElementById('modalProPrice').innerText = price;
                document.getElementById('modalProCate').innerText = cate;
                document.getElementById('modalProBrand').innerText = brand;
                
                document.getElementById('modalProDesc').innerText = desc ? desc : 'Đang cập nhật...';
                document.getElementById('modalProIngredient').innerText = ingredient ? ingredient : 'Đang cập nhật...';
                document.getElementById('modalProUsage').innerText = usage ? usage : 'Đang cập nhật...';

                document.getElementById('modalProWeight').innerText = weight ? weight : '-';
                document.getElementById('modalProOrigin').innerText = origin ? origin : '-';
                document.getElementById('modalProExpiry').innerText = expiry ? expiry : '-';
                
                var statusHtml = '';
                if(status == 0) {
                    statusHtml = '<span class="badge bg-success rounded-pill px-3 py-2">Đang hiển thị</span>';
                } else {
                    statusHtml = '<span class="badge bg-danger rounded-pill px-3 py-2">Đang ẩn</span>';
                }
                document.getElementById('modalProStatus').innerHTML = statusHtml;

               //thông số kỹ thuật của sản phẩm
                const attrContainer = document.getElementById('modalDynamicAttributesContainer');
                const attrBody = document.getElementById('modalDynamicAttributesBody');
                attrContainer.style.display = 'none';
                attrBody.innerHTML = '';
                
                // Fetch attributes
                fetch('{{ url("/api/product-attributes") }}/' + id)
                    .then(response => response.json())
                    .then(attributes => {
                        if (attributes && attributes.length > 0) {
                            attrContainer.style.display = 'block';
                            let html = '';
                            attributes.forEach(attr => {
                                html += `
                                    <tr>
                                        <td class="bg-light fw-bold" style="width: 40%;">${attr.attribute_name}</td>
                                        <td>${attr.value}</td>
                                    </tr>
                                `;
                            });
                            attrBody.innerHTML = html;
                        }
                    })
                    .catch(err => console.error('Error fetching attributes:', err));

                var viewModal = new bootstrap.Modal(document.getElementById('viewProductModal'));
                viewModal.show();
            });
        });
    });
</script>
@endsection
