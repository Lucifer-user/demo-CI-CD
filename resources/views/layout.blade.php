<!DOCTYPE html>

<html class="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>SALA BEAUTY - Chăm Sóc Da &amp; Trang Điểm Cao Cấp</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  
  <link rel="stylesheet" href="{{ asset('fontend/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontend/css/menu-brands.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontend/css/products.css') }}" />
  <link rel="stylesheet" href="{{ asset('fontend/css/animations.css') }}" />
  <script src="{{ asset('fontend/js/main.js') }}" defer></script>
  <script src="{{ asset('fontend/js/products.js') }}" defer></script>
</head>

<body class="font-display">
  <div class="main-wrapper">
      <!-- TopNavBar -->
      <header>
        <div class="header-inner">
        <div class="header-left">
          <a href="{{ URL::to('/') }}" class="logo">
            <!-- <div class="logo-icon">
              <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                  d="M24 18.4228L42 11.475V34.3663C42 34.7796 41.7457 35.1504 41.3601 35.2992L24 42V18.4228Z"
                  fill="currentColor" fill-rule="evenodd"></path>
                <path clip-rule="evenodd"
                  d="M24 8.18819L33.4123 11.574L24 15.2071L14.5877 11.574L24 8.18819ZM9 15.8487L21 20.4805V37.6263L9 32.9945V15.8487ZM27 37.6263V20.4805L39 15.8487V32.9945L27 37.6263ZM25.354 2.29885C24.4788 1.98402 23.5212 1.98402 22.646 2.29885L4.98454 8.65208C3.7939 9.08038 3 10.2097 3 11.475V34.3663C3 36.0196 4.01719 37.5026 5.55962 38.098L22.9197 44.7987C23.6149 45.0671 24.3851 45.0671 25.0803 44.7987L42.4404 38.098C43.9828 37.5026 45 36.0196 45 34.3663V11.475C45 10.2097 44.2061 9.08038 43.0155 8.65208L25.354 2.29885Z"
                  fill="currentColor" fill-rule="evenodd"></path>
              </svg>
            </div> -->
            <h2 class="logo-text">SALA BEAUTY</h2>
          </a>
          <nav>
            <div class="nav-item-wrapper">
              <a href="#" class="nav-link">Danh mục</a>
              <div class="mega-menu">
                <div class="mega-menu-content">
                  <div class="mega-menu-column">
                    <a href="#" class="mega-category-main">
                      <span>Chăm Sóc Da Mặt</span>
                      <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                  
                    <a href="#" class="mega-category-main">
                      <span>Chăm Sóc Tóc Và Da Đầu</span>
                      <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                    <a href="#" class="mega-category-main">
                      <span>Chăm Sóc Cơ Thể</span>
                      <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                    <a href="#" class="mega-category-main">
                      <span>Chăm Sóc Cá Nhân</span>
                      <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                    <a href="#" class="mega-category-main">
                      <span>Nước Hoa</span>
                      <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                    <a href="#" class="mega-category-main">
                      <span>Thực Phẩm Chức Năng</span>
                      <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                  </div>
                  <div class="mega-menu-column">
                    <div class="mega-section">
                      <h4 class="mega-section-title">Làm Sạch Da</h4>
                      <a href="#" class="mega-link">Tẩy Trang Mặt</a>
                      <a href="#" class="mega-link">Sữa Rửa Mặt</a>
                      <a href="#" class="mega-link">Tẩy Tế Bào Chết Da Mặt</a>
                      <a href="#" class="mega-link">Toner / Nước Cân Bằng Da</a>
                    </div>
                    <div class="mega-section">
                      <h4 class="mega-section-title">Đặc Trị</h4>
                      <a href="#" class="mega-link">Serum / Tinh Chất</a>
                      <a href="#" class="mega-link">Hỗ Trợ Trị Mụn</a>
                    </div>
                    <div class="mega-section">
                      <h4 class="mega-section-title">Dưỡng Ẩm</h4>
                      <a href="#" class="mega-link">Xịt Khoáng</a>
                      <a href="#" class="mega-link">Lotion / Sữa Dưỡng</a>
                      <a href="#" class="mega-link">Kem / Gel / Dầu Dưỡng</a>
                    </div>
                  </div>
                  <div class="mega-menu-column">
                    <div class="mega-section">
                      <h4 class="mega-section-title">Chống Nắng Da Mặt</h4>
                      <a href="#" class="mega-link">Dưỡng Mặt</a>
                      <a href="#" class="mega-link">Dưỡng Môi</a>
                      <a href="#" class="mega-link">Mặt Nạ</a>
                      <a href="#" class="mega-link">Vấn Đề Về Da</a>
                      <a href="#" class="mega-link">Da Dầu / Lỗ Chân Lông To</a>
                      <a href="#" class="mega-link">Da Khô / Mất Nước</a>
                      <a href="#" class="mega-link">Da Lão Hóa</a>
                      <a href="#" class="mega-link">Da Mụn</a>
                      <a href="#" class="mega-link">Thâm / Nám / Tàn Nhang</a>
                    </div>
                  </div>
                  <div class="mega-menu-column">
                    <div class="mega-section">
                      <h4 class="mega-section-title">Dụng Cụ / Phụ Kiện Chăm Sóc Da</h4>
                      <a href="#" class="mega-link">Bông Tẩy Trang</a>
                      <a href="#" class="mega-link">Dụng Cụ / Máy Rửa Mặt</a>
                      <a href="#" class="mega-link">Máy Xông Mặt / Đáy Tinh Chất</a>
                    </div>
                    <div class="mega-section">
                      <h4 class="mega-section-title">Bộ Chăm Sóc Da Mặt</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a href="#">Sản phẩm mới</a>
            <a href="#">Bán chạy nhất</a>
            <a href="">Ưu đãi</a>
            <a href="{{ URL::to('/lab') }}">Lab </a>
            <a href="#" class="text-primary dark:text-primary text-sm font-medium leading-normal">Khuyến mãi</a>

          </nav>
        </div>


        <div class="header-right">
          <form action="{{ URL::to('/tim-kiem') }}" method="POST" autocomplete="off">
            {{ csrf_field() }}
          <div class="search-box">
            <button type="submit" class="search-icon" style="background: none; border: none; cursor: pointer;">
              <span class="material-symbols-outlined">search</span>
            </button>
            <input placeholder="Tìm kiếm" type="text" name="keywords_submit" />
          </div>
          </form>
          <div class="button-group">
          <button class="header-btn search-mobile">
              <span class="material-symbols-outlined">search</span>
          </button>

          <?php
              $customer_id = Session::get('customer_id');
              $customer_name = Session::get('customer_name');
          ?>

          @if($customer_id != NULL)
              <div style="display: flex; align-items: center;">
                  <a href="#" title="Xin chào, {{ $customer_name }}">
                      <button class="header-btn profile-btn" style="background-color: #e8f0fe; color: #1967d2;">
                          <span class="material-symbols-outlined">person</span>
                      </button>
                  </a>
                  
                  <a href="{{ URL::to('/logout-checkout') }}" title="Đăng xuất" style="margin-left: 5px;">
                      <button class="header-btn">
                          <span class="material-symbols-outlined">logout</span>
                      </button>
                  </a>
              </div>
          @else
              <a href="{{ URL::to('/login-checkout') }}" title="Đăng nhập / Đăng ký">
                  <button class="header-btn profile-btn">
                      <span class="material-symbols-outlined">person</span>
                  </button>
              </a>
          @endif

          <button class="header-btn wishlist-btn">
              <span class="material-symbols-outlined">favorite</span>
          </button>
          
          <a href="{{ URL::to('/show_cart') }}">
              <button class="header-btn cart-btn">
                  <span class="material-symbols-outlined">shopping_bag</span>
                  <span class="cart-badge">{{ Cart::count() }}</span>
              </button>
          </a>
      </div>
        </div>
        </div>
      </header>
      
        <!-- HeroSection -->
        @yield('content')
  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>Hỗ Trợ Khách Hàng</h3>
        <ul class="footer-links">
          <li><a href="#">Liên Hệ Chúng Tôi</a></li>
          <li><a href="#">Giao Hàng &amp; Trả Hàng</a></li>
          <li><a href="#">Câu Hỏi Thường Gặp</a></li>
          <li><a href="#">Theo Dõi Đơn Hàng</a></li>
        </ul>
      </div>

      <div class="footer-section">
        <h3>Công Ty</h3>
        <ul class="footer-links">
          <li><a href="#">Về Chúng Tôi</a></li>
          <li><a href="#">Tuyển Dụng</a></li>
          <li><a href="#">Báo Chí</a></li>
          <li><a href="#">Đối Tác</a></li>
        </ul>
      </div>

      <div class="footer-section">
        <h3>Pháp Lý</h3>
        <ul class="footer-links">
          <li><a href="#">Điều Khoản Dịch Vụ</a></li>
          <li><a href="#">Chính Sách Bảo Mật</a></li>
          <li><a href="#">Chính Sách Cookie</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Theo Dõi Chúng Tôi</h3>
        <div class="social-links">
          <a href="#">
            <span class="sr-only">Facebook</span>
            <svg aria-hidden="true" fill="currentColor" viewbox="0 0 24 24">
              <path clip-rule="evenodd"
                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                fill-rule="evenodd"></path>
            </svg>
          </a>
          <a href="#">
            <span class="sr-only">Instagram</span>
            <svg aria-hidden="true" fill="currentColor" viewbox="0 0 24 24">
              <path clip-rule="evenodd"
                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 4.525c.636-.247 1.363-.416 2.427-.465C9.795 2.013 10.148 2 12.315 2zm-1.113 4.868a6.111 6.111 0 00-2.025.402A2.89 2.89 0 005.44 9.172a2.89 2.89 0 00-.402 2.025c-.022.529-.033 1.06-.033 1.59s.011 1.061.033 1.59a2.89 2.89 0 00.402 2.025 2.89 2.89 0 001.898 1.898c.529.17.991.248 1.59.268.529.022 1.06.033 1.59.033s1.061-.011 1.59-.033c.599-.02 1.06-.099 1.59-.268a2.89 2.89 0 001.898-1.898 2.89 2.89 0 00.402-2.025c.022-.529.033-1.06.033-1.59s-.011-1.061-.033-1.59a2.89 2.89 0 00-.402-2.025 2.89 2.89 0 00-1.898-1.898c-.529-.17-.991-.248-1.59-.268-.529-.022-1.06-.033-1.59-.033zM12 8.118a3.882 3.882 0 100 7.764 3.882 3.882 0 000-7.764zm-5.25 1.59a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                fill-rule="evenodd"></path>
            </svg>
          </a>
          <a href="#">
            <span class="sr-only">Twitter</span>
            <svg aria-hidden="true" fill="currentColor" viewbox="0 0 24 24">
              <path
                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
              </path>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2024 SALA BEAUTY. Bản Quyền Được Bảo Vệ.</p>
    </div>
  </footer>
  </div>
</body>


</html>-