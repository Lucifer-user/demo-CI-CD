@extends('admin_layout')
@section('admin_content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary fw-bold">
                            <span class="material-icons align-middle me-2">edit_note</span>Cập nhật sản phẩm
                        </h5>
                        <a href="{{ route('admin.all_sanpham') }}" class="btn btn-outline-secondary btn-sm">
                            <span class="material-icons align-middle">arrow_back</span> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form role="form" action="{{ URL::to('/update-sanpham/'.$edit_sanpham->product_id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <!-- Left Column: Main Info -->
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <label for="product_name" class="form-label fw-semibold">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <input type="text" name="product_name" class="form-control form-control-lg" id="product_name" value="{{$edit_sanpham->product_name}}" placeholder="Nhập tên sản phẩm" required>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label fw-semibold">Danh mục</label>
                                        <select name="category_id" class="form-select" id="category_id">
                                            @foreach($cate_product as $key => $cate)
                                                <option value="{{$cate->id}}" {{$cate->id==$edit_sanpham->id ? 'selected' : ''}}>{{$cate->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="brand_id" class="form-label fw-semibold">Thương hiệu</label>
                                        <select name="brand_id" class="form-select" id="brand_id">
                                            @foreach($brand_product as $key => $brand)
                                                <option value="{{$brand->brand_id}}" {{$brand->brand_id==$edit_sanpham->brand_id ? 'selected' : ''}}>{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label for="product_price" class="form-label fw-semibold">Giá gốc (VNĐ)</label>
                                        <input type="number" value="{{$edit_sanpham->product_price}}" name="product_price" class="form-control" id="product_price">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="product_sale_price" class="form-label fw-semibold">Giá khuyến mãi (VNĐ)</label>
                                        <input type="number" value="{{$edit_sanpham->product_sale_price}}" name="product_sale_price" class="form-control" id="product_sale_price">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="product_stock" class="form-label fw-semibold">Số lượng tồn</label>
                                        <input type="number" value="{{$edit_sanpham->product_stock}}" name="product_stock" class="form-control" id="product_stock">
                                    </div>
                                </div>

                                    <div class="mb-4">
                                        <label for="product_description" class="form-label fw-semibold">Mô tả sản phẩm</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="product_description" id="ckeditor_sanpham" placeholder="Nhập mô tả chi tiết...">{{$edit_sanpham->product_description}}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="product_ingredient" class="form-label fw-semibold">Thành phần</label>
                                        <textarea style="resize: none" rows="4" class="form-control" name="product_ingredient" id="ckeditor_thanhphan" placeholder="Thành phần logic...">{{$edit_sanpham->product_ingredient}}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="product_ingredient" class="form-label fw-semibold">Hướng dẫn sử dụng</label>
                                        <textarea style="resize: none" rows="4" class="form-control" name="product_usage" id="ckeditor_huongdan" placeholder="Hướng dẫn sử dụng logic...">{{$edit_sanpham->product_usage}}</textarea>
                                    </div>

                                    <!-- Thông số kỹ thuật (Cố định) -->
                                    <div class="card bg-light border-0 mb-4">
                                        <div class="card-body">
                                            <h6 class="card-title fw-bold mb-3 text-primary">Thông số kỹ thuật chung</h6>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="product_weight" class="form-label fw-semibold">Dung tích/Trọng lượng</label>
                                                    <input type="text" value="{{$edit_sanpham->product_weight}}" name="product_weight" class="form-control" id="product_weight" placeholder="50ml, 100g...">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="product_origin" class="form-label fw-semibold">Xuất xứ</label>
                                                    <input type="text" value="{{$edit_sanpham->product_origin}}" name="product_origin" class="form-control" id="product_origin" placeholder="Việt Nam...">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="product_expiry" class="form-label fw-semibold">Hạn sử dụng</label>
                                                    <input type="text" value="{{$edit_sanpham->product_expiry}}" name="product_expiry" class="form-control" id="product_expiry" placeholder="36 tháng...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Thuộc tính động theo danh mục -->
                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-between align-items-center" style="border-top: 1px dashed #ddd; padding-top: 15px;">
                                        <div class="form-section-title">
                                            <span class="material-icons" style="vertical-align: middle; color: #F78B9D;">tune</span>
                                            Thuộc tính riêng của danh mục
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-primary me-2" id="btnOpenAddAttributeModal">
                                                <span class="material-icons" style="font-size: 16px; vertical-align: middle;">add</span> Thêm thuộc tính
                                            </button>
                                            <a href="{{ route('admin.category_attributes') }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Quản lý tất cả thuộc tính">
                                                <span class="material-icons" style="font-size: 16px; vertical-align: middle;">settings</span> Quản lý
                                            </a>
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-3">
                                        <em>Các thông số kỹ thuật riêng cho danh mục này.</em>
                                    </p>
                                    <div id="specifications-container" class="row g-3">
                                        <!-- Dynamic inputs sẽ được render ở đây bằng JavaScript -->
                                    </div>
                                </div>
                            </div>
 
                            <!-- Right Column: Image & Status -->
                            <div class="col-lg-4">
                                <div class="card bg-light border-0 mb-4">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold mb-3">Hình ảnh sản phẩm</h6>
                                        <div class="text-center mb-3">
                                            <img src="{{URL::to('uploads/product/'.$edit_sanpham->product_image)}}" class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: cover;" alt="Product Image">
                                        </div>
                                        <div class="mb-3">
                                            <label for="product_image" class="form-label small text-muted">Thay đổi hình ảnh</label>
                                            <input type="file" name="product_image" class="form-control" id="product_image">
                                        </div>
                                    </div>
                                </div>
 
                                <div class="card bg-light border-0 mb-4">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold mb-3">Trạng thái hiển thị</h6>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="radio" name="product_status" id="status_show" value="0" {{$edit_sanpham->product_status == 0 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="status_show">Hiển thị</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" name="product_status" id="status_hide" value="1" {{$edit_sanpham->product_status == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="status_hide">Ẩn</label>
                                        </div>
                                    </div>
                                </div>
 
                                <div class="d-grid gap-2">
                                    <button type="submit" name="update_product" class="btn btn-primary btn-lg">
                                        <span class="material-icons align-middle me-1">save</span> Cập nhật
                                    </button>
                                    <a href="{{ route('admin.all_sanpham') }}" class="btn btn-outline-secondary">Hủy bỏ</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm Thuộc Tính (Reusable Partial) -->
<div class="modal fade" id="addAttributeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @include('admin.category_attributes.form', ['categories' => $cate_product])
        </div>
    </div>
</div>

<script>
    // Existing values from controller
    const existingAttributes = {!! json_encode($existing_attributes ?? []) !!};
    const existingValuesMap = {};
    if(existingAttributes && existingAttributes.length > 0) {
        existingAttributes.forEach(attr => {
            // Use attribute_id as key
            existingValuesMap[attr.attribute_id] = attr.value;
        });
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        // Load attributes for the initially selected category
        const initialCategoryId = document.getElementById('category_id').value;
        if (initialCategoryId) {
            loadAttributes(initialCategoryId, true); // true = fill values
        }
        
        // Handle category change
        document.getElementById('category_id').addEventListener('change', function() {
            loadAttributes(this.value, false); // Clear values on category change
        });

        // Setup Modal Open
        document.getElementById('btnOpenAddAttributeModal').addEventListener('click', function() {
            var categoryId = document.getElementById('category_id').value;
            var modalCategoryInput = document.getElementById('modalCategoryId');
            if(modalCategoryInput) {
                modalCategoryInput.value = categoryId;
            }
            var myModal = new bootstrap.Modal(document.getElementById('addAttributeModal'));
            myModal.show();
        });
    });

    // Toggle options for attribute form (used by partial)
    function toggleOptions() {
        var type = document.getElementById('attributeType').value;
        var container = document.getElementById('optionsContainer');
        if (container) {
            container.style.display = type === 'select' ? 'block' : 'none';
        }
    }

    function loadAttributes(categoryId, fillValues) {
        const container = document.getElementById('specifications-container');
        container.innerHTML = '<div class="col-12 text-center"><span class="spinner-border spinner-border-sm" role="status"></span> Đang tải thuộc tính...</div>';
        
        var apiUrl = '{{ url("/api/category-attributes") }}/' + categoryId;
        
        fetch(apiUrl)
            .then(response => response.json())
            .then(attributes => {
                renderSpecificationInputs(attributes, fillValues);
            })
            .catch(error => {
                console.error('Error loading attributes:', error);
                container.innerHTML = '<p class="text-danger col-12">Không thể tải thuộc tính.</p>';
            });
    }

    function renderSpecificationInputs(attributes, fillValues) {
        const container = document.getElementById('specifications-container');
        container.innerHTML = '';
        const editAttributeBaseUrl = "{{ url('/edit-category-attribute') }}";
        
        if (attributes.length === 0) {
            container.innerHTML = '<p class="text-muted col-12"><em>Danh mục này chưa có thuộc tính riêng.</em></p>';
            return;
        }
        
        attributes.forEach(function(attr) {
            const div = document.createElement('div');
            div.className = 'col-md-6'; // 2 columns for better edit layout
            
            let inputHtml = '';
            const requiredMark = attr.required ? '<span class="text-danger">*</span>' : '';
            const requiredAttr = attr.required ? 'required' : '';
            const editUrl = editAttributeBaseUrl + '/' + attr.id;
            
            // Get value using ID
            let value = '';
            if (fillValues && existingValuesMap[attr.id] !== undefined) {
                value = existingValuesMap[attr.id];
            }

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
                    let opts = [];
                    if (Array.isArray(attr.options)) {
                        opts = attr.options;
                    } else if (typeof attr.options === 'object' && attr.options !== null) {
                        opts = Object.values(attr.options);
                    }

                    if (opts.length > 0) {
                        opts.forEach(function(opt) {
                            const selected = opt == value ? 'selected' : '';
                            optionsHtml += '<option value="' + opt + '" '+selected+'>' + opt + '</option>';
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
                               value="${value}" placeholder="..." ${requiredAttr}>
                    `;
                    break;
                    
                case 'text':
                default:
                    inputHtml = `
                        ${labelHtml}
                        <input type="text" class="form-control" name="specifications[${attr.id}]" 
                               value="${value}" placeholder="..." ${requiredAttr}>
                    `;
                    break;
            }
            
            div.innerHTML = inputHtml;
            container.appendChild(div);
        });
    }

    // Handle Modal Form Submission via AJAX (Copied from add_sanpham to ensure same behavior)
    document.getElementById('addAttributeForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const btn = document.getElementById('btnSubmitAttribute');
        const isAjaxInput = document.getElementById('isAjaxInput');
        if(isAjaxInput) isAjaxInput.value = 1;

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const formData = new FormData(form);
        if(btn) {
            btn.disabled = true;
            btn.innerHTML = 'Đang lưu...';
        }

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                var modalEl = document.getElementById('addAttributeModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
                form.reset();
                if(document.getElementById('optionsContainer')) document.getElementById('optionsContainer').style.display = 'none';
                
                // Reload attributes with true to KEEP existing values if possible? 
                // However, render clears container. Ideally we should re-fetch attributes and re-map.
                // But simplified: reload and we might lose *unsaved* inputs. 
                // But for edit page, usually we save frequently.
                const categoryId = document.getElementById('category_id').value;
                loadAttributes(categoryId, true); // Try to keep filling values from server (stale) or we can implement smart merge.
                // NOTE: fetch(apiUrl) gets NEW list of attributes.
                // renderSpecificationInputs uses 'existingValuesMap'.
                // 'existingValuesMap' is from server load. 
                // IF user added new attribute, it won't be in existingValuesMap yet.
                // The new attribute will appear empty. That is fine.
                
                alert('Thêm thuộc tính thành công!');
            } else {
                alert('Có lỗi: ' + (data.message || 'Error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Lỗi hệ thống.');
        })
        .finally(() => {
            if(btn) { btn.disabled = false; btn.innerHTML = 'Thêm mới'; }
            if(isAjaxInput) isAjaxInput.value = 0;
        });
    });
</script>
@endsection
