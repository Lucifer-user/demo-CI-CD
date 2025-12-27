@extends('admin_layout')
@section('admin_content')
<div class="section-content" id="section-add-category">
    <div class="page-header text-center">
        <h1 class="page-title">Thêm thương hiệu sản phẩm</h1>
        <p class="page-subtitle">Tạo mới thương hiệu cho cửa hàng</p>
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
                <form role="form" action="{{ route('save_brand') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="brandName" class="form-label">Tên thương hiệu</label>
                        <input type="text" name="brand_name" class="form-control" id="brandName" placeholder="Nhập tên thương hiệu" required>
                    </div>
                    <div class="form-group">
                        <label for="brandImage" class="form-label">Hình ảnh</label>
                        <input type="file" name="brand_image" class="form-control" id="brandImage" required>
                    </div>
                    <div class="form-group">
                        <label for="brandDescription" class="form-label">Mô tả thương hiệu</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="brand_desc" id="brand_desc" placeholder="Nhập mô tả thương hiệu"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="brandStatus" class="form-label">Hiển thị</label>
                        <select name="brand_satus" class="form-select" id="brand_satus">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiển thị</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="{{ route('admin.all_brand') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.875rem 1.75rem; border-radius: 0.75rem; font-weight: 600; background: #f1f5f9; color: #64748b; border: none; text-decoration: none;">
                            <span class="material-icons">arrow_back</span> Quay lại
                        </a>
                        <button type="submit" name="add_brand" class="btn btn-primary">
                            <span class="material-icons">add_circle</span> Thêm thương hiệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection