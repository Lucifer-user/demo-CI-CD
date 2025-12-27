@extends('admin_layout')
@section('admin_content')
<div class="section-content" id="section-edit-category">
    <div class="page-header text-center">
        <h1 class="page-title">Cập nhật danh mục sản phẩm</h1>
        <p class="page-subtitle">Chỉnh sửa thông tin danh mục</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">
                <form role="form" action="{{ URL::to('/update-category-product/'.$edit_category_product->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="categoryName" class="form-label">Tên danh mục</label>
                        <input type="text" value="{{ $edit_category_product->category_name }}" name="category_product_name" class="form-control" id="categoryName" placeholder="Tên danh mục" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryDesc" class="form-label">Mô tả danh mục</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="categoryDescription" id="categoryDesc" placeholder="Mô tả danh mục">{{ $edit_category_product->category_desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoryStatus" class="form-label">Hiển thị</label>
                        <select name="category_product_status" class="form-select" id="categoryStatus">
                            <option value="0" {{ $edit_category_product->category_satus == 0 ? 'selected' : '' }}>Ẩn</option>
                            <option value="1" {{ $edit_category_product->category_satus == 1 ? 'selected' : '' }}>Hiển thị</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="{{ route('admin.all_category_product') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.875rem 1.75rem; border-radius: 0.75rem; font-weight: 600; background: #f1f5f9; color: #64748b; border: none; text-decoration: none;">
                            <span class="material-icons">arrow_back</span> Quay lại
                        </a>
                        <button type="submit" name="update_category_product" class="btn btn-primary">
                            <span class="material-icons">save</span> Cập nhật danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
