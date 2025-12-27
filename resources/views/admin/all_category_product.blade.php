@extends('admin_layout')
@section('admin_content')
 <div class="section-content" id="section-categories" style="padding: 50px">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h1 class="page-title">Danh mục sản phẩm</h1>
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
                                    <a href="{{ route('admin.add_category') }}" class="btn btn-primary">
                                        <span class="material-icons">add</span>
                                        Thêm danh mục 
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
                                            <th>Tên danh mục</th>
                                            <th>Mô tả</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_category_product as $key => $cate_pro)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="product-info">
                                                    <span class="material-icons" style="color: #F78B9D;">category</span>
                                                    <div>
                                                        <div class="product-name">{{ $cate_pro->category_name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-width: 300px;">
                                                    {{ $cate_pro->category_desc }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($cate_pro->category_satus == 1)
                                                    <span class="status-badge in-stock">Hiển thị</span>
                                                @else
                                                    <span class="status-badge out-of-stock" style="background: #ffebee; color: #c62828;">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>{{ $cate_pro->ngay_tao }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="javascript:void(0)" 
                                                       onclick="showCategoryDetails('{{ $cate_pro->category_name }}', `{{ $cate_pro->category_desc }}`, '{{ $cate_pro->category_satus }}')" 
                                                       class="btn-action view" style="color: #6c5ce7;">
                                                        <span class="material-icons">visibility</span>
                                                    </a>
                                                    <a href="{{ URL::to('/edit-category-product/'.$cate_pro->id) }}" class="btn-action edit"><span class="material-icons">edit</span></a>
                                                    <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{ URL::to('/delete-category-product/'.$cate_pro->id) }}" class="btn-action delete"><span class="material-icons">delete</span></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3 p-3">
                                {{ $all_category_product->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                    <!-- View Details Modal -->
                    <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title fw-bold">Chi tiết danh mục</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pt-4">
                                    <div class="mb-4">
                                        <small class="text-uppercase text-muted fw-bold">Tên danh mục</small>
                                        <h3 id="modalCategoryName" class="mb-0 text-primary mt-1"></h3>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <small class="text-uppercase text-muted fw-bold">Trạng thái</small>
                                        <div id="modalCategoryStatus" class="mt-1"></div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-uppercase text-muted fw-bold">Mô tả</small>
                                        <p id="modalCategoryDesc" class="mt-1 text-secondary" style="line-height: 1.6; text-align: justify;"></p>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary px-4 rounded-pill" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function showCategoryDetails(name, desc, status) {
                            document.getElementById('modalCategoryName').innerText = name;
                            document.getElementById('modalCategoryDesc').innerText = desc;
                            
                            var statusHtml = '';
                            if(status == 1) {
                                statusHtml = '<span class="badge bg-success rounded-pill px-3 py-2">Đang hiển thị</span>';
                            } else {
                                statusHtml = '<span class="badge bg-danger rounded-pill px-3 py-2">Đang ẩn</span>';
                            }
                            document.getElementById('modalCategoryStatus').innerHTML = statusHtml;

                            var viewModal = new bootstrap.Modal(document.getElementById('viewCategoryModal'));
                            viewModal.show();
                        }
                    </script>
@endsection