@extends('layout_product')
@section('product')
@foreach($product_details as $key => $value)

<div class="main-content">
    <div class="breadcrumb">
        <a href="{{ URL::to('/') }}">Trang chủ</a>
        <span>/</span>
        <a href="{{ URL::to('/danh-muc-san-pham/'.$value->id) }}">{{ $value->category_name }}</a>
        <span>/</span>
        <span class="current">{{ $value->product_name }}</span>
    </div>

    <div class="product-detail-container">
        <div class="product-images">
            <div class="thumbnail-images">
                <div class="thumbnail active" 
                    style="background-image: url('{{ asset('uploads/product/'.$value->product_image) }}');"
                    onclick="changeMainImage(this, '{{ asset('uploads/product/'.$value->product_image) }}')">
                </div>
                @if(isset($gallery_images))
                    @foreach($gallery_images as $img)
                    <div class="thumbnail" 
                        style="background-image: url('{{ asset('uploads/product/'.$img->image) }}');"
                        onclick="changeMainImage(this, '{{ asset('uploads/product/'.$img->image) }}')">
                    </div>
                    @endforeach
                @endif
            </div>

            <div class="main-image"
                style="background-image: url('{{ asset('uploads/product/'.$value->product_image) }}');">
            </div>
            
            <script>
                function changeMainImage(element, imageUrl) {
                    // Update main image background
                    document.querySelector('.main-image').style.backgroundImage = "url('" + imageUrl + "')";
                    
                    // Update active state of thumbnails
                    document.querySelectorAll('.thumbnail').forEach(thumb => {
                        thumb.classList.remove('active');
                    });
                    element.classList.add('active');
                }
            </script>
        </div>

        <div class="product-info-detail">
            <h1 class="product-title">{{ $value->product_name }}</h1>
            
            <div class="product-rating">
                <div class="stars">
                    <span class="material-symbols-outlined star-filled" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined star-filled" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined star-filled" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined star-filled" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined star-filled" style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
               
            </div>

            <p class="product-price-large">{{ number_format($value->product_price, 0, ',', '.') }}đ</p>
            
           

            <div class="product-features">
                <h3>Đặc điểm nổi bật:</h3>
                <ul>
                    <li><span class="material-symbols-outlined">check_circle</span> Hàng chính hãng 100%</li>
                    <li><span class="material-symbols-outlined">check_circle</span> Thương hiệu: {{ $value->brand_name }}</li>
                    <li><span class="material-symbols-outlined">check_circle</span> Danh mục: {{ $value->category_name }}</li>
                </ul>
            </div>

            <form action="{{ URL::to('/save-cart') }}" method="POST">
                @csrf
                <input type="hidden" name="productid_hidden" value="{{ $value->product_id }}">

                <div class="quantity-selector">
                    <label>Số lượng:</label>
                    <div class="quantity-controls">
                        <input type="number" name="qty" value="1" min="1" style="width: 70px; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="product-actions">
                    <input type="hidden" value="{{ $value->product_id }}" name="productid_hidden">
                    <button type="submit" class="btn-add-cart" style="cursor: pointer;">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        Thêm vào giỏ hàng
                    </button>
                    
                    <button type="button" class="btn-wishlist">
                        <span class="material-symbols-outlined">favorite</span>
                    </button>
                </div>
            </form>
            <!-- <div class="product-meta">
                <p><strong>SKU:</strong> SP-{{ $value->product_id }}</p>
                <p><strong>Danh mục:</strong> {{ $value->category_name }}</p>
                <p><strong>Thương hiệu:</strong> {{ $value->brand_name }}</p>
            </div> -->
        </div>
    </div>

    <div class="product-tabs-nav">
        <div class="tab-headers sticky-nav">
            <a href="#description" class="tab-link active">Mô tả </a>
            <a href="#specifications" class="tab-link">Thông số sản phẩm</a>
            <a href="#ingredients" class="tab-link">Thành phần</a>
            <a href="#hansudung" class="tab-link">HDSD</a>
            <a href="#reviews" class="tab-link">Đánh giá</a>
        </div>
    </div>

    <div class="product-content-sections">
        <div class="content-section" id="description">
            <h3>Mô tả sản phẩm</h3>
            <p>{!! $value->product_description !!}</p>
        </div>

        <div class="content-section" id="specifications">
            <h3>Thông số sản phẩm</h3>
            <div class="specs-table-container">
                <table class="table-specs">
                    <tbody>
                        <tr>
                            <td class="spec-label">Mã sản phẩm</td>
                            <td class="spec-value">{{ $value->product_id }}</td>
                        </tr>

                        <tr>
                            <td class="spec-label">Thương hiệu</td>
                            <td class="spec-value">{{ $value->brand_name }}</td>
                        </tr>
                        <tr>
                            <td class="spec-label">Dung tích</td>
                            <td class="spec-value">{{ $value->product_weight }}</td>
                        </tr>


                        @if(!empty($value->product_origin))
                        <tr>
                            <td class="spec-label">Xuất xứ thương hiệu</td>
                            <td class="spec-value">{{ $value->product_origin }}</td>
                        </tr>
                        @endif

                        <tr>
                            <td class="spec-label">Danh mục</td>
                            <td class="spec-value">{{ $value->category_name }}</td>
                        </tr>

                        @if(isset($product_attributes) && count($product_attributes) > 0)
                            @foreach($product_attributes as $attr)
                            <tr>
                                <td class="spec-label">{{ $attr->attribute_name }}</td>
                                <td class="spec-value">{{ $attr->value }}</td>
                            </tr>
                            @endforeach
                        @else
                          
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-section" id="ingredients">
            <h3>Thành phần</h3>
            <p>{!! $value->product_ingredient !!}</p>
        </div>
        
        <div class="content-section" id="hansudung">
            <h3>Hướng dẫn sử dụng</h3>
            <p>{!! $value->product_usage !!}</p>
        </div>

        <div class="content-section" id="reviews">
            <h3>Đánh giá từ khách hàng</h3>
            <p>Chức năng đang cập nhật...</p>
        </div>
    </div>

    <script>
        // Handle click active state
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Optional: Scroll Spy to update active state on scroll
        const sections = document.querySelectorAll('.content-section');
        const navLinks = document.querySelectorAll('.tab-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                }
            });
        });
    </script>

    <div class="related-products">
        <h2 class="section-title">Sản phẩm liên quan</h2>
        <div class="products-grid">
            
            @foreach($related_products as $key => $lienquan)
            <div class="product-card" style="background: white; border-radius: 1rem; overflow: hidden; border: 1px solid #f3e7ea; height: 100%; display: flex; flex-direction: column;">
                <div class="product-image-container"
                    style="background-image: url('{{ asset('uploads/product/'.$lienquan->product_image) }}');">
                    <a href="{{ URL::to('/chi-tiet-san-pham/'.$lienquan->product_id) }}">
                        <button class="quick-view-btn">Xem Chi Tiết</button>
                    </a>
                </div>
                <div class="product-info" style="padding: 1.5rem; background: white; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                    <p class="product-name" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; height: 2.8em; line-height: 1.4; font-weight: 700; font-size: 1rem; color: #1b0d11;">{{ $lienquan->product_name }}</p>
                    <p class="product-brand" style="color: #9a4c5f; font-size: 0.85rem;">{{ $lienquan->brand_name ?? 'Chưa có thương hiệu' }}</p>
                    <p class="product-price" style="font-weight: 800; font-size: 1.1rem; color: #ee2b5b; margin-top: 0.25rem;">{{ number_format($lienquan->product_price, 0, ',', '.') }}đ</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

@endforeach
@endsection