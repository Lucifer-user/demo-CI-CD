<!DOCTYPE html>
<html class="light" lang="vi">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Đăng nhập Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('fontend/css/auth.css') }}">
  <style>
    .material-symbols-outlined {
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
    }
  </style>
</head>

<body>
  <div class="auth-card-container">
    <main class="auth-card">
      <!-- Left Side (Image & Welcome) -->
      <div class="auth-card-image-side">
        <div class="auth-card-content">
          <a class="admin-logo" href="#">
            <span class="material-symbols-outlined text-primary" style="font-size: 2.25rem;">spa</span>
            <span class="admin-logo-text">BeautyAdmin</span>
          </a>
        </div>
        <div class="auth-card-content">
          <h1 class="admin-welcome-title">Chào mừng trở lại Bảng điều khiển Quản trị.</h1>
          <p class="auth-card-subtitle">Quản lý sản phẩm, đơn hàng và khách hàng của bạn một cách hiệu quả.</p>
        </div>
        <div class="auth-card-image-overlay"
          style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBBXDq-BRksD0hq2ihPmvIe6oJ05XcvQyN2vRGk_lDlGvQ9QhJI6t2JXxwsvOrKq7WTZkbRLpeQqp8zAR9RWpgXS-TeAlap5eVOd8wcehCXER7kBh7X4PV68wpGOkdnOFUMPnsFvOcLj_FQNgh2ndo41fQFLP-FRDLuVSi34HTHHQjMC0QlYg8ozn91_7fO4tI0NsPBZhS-rxwprmFbTytwJY7D-IZ-kxgXgVnf6hvPoDqmcY6whEi1KbO0K7lqUgGcmvctMTXXN0Bg');">
        </div>
      </div>

      <!-- Right Side (Form) -->
      <div class="auth-card-form-side">
        <div class="w-full max-w-md mx-auto" style="margin: 0 auto; width: 100%; max-width: 28rem;">
          <div class="lg:hidden mb-8" style="margin-bottom: 2rem; display: none;">
            <a class="admin-logo" href="#">
              <span class="material-symbols-outlined text-primary" style="font-size: 1.875rem;">spa</span>
              <span class="admin-logo-text" style="font-size: 1.25rem;">BeautyAdmin</span>
            </a>
          </div>

          <p class="auth-card-title">Đăng nhập tài khoản Admin</p>
          <p class="auth-card-subtitle">Chào mừng trở lại! Vui lòng nhập thông tin của bạn.</p>

          @if ($message = Session::get('error'))
            <div style="background-color: #fee; border: 1px solid #fcc; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem; color: #c33;">
              <p style="margin: 0; font-weight: 500;">{{ $message }}</p>
            </div>
          @endif

          <form class="flex flex-col gap-6" style="margin-top: 2rem; gap: 1.5rem;" action="{{ route('admin') }}" method="POST">
           {{ csrf_field() }}
            <div class="form-group">
              <label class="form-label">Tên đăng nhập hoặc Email</label>
              <input class="form-input" placeholder="Nhập tên đăng nhập hoặc email của bạn" value="" name="admin_email" />
            </div>
            <div class="form-group">
              <label class="form-label">Mật khẩu</label>
              <div class="form-input-wrapper">
                <input class="form-input has-toggle" placeholder="Nhập mật khẩu của bạn" type="password" name="admin_password" />
                <button class="password-toggle" type="button">
                  <span class="material-symbols-outlined">visibility_off</span>
                </button>
              </div>
            </div>

            <div class="flex justify-between items-center">
              <label class="checkbox-wrapper">
                <input class="form-checkbox" id="remember-me" type="checkbox" />
                <p class="text-sm">Ghi nhớ tôi</p>
              </label>
             
            </div>

            <button class="btn btn-primary">Đăng nhập Admin</button>
          </form>

         
        </div>
      </div>
    </main>
  </div>
</body>

</html>