<form id="addAttributeForm" action="{{ isset($attribute) ? route('admin.category_attributes.update', $attribute->id) : route('admin.category_attributes.store') }}" method="POST">
    @csrf
   
    <input type="hidden" name="is_ajax" id="isAjaxInput" value="0">
    
    <div class="modal-header">
        <h5 class="modal-title">{{ isset($attribute) ? 'Sửa thuộc tính' : 'Thêm thuộc tính mới' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
          
            <select name="category_id" id="modalCategoryId" class="form-select" required>
                <option value="">Chọn danh mục</option>
                @foreach($categories as $cate)
                    <option value="{{ $cate->id }}" {{ (isset($attribute) && $attribute->category_id == $cate->id) ? 'selected' : '' }}>
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
                <option value="text" {{ (isset($attribute) && $attribute->attribute_type == 'text') ? 'selected' : '' }}>Text (Nhập tự do)</option>
                <option value="select" {{ (isset($attribute) && $attribute->attribute_type == 'select') ? 'selected' : '' }}>Select (Chọn từ danh sách)</option>
                <option value="number" {{ (isset($attribute) && $attribute->attribute_type == 'number') ? 'selected' : '' }}>Number (Số)</option>
            </select>
        </div>
        
        <div class="mb-3" id="optionsContainer" style="display: {{ (isset($attribute) && $attribute->attribute_type == 'select') ? 'block' : 'none' }};">
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
                           {{ (isset($attribute) && $attribute->is_required) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isRequired">
                        Bắt buộc nhập
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-primary" id="btnSubmitAttribute">
            {{ isset($attribute) ? 'Cập nhật' : 'Thêm mới' }}
        </button>
    </div>
</form>
