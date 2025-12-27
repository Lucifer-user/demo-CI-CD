@extends('layout_product')

@section('product')

<div class="main-content">
    <div class="breadcrumb">
    <a href="{{ URL::to('/') }}">Trang chủ</a>
    <span>/</span>
    <span>Kết quả tìm kiếm</span>
</div>
    <div class="content-grid">
        <aside class="sidebar">
            <div class="sidebar-sticky">
                
                <form action="{{ request()->url() }}" method="GET">

                    <div class="filter-section">
                        <h3>Danh mục</h3>
                        <div class="checkbox-group">
                            @foreach ($category as $cate)
                            <div class="checkbox-item">
                                <label>{{ $cate->category_name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Thương hiệu</h3>
                        <div class="checkbox-group">
                            @foreach ($brand as $brand_item)
                                <div class="checkbox-item">
                                    <label>{{ $brand_item->brand_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                </form> 
            </div>
        </aside>
        <div class="products-section">
            <div class="products-header">
                <div class="products-title-section">
                    <h1>Kết quả tìm kiếm</h1>
                    <span class="product-count">{{ count($search_product) }} kết quả</span>
                </div>
            </div>

            <div class="products-grid">
                @foreach($search_product as $key => $product)
                <div class="product-card">
                    <div class="product-image-wrapper">
                        <!-- Discount Badge -->
                        @if(isset($product->product_sale_price) && $product->product_sale_price < $product->product_price)
                            <span class="discount-badge">
                                -{{ round((($product->product_price - $product->product_sale_price) / $product->product_price) * 100) }}%
                            </span>
                        @endif

                        <!-- Product Image -->
                         <div class="product-image" style="background-image: url('{{ URL::to('uploads/product/'.$product->product_image) }}');"></div>

                        <!-- Quick View Button -->
                        <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}">
                             <button class="quick-view-btn">
                                Xem chi tiết
                            </button>
                        </a>
                    </div>
                    
                    <div class="product-info">
                        <h3>{{ $product->product_name }}</h3>
                        
                        <div class="price-container">
                            <span class="current-price">{{ number_format($product->product_price, 0, ',', '.') }}đ</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
           
        </div>
    </div>
</div>
@endsection
