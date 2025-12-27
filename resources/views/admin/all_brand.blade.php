
                            
@extends('admin_layout')
@section('admin_content')
 <div class="section-content" id="section-categories" style="padding: 50px">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h1 class="page-title">Thương hiệu sản phẩm</h1>
                                    <p class="page-subtitle">Quản lý danh mục mỹ phẩm</p>
                                    <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert" style="color:green; font-weight:bold;">'.$message.'</span>';
                                        Session::put('message',null);
                                    }
                                    ?> 
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="{{ route('admin.add_brand') }}" class="btn btn-primary">
                                        <span class="material-icons">add</span>
                                        Thêm thương hiệu 
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="products-table" style="padding: 0.1px;">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên thương hiệu</th>
                                            <th>Hình ảnh</th>
                                            <th>Mô tả</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_brand as $key => $brand)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="product-info">
                                                    <span class="material-icons" style="color: #F78B9D;">category</span>
                                                    <div>
                                                        <div class="product-name">{{ $brand->brand_name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ asset('uploads/brand/'.$brand->brand_image) }}" alt="{{ $brand->brand_name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <div style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-width: 300px;">
                                                    {{ $brand->brand_desc }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($brand->brand_satus == 1)
                                                    <span class="status-badge in-stock">Hiển thị</span>
                                                @else
                                                    <span class="status-badge out-of-stock" style="background: #ffebee; color: #c62828;">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>{{ $brand->created_at ?? 'N/A' }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="javascript:void(0)" 
                                                       onclick="showBrandDetails('{{ $brand->brand_name }}', '{{ asset('uploads/brand/'.$brand->brand_image) }}', `{{ $brand->brand_desc }}`, '{{ $brand->brand_satus }}')" 
                                                       class="btn-action view" style="color: #6c5ce7;">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <a href="{{ URL::to('/edit-brand/'.$brand->brand_id) }}" class="btn-action edit"><span class="material-icons">edit</span></a>
                                                    <a href="javascript:void(0)" onclick="confirmDeleteBrand('{{ URL::to('/delete-brand/'.$brand->brand_id) }}')" class="btn-action delete"><span class="material-icons">delete</span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3 p-3">
                                {{ $all_brand->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteBrandModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Xác nhận Xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có chắc chắn muốn xóa thương hiệu này không?</p>
                                    <p class="text-muted small">Hành động này không thể hoàn tác.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View Details Modal -->
                    <div class="modal fade" id="viewBrandModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title fw-bold">Chi tiết thương hiệu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pt-4">
                                    <div class="row">
                                        <div class="col-md-5 text-center mb-3 mb-md-0">
                                            <div class="p-3 bg-light rounded-3 h-100 d-flex align-items-center justify-content-center">
                                                <img id="modalBrandImage" src="" alt="Brand Image" class="img-fluid" style="max-height: 250px; object-fit: contain;">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-4">
                                                <small class="text-uppercase text-muted fw-bold">Tên thương hiệu</small>
                                                <h3 id="modalBrandName" class="mb-0 text-primary mt-1"></h3>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <small class="text-uppercase text-muted fw-bold">Trạng thái</small>
                                                <div id="modalBrandStatus" class="mt-1"></div>
                                            </div>

                                            <div class="mb-3">
                                                <small class="text-uppercase text-muted fw-bold">Mô tả</small>
                                                <p id="modalBrandDesc" class="mt-1 text-secondary" style="line-height: 1.6; text-align: justify;"></p>
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
                        function confirmDeleteBrand(deleteUrl) {
                            var deleteBtn = document.getElementById('confirmDeleteBtn');
                            deleteBtn.href = deleteUrl;
                            var deleteModal = new bootstrap.Modal(document.getElementById('deleteBrandModal'));
                            deleteModal.show();
                        }

                        function showBrandDetails(name, image, desc, status) {
                            document.getElementById('modalBrandName').innerText = name;
                            document.getElementById('modalBrandImage').src = image;
                            document.getElementById('modalBrandDesc').innerText = desc;
                            
                            var statusHtml = '';
                            if(status == 1) {
                                statusHtml = '<span class="badge bg-success rounded-pill px-3 py-2">Đang hiển thị</span>';
                            } else {
                                statusHtml = '<span class="badge bg-danger rounded-pill px-3 py-2">Đang ẩn</span>';
                            }
                            document.getElementById('modalBrandStatus').innerHTML = statusHtml;

                            var viewModal = new bootstrap.Modal(document.getElementById('viewBrandModal'));
                            viewModal.show();
                        }
                    </script>
@endsection