<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sản phẩm - SALA Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="{{ asset('fontend/css/products.css') }}?v={{ time() }}" rel="stylesheet" />
    <link href="{{ asset('fontend/css/details.css') }}" rel="stylesheet" />
    <link href="{{ asset('fontend/css/cart.css') }}" rel="stylesheet" />
    <link href="{{ asset('fontend/css/animations.css') }}" rel="stylesheet" />
 
   
    
  

</head>

<body>
    <div class="page-wrapper">
        <header>
            <div class="header-container">
                <div class="header-left">
                    <a href="{{URL::to('/')}}" class="logo">
                        <!-- <span class="material-symbols-outlined">spa</span> -->
                        <h2>SALA BEAUTY</h2>
                    </a>
                    <nav class="main-nav">
                        <div class="nav-item">
                            <a class="nav-link" href="#">
                                <span>Chăm sóc da</span>
                                <span class="material-symbols-outlined">expand_more</span>
                            </a>
                            <div class="dropdown">
                                <div class="dropdown-content">
                                    <a class="dropdown-item" href="#">Sữa rửa mặt</a>
                                    <a class="dropdown-item" href="#">Kem dưỡng ẩm</a>
                                    <a class="dropdown-item" href="#">Serum & Tinh chất</a>
                                    <a class="dropdown-item" href="#">Mặt nạ</a>
                                </div>
                            </div>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link active" href="products.html">
                                <span>Trang điểm</span>
                                <span class="material-symbols-outlined">expand_more</span>
                            </a>
                            <div class="dropdown">
                                <div class="dropdown-content">
                                    <a class="dropdown-item" href="#">Kem Nền</a>
                                    <a class="dropdown-item" href="#">Kem Che Khuyết Điểm</a>
                                    <a class="dropdown-item" href="#">Son Môi</a>
                                    <a class="dropdown-item" href="#">Mascara</a>
                                </div>
                            </div>
                        </div>
                        <a class="nav-link" href="#">Nước hoa</a>
                        <a class="nav-link" href="#">Cửa Hàng</a>
                        <a class="nav-link" href="comments.html">Đánh giá</a>
                    </nav>
                </div>
                <div class="header-right">
                    <label class="search-box">
                        <span class="material-symbols-outlined">search</span>
                        <input class="search-input" placeholder="Tìm kiếm sản phẩm..." value="" />
                    </label>
                    <div class="icon-buttons">
                      <a href="{{ URL::to('/login-checkout') }}">
                        <button class="icon-button">
                            <span class="material-symbols-outlined">person</span>
                        </button>
                      </a>
                        
                        <button class="icon-button">
                            <span class="material-symbols-outlined">favorite</span>
                        </button>
                        <a href="{{ URL::to('/show_cart') }}"><button class="icon-button cart-button">
                                <span class="material-symbols-outlined">shopping_bag</span>
                                <span class="cart-badge">{{ Cart::count() }}</span>
                            </button></a>
                    </div>
                </div>
            </div>
        </header> 
        <main>
            @yield('product')
        </main>
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
<script src="{{ asset('fontend/js/products.js') }}"></script>
<script src="{{ asset('fontend/js/product-detail.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{ asset('fontend/js/cart.js') }}"></script>
</html>