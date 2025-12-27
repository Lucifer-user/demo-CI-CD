@extends('admin_layout')
@section('admin_content')
<div class="section-content active">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thêm Sản phẩm Mới</h5>
                    <p class="text-muted mb-0 mt-1">Nhập thông tin sản phẩm</p>
                </div>
                <div class="card-body">
                    <form id="productForm" action="{{ route('save_sanpham') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="productId">

                        <div class="row g-3">
                            <!-- Hình ảnh -->
                            <div class="col-md-4">
                                <div class="image-upload-container">
                                    <div class="image-preview" id="imagePreview">
                                        <span class="material-icons">image</span>
                                        <p>Chọn hình ảnh</p>
                                    </div>
                                    <input type="file" id="productImage" accept="image/*" class="d-none" name="product_image" onchange="previewImage(this)">
                                    <button type="button" class="btn btn-outline-primary w-100 mt-2"
                                        onclick="document.getElementById('productImage').click()">
                                        <span class="material-icons">cloud_upload</span> Tải ảnh đại diện
                                    </button>
                                </div>
                                <div class="image-upload-container mt-3">
                                    <label class="form-label">Ảnh chi tiết (Gallery)</label>
                                    <input type="file" id="productGallery" accept="image/*" class="form-control" name="product_gallery[]" multiple>
                                </div>
                            </div>

                            <!-- Thông tin cơ bản -->
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="productName" required name="product_name">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Thương hiệu <span class="text-danger">*</span></label>
                                        <select class="form-select" name="brand_id" id="productBrand" required>
                                            <option value="">Chọn thương hiệu</option>
                                            @foreach($brand_product as $key => $brand)
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                                        <select class="form-select" name="category_id" id="productCategory" required>
                                            <option value="">Chọn danh mục</option>
                                            @foreach($cate_product as $key => $cate)
                                                <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Giá và Tồn kho -->
                            <div class="col-md-6">
                                <label class="form-label">Giá gốc <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="productPrice" required min="0" name="product_price">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Giá khuyến mãi</label>
                                <input type="number" class="form-control" id="productSalePrice" min="0" name="product_sale_price">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Số lượng tồn <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="productStock" required min="0" name="product_stock">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" id="productStatus" name="product_status">
                                    <option value="0">Hiển thị</option>
                                    <option value="1">Ẩn</option>
                                </select>
                            </div>

                            <!-- Mô tả -->
                            <div class="col-12">
                                <label class="form-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" id="ckeditor_sanpham" rows="4" name="product_description"
                                    placeholder="Mô tả chi tiết về sản phẩm..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Thành phần</label>
                                <textarea class="form-control" id="ckeditor_thanhphan" rows="4" name="product_ingredient"
                                    placeholder="Thành phần..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Hướng dẫn sử dụng</label>
                                <textarea class="form-control" id="ckeditor_huongdan" rows="4" name="product_usage"
                                    placeholder="Hướng dẫn sử dụng..."></textarea>
                            </div>

                            <!-- Thông số kỹ thuật -->
                            <div class="col-12">
                                <div class="form-section-title">Thông số kỹ thuật</div>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Dung tích/Trọng lượng</label>
                                        <input type="text" class="form-control" id="productWeight" name="product_weight"
                                            placeholder="50ml, 100g...">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Xuất xứ</label>
                                        <input type="text" class="form-control" id="productOrigin" name="product_origin"
                                            placeholder="Việt Nam, Hàn Quốc...">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Hạn sử dụng</label>
                                        <input type="text" class="form-control" id="productExpiry" name="product_expiry"
                                            placeholder="36 tháng...">
                                    </div>
                                </div>
                            </div>

                            <!-- Thuộc tính động theo danh mục -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center" style="margin-top: 20px; padding-top: 15px; border-top: 1px dashed #ddd;">
                                    <div class="form-section-title" style="margin: 0; padding: 0; border: none;">
                                        <span class="material-icons" style="vertical-align: middle; color: #F78B9D;">tune</span>
                                        Thuộc tính riêng của danh mục
                                    </div>
                                    <a href="{{ route('admin.category_attributes') }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Quản lý tất cả thuộc tính">
                                        <span class="material-icons" style="font-size: 16px; vertical-align: middle;">settings</span> Quản lý
                                    </a>
                                </div>
                                <p class="text-muted small mb-3">
                                    <em>Chọn danh mục ở trên để hiển thị các thuộc tính tương ứng (Màu sắc, Mùi hương, v.v...)</em>
                                </p>
                                <div id="specifications-container" class="row g-3">
                                    <!-- Dynamic inputs sẽ được render ở đây bằng JavaScript -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions mt-4 text-end">
                            <a href="{{ route('admin.all_sanpham') }}" class="btn btn-secondary">Hủy</a>
                            <button type="submit" class="btn btn-primary" id="btnSaveProduct">
                                <span class="material-icons">save</span> Lưu Sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" style="max-width: 100%; max-height: 200px; border-radius: 4px;">';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Load dynamic specifications khi thay đổi danh mục
    document.getElementById('productCategory').addEventListener('change', function() {
        const categoryId = this.value;
        const container = document.getElementById('specifications-container');
        
        if (!categoryId) {
            container.innerHTML = '<p class="text-muted col-12"><em>Vui lòng chọn danh mục để xem thuộc tính</em></p>';
            return;
        }
        
        // Show loading
        container.innerHTML = '<div class="col-12 text-center"><span class="spinner-border spinner-border-sm" role="status"></span> Đang tải thuộc tính...</div>';
        
        // Fetch attributes từ API
        var apiUrl = '{{ url("/api/category-attributes") }}/' + categoryId;
        console.log('Fetching attributes from:', apiUrl); // Debug log
        
        fetch(apiUrl)
            .then(response => response.json())
            .then(attributes => {
                renderSpecificationInputs(attributes);
            })
            .catch(error => {
                console.error('Error loading attributes:', error);
                container.innerHTML = '<p class="text-danger col-12">Không thể tải thuộc tính. Vui lòng thử lại.</p>';
            });
    });

    function renderSpecificationInputs(attributes) {
        const container = document.getElementById('specifications-container');
        container.innerHTML = '';
        const editAttributeBaseUrl = "{{ url('/edit-category-attribute') }}";
        
        if (attributes.length === 0) {
            container.innerHTML = '<p class="text-muted col-12"><em>Danh mục này chưa có thuộc tính riêng. Bạn có thể thêm thuộc tính tại <a href="/admin/category-attributes" target="_blank">đây</a>.</em></p>';
            return;
        }
        
        attributes.forEach(function(attr) {
            const div = document.createElement('div');
            div.className = 'col-md-4';
            
            let inputHtml = '';
            const requiredMark = attr.required ? '<span class="text-danger">*</span>' : '';
            const requiredAttr = attr.required ? 'required' : '';
            const editUrl = editAttributeBaseUrl + '/' + attr.id;
            
            const labelHtml = `
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label mb-0">${attr.name} ${requiredMark}</label>
                    <a href="${editUrl}" target="_blank" class="text-muted text-decoration-none" title="Sửa thuộc tính này">
                        <span class="material-icons" style="font-size: 14px; vertical-align: middle;">edit</span>
                    </a>
                </div>
            `;
            
            switch (attr.type) {
                case 'select':
                    let optionsHtml = '<option value="">-- Chọn --</option>';
                    // Handle case where options might be an object (from json_encode of associated array)
                    // or regular array.
                    let opts = [];
                    if (Array.isArray(attr.options)) {
                        opts = attr.options;
                    } else if (typeof attr.options === 'object' && attr.options !== null) {
                        opts = Object.values(attr.options);
                    }

                    if (opts.length > 0) {
                        opts.forEach(function(opt) {
                            optionsHtml += '<option value="' + opt + '">' + opt + '</option>';
                        });
                    }
                    inputHtml = `
                        ${labelHtml}
                        <select class="form-select" name="specifications[${attr.id}]" ${requiredAttr}>
                            ${optionsHtml}
                        </select>
                    `;
                    break;
                    
                case 'number':
                    inputHtml = `
                        ${labelHtml}
                        <input type="number" class="form-control" name="specifications[${attr.id}]" 
                               placeholder="Nhập ${attr.name.toLowerCase()}..." ${requiredAttr}>
                    `;
                    break;
                    
                case 'text':
                default:
                    inputHtml = `
                        ${labelHtml}
                        <input type="text" class="form-control" name="specifications[${attr.id}]" 
                               placeholder="Nhập ${attr.name.toLowerCase()}..." ${requiredAttr}>
                    `;
                    break;
            }
            
            div.innerHTML = inputHtml;
            container.appendChild(div);
        });
    }
    </script>
@endsection
