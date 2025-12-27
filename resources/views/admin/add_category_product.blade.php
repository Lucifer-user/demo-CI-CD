@extends('admin_layout')
@section('admin_content')
<div class="section-content" id="section-add-category">
    <div class="page-header text-center">
        <h1 class="page-title">Thêm danh mục sản phẩm</h1>
        <p class="page-subtitle">Tạo mới danh mục cho cửa hàng</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<div class="alert alert-success mb-4">'.$message.'</div>';
                    Session::put('message',null);
                }
                ?>
                <form role="form" action="{{ route('save_category') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="categoryName" class="form-label">Tên danh mục</label>
                        <input type="text" name="category_product_name" class="form-control" id="categoryName" placeholder="Nhập tên danh mục" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription" class="form-label">Mô tả danh mục</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="categoryDescription" id="ckeditor_danhmuc" placeholder="Nhập mô tả danh mục"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoryStatus" class="form-label">Hiển thị</label>
                        <select name="category_product_status" class="form-select" id="categoryStatus">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="{{ route('admin.all_category_product') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.875rem 1.75rem; border-radius: 0.75rem; font-weight: 600; background: #f1f5f9; color: #64748b; border: none; text-decoration: none;">
                            <span class="material-icons">arrow_back</span> Quay lại
                        </a>
                        <button type="submit" name="add_category_product" class="btn btn-primary">
                            <span class="material-icons">add_circle</span> Thêm danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection