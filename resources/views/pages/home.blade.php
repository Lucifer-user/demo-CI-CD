@extends('layout')
@section('content')

<main>
<section class="hero-slider">
          <!-- Slide 1 -->
          <div class="hero-slide active"
            style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDLRsXDTdyCXeZcsyLKzlJJ4S9CsLOzxcSb470M8moVi9yKz1l7pCJ8XsE18FL58jpOl5egyBCnqRfcr6MCAYTzp5zCJx5btCi2SuURyUjlwKnt0gE_9KzygC57Ox-FYjzgoLU3dHGebDTfc6Bt4MmaxF27nROCjlEOqFptmYte8RkMqa9r-fMf1-8rT2qcQivNBLZltI5nIzDta5gSGkawbfGJCVJgY7FDWNw0Xlt2pYxQ3oyVnXA2Jxqi8enpMUJkFBN9gmHppgjI");'>
             <div class="hero-content animate-fade-down">
              <h1>Khám Phá Bộ Sưu Tập Tỏa Sáng Hè</h1>
              <p>Các sản phẩm thiết yếu tạo vẻ rạng ngời, tươi sáng quanh năm.</p>
              <button class="hero-btn">Mua Ngay</button>
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="hero-slide"
            style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://images.unsplash.com/photo-1596462502278-27bfdd403348?q=80&w=2070&auto=format&fit=crop");'>
             <div class="hero-content animate-fade-down">
              <h1>Vẻ Đẹp Rạng Ngời Tự Nhiên</h1>
              <p>Chăm sóc làn da của bạn với những tinh chất thiên nhiên tốt nhất.</p>
              <button class="hero-btn">Khám Phá</button>
            </div>
          </div>
          <!-- Slide 3 -->
          <div class="hero-slide"
            style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?q=80&w=1974&auto=format&fit=crop");'>
             <div class="hero-content animate-fade-down">
              <h1>Trang Điểm Hoàn Hảo</h1>
              <p>Bộ sưu tập son môi và phấn mắt mới nhất cho mùa lễ hội.</p>
              <button class="hero-btn">Mua Ngay</button>
            </div>
          </div>
        </section>

        <div class="container">
        <!-- Featured Product Grid -->
        <section>
          <h2 class="section-title">Bán Chạy Nhất</h2>
          <div class="carousel-container">
            <button class="carousel-btn prev" aria-label="Previous">
              <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <div class="carousel-track-container">
              <div class="carousel-track">
                @foreach($all_product as $key => $product)
                <div class="product-card-new animate-fade-up" style="height: 100%; animation-delay: {{ $loop->index * 0.1 }}s;">
                    <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" style="text-decoration:none; display: block; height: 100%;">
                        <div class="p-card-img" style="background-image: url('{{ asset('uploads/product/'.$product->product_image) }}');">
                            <!-- Badges Mockup -->
                            @if($key % 2 == 0) <div class="badge-chinhhang">Chính Hãng</div> @endif
                            <div class="badge-discount">
                                <span>34%</span>
                                <div style="font-size: 8px; font-weight: 400; color: white;">GIẢM</div>
                            </div>
                        </div>

                        <div class="p-card-content">
                            <div>
                                <div class="p-brand-name">{{ $product->brand_name ?? 'THƯƠNG HIỆU' }}</div>
                                <div class="p-name">{{ $product->product_name }}</div>
                                
                                <div class="p-tags">
                                    <span class="p-tag">Mua kèm deal sốc</span>
                                </div>
                            </div>

                            <div>
                                <div class="p-price-row">
                                    <div class="p-price-current">{{ number_format($product->product_price, 0, ',', '.') }}đ</div>
                                    <div class="p-price-old">{{ number_format($product->product_price * 1.3, 0, ',', '.') }}đ</div>
                                </div>

                                <div class="p-bottom-row">
                                     <div class="p-rating">
                                        <span class="material-symbols-outlined p-star" style="font-size: 10px;">star</span>
                                        <span>{{ rand(45, 50)/10 }}</span>
                                        <span>({{ rand(10, 200) }})</span>
                                     </div>
                                     <div class="p-sold">Đã bán {{ rand(50, 999) }}</div>
                                </div>

                                <div class="p-progress">
                                    <div class="p-progress-bar" style="width: {{ rand(30, 90) }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
              </div>
            </div>
            <button class="carousel-btn next" aria-label="Next">
              <span class="material-symbols-outlined">chevron_right</span>
            </button>
          </div>
        </section>
        <!-- Brands Showcase -->
        <section>
          <h2 class="section-title">Thương hiệu</h2>
          <div class="brands-grid">
             @foreach($brand as $key => $brand_item)
            <a class="brand-card animate-fade-up" href="{{ URL::to('/thuong-hieu-san-pham/'.$brand_item->brand_id) }}" style="animation-delay: {{ $loop->index * 0.1 }}s;">
              <div class="brand-image"
                style="background-image: url('{{ URL::to('uploads/brand/'.$brand_item->brand_image) }}');">
              </div>
              <div class="brand-logo">
                <span class="brand-text">{{ $brand_item->brand_name }}</span>
              </div>
            </a>
            @endforeach
          </div>
        </section>
        <!-- Promotional Banner -->
        <section class="promo-banner">
          <div class="promo-content">
            <h3 class="promo-title">Giảm 20% Cho Đơn Hàng Đầu Tiên</h3>
            <p class="promo-subtitle">Đăng ký nhận bản tin của chúng tôi và tận hưởng ưu đãi độc quyền.</p>
          </div>
          <form class="newsletter-form">
            <input placeholder="Nhập email của bạn" type="email" />
            <button class="newsletter-btn" type="submit">Đăng Ký</button>
          </form>
        </section>
        <!-- Testimonials Section -->
        <section>
          <h2 class="section-title text-center">Những Lời Nhận Xét Của Khách Hàng</h2>
          <div class="testimonials-grid">
            <div class="testimonial-card">
              <div class="star-rating">
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
              </div>
              <p class="testimonial-text">"Tinh Chất Tỏa Sáng đã hoàn toàn thay đổi làn da của tôi. Tôi chưa bao giờ cảm
                thấy tự tin như vậy!"</p>
              <p class="testimonial-author">- Jessica L.</p>
            </div>
            <div class="testimonial-card">
              <div class="star-rating">
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
              </div>
              <p class="testimonial-text">"Tôi mê mẩn Son Môi Nhung Matte. Màu sắc hoàn hảo và lâu trôi suốt cả ngày."
              </p>
              <p class="testimonial-author">- Megan P.</p>
            </div>
            <div class="testimonial-card">
              <div class="star-rating">
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star</span>
                <span class="star material-symbols-outlined">star_half</span>
              </div>
              <p class="testimonial-text">"Giao hàng nhanh và đóng gói đẹp. SALA BEAUTY là lựa chọn yêu thích mới của
                tôi."</p>
              <p class="testimonial-author">- Chloe B.</p>
            </div>
          </div>
        </section>
        </div>

      </main>
@endsection