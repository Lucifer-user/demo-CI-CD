<!DOCTYPE html>
<html class="light" lang="vi">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Đăng nhập </title>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/fontend/css/auth.css') }}">

</head>

<body>
  <div class="auth-container">
    <div class="auth-split">
      <!-- Image Side -->
      <div class="auth-image-side">
        <div class="auth-image"
          style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDmTKMSzwKVvXxTXaFVV7FJ22A4b9Zv4sSqh_-nT55dqGXSww2n3sZA5pwSuwHTMV37SO9s6Alo8HrzAsXQFiDu5QG5BuagS_wgwjzSYjJ3xBSQ6_DGQXyxL9ptsi1TFNAsmCVo8tw5OYan6eNdPMc3L7BBJZKLU9Xux9X0IhhmgwF6Cw_thg0vxG_BpbbAYRLLcUupFatCWDxopBT2jPgEtBTZJXq5NohAYaeLRhKaHkXCwYMZgbImEDROu4kMUe7_p-SOJH05vtGa");'>
        </div>
      </div>

      <!-- Form Side -->
      <div class="auth-form-side">
        <div class="auth-form-wrapper">
          <div class="text-center">
            <svg class="icon-logo" fill="none" height="24" stroke="currentColor" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z">
              </path>
              <path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path>
              <path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 22.33 8 21.5v-5c0-.83.67-1.5 1.5-1.5z">
              </path>
              <path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path>
              <path
                d="M14 12.5c0 .83-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5v5z">
              </path>
            </svg>
            <a href="{{URL::to('/')}}" class="logo">
            <h1 class="auth-title">Chào mừng trở lại</h1></a>
            <p class="auth-subtitle">Đăng nhập để tiếp tục mua sắm.</p>
          </div>

          <form action="{{URL::to('/login-customer')}}" method="POST">
            @csrf
          <div class="flex flex-col gap-4">
            <div class="form-group">
              <label class="form-label">Tên đăng nhập hoặc Email</label>
              <input class="form-input" type="text" name="email_account" placeholder="Nhập tên đăng nhập hoặc email" />
            </div>
            <div class="form-group">
              <label class="form-label">Mật khẩu</label>
              <div class="form-input-wrapper">
                <input class="form-input has-toggle" type="password" name="password_account" placeholder="Nhập mật khẩu của bạn" />
                <div class="password-toggle">
                  <span class="material-symbols-outlined" style="font-size: 24px;">visibility</span>
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-between items-center" style="margin-top: 1rem; margin-bottom: 1rem;">
            <label class="checkbox-wrapper">
              <input class="form-checkbox" type="checkbox" />
              <p class="text-base">Ghi nhớ tôi</p>
            </label>
            <a class="link-primary" href="#">Quên mật khẩu?</a>
          </div>

          <div class="flex flex-col gap-4">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
          </form>

            <div class="divider">
              <div class="divider-line"></div>
              <span class="divider-text">Hoặc đăng nhập với</span>
              <div class="divider-line"></div>
            </div>

            <div class="flex gap-4">
              <button class="btn btn-outline flex-1 gap-2">
                <svg class="social-icon" height="48px" viewbox="0 0 48 48" width="48px"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"
                    fill="#fbc02d"></path>
                  <path
                    d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"
                    fill="#e53935"></path>
                  <path
                    d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.223,0-9.657-3.657-11.303-8.653l-6.571,4.819C9.656,39.663,16.318,44,24,44z"
                    fill="#4caf50"></path>
                  <path
                    d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"
                    fill="#1565c0"></path>
                </svg>
                Google
              </button>
              <button class="btn btn-outline flex-1 gap-2">
                <svg class="social-icon text-[#1877F2]" height="24px" viewbox="0 0 24 24" width="24px"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M12,2C6.477,2,2,6.477,2,12c0,5.013,3.693,9.153,8.505,9.876V14.89H8.037v-3.363h2.468v-2.52c0-2.45,1.442-3.793,3.676-3.793c1.06,0,1.968,0.079,2.232,0.114v2.988h-1.764c-1.189,0-1.42,0.565-1.42,1.396v1.815h3.328l-0.433,3.363h-2.895v7.008C18.307,21.153,22,17.013,22,12C22,6.477,17.523,2,12,2z"
                    fill="currentColor"></path>
                </svg>
                Facebook
              </button>
            </div>
          </div>
          <p class="text-center text-muted">Chưa có tài khoản? <a class="link-primary font-bold" href="{{ URL::to('sigup') }}">Đăng ký</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>