<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SALA Admin - Quản trị hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontend/css/admin.css') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" style="text-decoration: none; color: inherit;">
                    <div class="brand-logo">
                        <div class="logo-icon">
                            <span class="material-icons">inventory_2</span>
                        </div>
                        <div class="logo-text">
                            <h1>SALA Admin</h1>
                            <p>Beauty Management</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="user-profile">
                <div class="avatar">{{ strtoupper(substr(session('admin_email', 'AD'), 0, 2)) }}</div>
                <p class="welcome-text">Welcome,</p>
                <p class="user-name">{{ session('admin_email', 'Admin') }}</p>
            </div>

            <ul class="sidebar-nav">
                <li class="nav-item has-submenu"> <a href="{{ route('admin.all_sanpham') }}" class="nav-link" data-section="products">
        <span class="material-icons">inventory_2</span>
        <span>Sản phẩm</span>
        
        <span class="material-icons dropdown-arrow">chevron_right</span>
        
        </a>
    
    <ul class="sub-menu">
        <li>
            <a href="{{ route('admin.all_brand') }} ">
                <span class="material-icons" style="font-size: 16px; vertical-align: middle; margin-right: 5px;">stars</span>
                Thương hiệu
            </a>
        </li>
        
    </ul>
</li>
                <li class="nav-item">
                    <a href="{{ route('admin.all_category_product') }}" class="nav-link">
                        <span class="material-icons">list_alt</span>
                        <span>Danh mục</span>
                        <span class="badge">12</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.manage_order') }}" class="nav-link" data-section="orders">
                        <span class="material-icons">shopping_cart</span>
                        <span>Đơn hàng</span>
                        <span class="badge">23</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}#customers" class="nav-link" data-section="customers">
                        <span class="material-icons">group</span>
                        <span>Khách hàng</span>
                        <span class="badge">1.2k</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}#promotions" class="nav-link" data-section="promotions">
                        <span class="material-icons">favorite</span>
                        <span>Khuyến mãi</span>
                        <span class="badge">5</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}#shipping" class="nav-link" data-section="shipping">
                        <span class="material-icons">local_shipping</span>
                        <span>Vận chuyển</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}#reviews" class="nav-link" data-section="reviews">
                        <span class="material-icons">chat_bubble</span>
                        <span>Đánh giá</span>
                        <span class="badge">45</span>
                    </a>
                </li>
            </ul>

            
        </nav>

        <!-- Main Content -->
        <div id="content" class="content">
            <!-- Header -->
            <header class="main-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                          
                        </div>
                        <div class="col-md-6">
                            <div class="header-actions">
                                <button class="notification-btn">
                                    <span class="material-icons">notifications</span>
                                    <span class="notification-badge">5</span>
                                </button>
                                <button class="notification-btn">
                                    <span class="material-icons">email</span>
                                    <span class="notification-badge">3</span>
                                </button>
                                <div class="user-info" style="position: relative;">
                                    <div class="user-avatar">{{ strtoupper(substr(session('admin_email', 'AD'), 0, 2)) }}</div>
                                    <div class="user-details">
                                        <p class="user-name">{{ session('admin_email', 'Admin') }}</p>
                                        <p class="user-role">Quản trị viên</p>
                                    </div>
                                    <span class="material-icons dropdown-icon" style="cursor: pointer;" onclick="toggleDropdown()">expand_more</span>
                                    
                                    <!-- Dropdown Menu -->
                                    <div id="userDropdown" style="position: absolute; top: 100%; right: 0; background: white; border: 1px solid #e0e0e0; border-radius: 0.5rem; min-width: 200px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: none; z-index: 1000; margin-top: 0.5rem;">
                                        <a href="{{ route('admin.logout') }}" style="display: block; padding: 0.75rem 1rem; color: #dc3545; text-decoration: none; border-top: 1px solid #f0f0f0; cursor: pointer;">
                                            <span class="material-icons" style="font-size: 18px; vertical-align: middle; margin-right: 0.5rem;">logout</span>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            @yield('admin_content')

            <!-- Hidden sections for SPA navigation (only active on dashboard) -->
            <!-- These are placeholders if not on dashboard, but admin.js handles their absence -->
            
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('fontend/js/admin.js') }}"></script>
   <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    //add_sanpham
    ClassicEditor
        .create(document.querySelector('#ckeditor_sanpham'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#ckeditor_thanhphan'))
        .catch(error => {
            console.error(error);
        });
    //add_danhmuc
    ClassicEditor
        .create(document.querySelector('#ckeditor_danhmuc'))
        .catch(error => {
            console.error(error);
        });
        //hướng dẫn sử dụng
    ClassicEditor
        .create(document.querySelector('#ckeditor_huongdan'))
        .catch(error => {
            console.error(error);
        });
   
</script>
   

</body>
</html>