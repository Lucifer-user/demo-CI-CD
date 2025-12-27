<!DOCTYPE html>
<html class="light" lang="vi">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Tạo Tài Khoản - SALA Beauty</title>
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/fontend/css/auth.css') }}">
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
  <div class="relative flex min-h-screen w-full flex-col bg-background-light group/design-root overflow-x-hidden"
    style="background-color: var(--background-light);">
    <div class="layout-container flex h-full grow flex-col">
      <header class="header">
        <div class="header-logo">
          <div class="icon-logo" style="width: 1.5rem; height: 1.5rem;">
            <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
              <path clip-rule="evenodd"
                d="M39.475 21.6262C40.358 21.4363 40.6863 21.5589 40.7581 21.5934C40.7876 21.655 40.8547 21.857 40.8082 22.3336C40.7408 23.0255 40.4502 24.0046 39.8572 25.2301C38.6799 27.6631 36.5085 30.6631 33.5858 33.5858C30.6631 36.5085 27.6632 38.6799 25.2301 39.8572C24.0046 40.4502 23.0255 40.7407 22.3336 40.8082C21.8571 40.8547 21.6551 40.7875 21.5934 40.7581C21.5589 40.6863 21.4363 40.358 21.6262 39.475C21.8562 38.4054 22.4689 36.9657 23.5038 35.2817C24.7575 33.2417 26.5497 30.9744 28.7621 28.762C30.9744 26.5497 33.2417 24.7574 35.2817 23.5037C36.9657 22.4689 38.4054 21.8562 39.475 21.6262ZM4.41189 29.2403L18.7597 43.5881C19.8813 44.7097 21.4027 44.9179 22.7217 44.7893C24.0585 44.659 25.5148 44.1631 26.9723 43.4579C29.9052 42.0387 33.2618 39.5667 36.4142 36.4142C39.5667 33.2618 42.0387 29.9052 43.4579 26.9723C44.1631 25.5148 44.659 24.0585 44.7893 22.7217C44.9179 21.4027 44.7097 19.8813 43.5881 18.7597L29.2403 4.41187C27.8527 3.02428 25.8765 3.02573 24.2861 3.36776C22.6081 3.72863 20.7334 4.58419 18.8396 5.74801C16.4978 7.18716 13.9881 9.18353 11.5858 11.5858C9.18354 13.988 7.18717 16.4978 5.74802 18.8396C4.58421 20.7334 3.72865 22.6081 3.36778 24.2861C3.02574 25.8765 3.02429 27.8527 4.41189 29.2403Z"
                fill="currentColor" fill-rule="evenodd"></path>
            </svg>
          </div>
          <h2 class="header-title">SALA BEAUTY</h2>
        </div>
      </header>

      <main class="main-content">
        <div class="register-container">
          <div class="text-center mb-8" style="margin-bottom: 2rem;">
            <h1 class="register-title">Tạo Tài Khoản</h1>
            <p class="auth-subtitle">Tham gia cộng đồng và nhận ưu đãi độc quyền</p>
          </div>

          <form class="flex flex-col gap-6" style="gap: 1.5rem;" action="{{URL::to('/add_customer')}}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div class="alert alert-danger" style="color: red; background-color: #f8d7da; border-color: #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
              <label class="form-label" for="fullName" name="customer_name">Họ và Tên</label>
              <input class="form-input" name="customer_name" id="fullName" placeholder="Nhập họ và tên của bạn" type="text" />
            </div>

            <div class="form-group">
              <label class="form-label" for="email" name="customer_email">Địa chỉ Email</label>
              <input class="form-input" name="customer_email" id="email" placeholder="Nhập địa chỉ email của bạn" type="email" />
            </div>

            <div class="form-group">
              <label class="form-label" for="password" name="customer_password">Mật khẩu</label>
              <div class="form-input-wrapper">
                <input class="form-input has-toggle" name="customer_password" id="password" placeholder="Nhập mật khẩu" type="password" />
                <button aria-label="Toggle password visibility" class="password-toggle" type="button">
                  <span class="material-symbols-outlined">visibility</span>
                </button>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="confirmPassword" name="customer_password"  type="password">Xác nhận Mật khẩu</label>
              <div class="form-input-wrapper">
                <input class="form-input has-toggle" name="customer_password_confirmation"   id="confirmPassword" placeholder="Nhập lại mật khẩu của bạn"
                  type="password" />
                <button aria-label="Toggle password visibility" class="password-toggle" type="button">
                  <span class="material-symbols-outlined">visibility</span>
                </button>
              </div>
            </div>

            <div class="flex items-center gap-2">
              <input class="form-checkbox" id="terms" type="checkbox" style="height: 1rem; width: 1rem;" />
              <label class="text-sm text-muted" for="terms">
                Tôi đồng ý với
                <a class="link-primary" href="#">Điều khoản &amp; Điều kiện</a>
              </label>
            </div>

            <button class="btn btn-primary" type="submit">
              Đăng ký
            </button>
          </form>

          <div class="text-center mt-6" style="margin-top: 1.5rem;">
            <p class="text-sm text-muted">
              Đã có tài khoản?
              <a class="link-primary" href="{{URL::to('/login-checkout')}}">Đăng nhập ngay</a>
            </p>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>