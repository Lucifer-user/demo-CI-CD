@extends('admin_layout')
@section('admin_content')
<div class="section-content" id="section-edit-brand">
    <div class="page-header text-center">
        <h1 class="page-title">Cập nhật thương hiệu sản phẩm</h1>
        <p class="page-subtitle">Chỉnh sửa thông tin thương hiệu</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-card">
                <form role="form" action="{{ URL::to('/update-brand/'.$edit_brand->brand_id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="brandName" class="form-label">Tên thương hiệu</label>
                        <input type="text" value="{{ $edit_brand->brand_name }}" name="brand_name" class="form-control" id="brandName" placeholder="Tên thương hiệu" required>
                    </div>
                    <div class="form-group">
                        <label for="brandDesc" class="form-label">Mô tả thương hiệu</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="brand_desc" id="brandDesc" placeholder="Mô tả thương hiệu">{{ $edit_brand->brand_desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="brandStatus" class="form-label">Hiển thị</label>
                        <select name="brand_satus" class="form-select" id="brandStatus">
                            <option value="0" {{ $edit_brand->brand_satus == 0 ? 'selected' : '' }}>Ẩn</option>
                            <option value="1" {{ $edit_brand->brand_satus == 1 ? 'selected' : '' }}>Hiển thị</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="{{ route('admin.all_brand') }}" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.875rem 1.75rem; border-radius: 0.75rem; font-weight: 600; background: #f1f5f9; color: #64748b; border: none; text-decoration: none;">
                            <span class="material-icons">arrow_back</span> Quay lại
                        </a>
                        <button type="submit" name="update_brand" class="btn btn-primary">
                            <span class="material-icons">save</span> Cập nhật thương hiệu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
