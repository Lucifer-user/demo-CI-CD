@extends('admin_layout')
@section('admin_content')
<div class="section-content" id="section-category-attributes">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="page-title">Thuộc tính Danh mục</h1>
                <p class="page-subtitle">Quản lý thuộc tính động cho từng loại sản phẩm</p>
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert" style="color:green; font-weight:bold;">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.add_sanpham') }}" class="btn btn-outline-secondary me-2">
                    <span class="material-icons">arrow_back</span>
                    Quay lại Thêm SP
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAttributeModal">
                    <span class="material-icons">add</span>
                    Thêm thuộc tính
                </button>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.category_attributes') }}" method="GET" class="row align-items-center">
                <div class="col-auto">
                    <label class="fw-bold">Lọc theo danh mục:</label>
                </div>
                <div class="col-md-4">
                    <select name="category_id" class="form-select" onchange="this.form.submit()">
                        <option value="all">-- Tất cả danh mục --</option>
                        @foreach($categories as $cate)
                            <option value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : '' }}>
                                {{ $cate->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="products-table">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Danh mục</th>
                        <th>Tên thuộc tính</th>
                        <th>Loại input</th>
                        <th>Bắt buộc</th>
                        <th>Options</th>
                        <th>Thứ tự</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $key => $attr)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <span class="badge bg-primary">{{ $attr->category->category_name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <strong>{{ $attr->attribute_name }}</strong>
                        </td>
                        <td>
                            @if($attr->attribute_type == 'text')
                                <span class="badge bg-info">Text</span>
                            @elseif($attr->attribute_type == 'select')
                                <span class="badge bg-warning">Select</span>
                            @else
                                <span class="badge bg-secondary">Number</span>
                            @endif
                        </td>
                        <td>
                            @if($attr->is_required)
                                <span class="badge bg-danger">Bắt buộc</span>
                            @else
                                <span class="badge bg-light text-dark">Tùy chọn</span>
                            @endif
                        </td>
                        <td>
                            @if($attr->options && count($attr->options) > 0)
                                <small>{{ implode(', ', $attr->options) }}</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $attr->sort_order }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.category_attributes.edit', $attr->id) }}" class="btn-action edit">
                                    <span class="material-icons">edit</span>
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDelete('{{ route('admin.category_attributes.delete', $attr->id) }}')" class="btn-action delete">
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

<!-- Add/Edit Attribute Modal -->
<div class="modal fade" id="addAttributeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ isset($attribute) ? route('admin.category_attributes.update', $attribute->id) : route('admin.category_attributes.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ isset($attribute) ? 'Sửa thuộc tính' : 'Thêm thuộc tính mới' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $cate)
                                <option value="{{ $cate->id }}" {{ isset($attribute) && $attribute->category_id == $cate->id ? 'selected' : '' }}>
                                    {{ $cate->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tên thuộc tính <span class="text-danger">*</span></label>
                        <input type="text" name="attribute_name" class="form-control" 
                               value="{{ $attribute->attribute_name ?? '' }}" 
                               placeholder="VD: Màu sắc, Dung tích, Mùi hương..." required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Loại input <span class="text-danger">*</span></label>
                        <select name="attribute_type" class="form-select" id="attributeType" required onchange="toggleOptions()">
                            <option value="text" {{ isset($attribute) && $attribute->attribute_type == 'text' ? 'selected' : '' }}>Text (Nhập tự do)</option>
                            <option value="select" {{ isset($attribute) && $attribute->attribute_type == 'select' ? 'selected' : '' }}>Select (Chọn từ danh sách)</option>
                            <option value="number" {{ isset($attribute) && $attribute->attribute_type == 'number' ? 'selected' : '' }}>Number (Số)</option>
                        </select>
                    </div>
                    
                    <div class="mb-3" id="optionsContainer" style="display: {{ isset($attribute) && $attribute->attribute_type == 'select' ? 'block' : 'none' }};">
                        <label class="form-label">Options (mỗi dòng 1 option)</label>
                        <textarea name="options" class="form-control" rows="4" placeholder="Đỏ&#10;Cam&#10;Hồng&#10;Nude">{{ isset($attribute) && $attribute->options ? implode("\n", $attribute->options) : '' }}</textarea>
                        <small class="text-muted">Dành cho loại Select. Mỗi lựa chọn trên một dòng.</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thứ tự hiển thị</label>
                            <input type="number" name="sort_order" class="form-control" 
                                   value="{{ $attribute->sort_order ?? 0 }}" min="0">
                        </div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_required" id="isRequired"
                                       {{ isset($attribute) && $attribute->is_required ? 'checked' : '' }}>
                                <label class="form-check-label" for="isRequired">
                                    Bắt buộc nhập
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($attribute) ? 'Cập nhật' : 'Thêm mới' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận Xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa thuộc tính này không?</p>
                <p class="text-muted small">Hành động này không thể hoàn tác.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Xóa</a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleOptions() {
    var type = document.getElementById('attributeType').value;
    var container = document.getElementById('optionsContainer');
    container.style.display = type === 'select' ? 'block' : 'none';
}

function confirmDelete(deleteUrl) {
    var deleteBtn = document.getElementById('confirmDeleteBtn');
    deleteBtn.href = deleteUrl;
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Auto show modal if editing
@if(isset($attribute))
document.addEventListener('DOMContentLoaded', function() {
    var modal = new bootstrap.Modal(document.getElementById('addAttributeModal'));
    modal.show();
    toggleOptions();
});
@endif
</script>
@endsection
