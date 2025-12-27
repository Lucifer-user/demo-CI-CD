 @extends('admin_layout')
 @section('admin_content')
 
 <!-- Page Content -->
            <div class="main-content">
                <div class="container-fluid">

                    <!-- SECTION: Products -->
                  
                    <!-- END SECTION: Products -->
@yield('admin_content')
                    <!-- SECTION: Categories -->

                    <!-- END SECTION: Categories -->

                   



                    <!-- Delete Category Modal -->
                    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Xác nhận Xóa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p id="deleteMessage">Bạn có chắc chắn muốn xóa danh mục này?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="button" class="btn btn-danger" onclick="confirmDeleteCategory()">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

 @endsection