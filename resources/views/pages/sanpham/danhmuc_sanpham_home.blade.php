
@extends('layout_product')

@section('product')
<div class="main-content">
                <div class="breadcrumb">
                    <a href="index.html">Trang chủ</a>
                    <span>/</span>
                    <a href="#">Trang điểm</a>
                    <span>/</span>
                    
                </div>
                <div class="content-grid">
                    <aside class="sidebar">
                        <div class="sidebar-sticky">
                            <form action="{{ request()->url() }}" method="GET">

                    <div class="filter-section">
                        <h3>Danh mục</h3>
                        <div class="checkbox-group">
                            @foreach ($cate_product as $cate)
                            <div class="checkbox-item">
                                <input id="category-{{ $cate->id }}" 
                                       name="category[]" 
                                       type="checkbox" 
                                       value="{{ $cate->id }}"
                                       {{ (isset($_GET['category']) && in_array($cate->id, $_GET['category'])) ? 'checked' : '' }}
                                />
                                <label for="category-{{ $cate->id }}">{{ $cate->category_name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Thương hiệu</h3>
                        <div class="checkbox-group">
                            @foreach ($brand_product as $brand)
                                <div class="checkbox-item">
                                    <input id="brand-{{ $brand->brand_id }}" 
                                           name="brand[]"  
                                           type="checkbox" 
                                           value="{{ $brand->brand_id }}"
                                           {{ (isset($_GET['brand']) && in_array($brand->brand_id, $_GET['brand'])) ? 'checked' : '' }} 
                                    />
                                    
                                    <label for="brand-{{ $brand->brand_id }}">
                                        {{ $brand->brand_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>Khoảng giá</h3>
                        <div class="radio-group" style="display: flex; flex-direction: column; gap: 10px;">
                            
                            <div>
                                <input type="radio" id="price_all" name="price" value="0" {{ request()->price == 0 ? 'checked' : '' }}>
                                <label for="price_all">Tất cả</label>
                            </div>

                            <div>
                                <input type="radio" id="price_1" name="price" value="1" {{ request()->price == 1 ? 'checked' : '' }}>
                                <label for="price_1">Dưới 100.000đ</label>
                            </div>

                            <div>
                                <input type="radio" id="price_2" name="price" value="2" {{ request()->price == 2 ? 'checked' : '' }}>
                                <label for="price_2">100.000đ - 500.000đ</label>
                            </div>

                            <div>
                                <input type="radio" id="price_3" name="price" value="3" {{ request()->price == 3 ? 'checked' : '' }}>
                                <label for="price_3">500.000đ - 1.000.000đ</label>
                            </div>

                            <div>
                                <input type="radio" id="price_4" name="price" value="4" {{ request()->price == 4 ? 'checked' : '' }}>
                                <label for="price_4">Trên 1.000.000đ</label>
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="filter-button" style="margin-top: 20px; width: 100%; cursor: pointer;">
                        Áp dụng Bộ lọc
                    </button>
                
                </form> 
                        </div>
                    </aside>
                    <div class="products-section">
                        <div class="products-header">
                            <div class="products-title-section">
                                <p class="products-title">Danh mục sản phẩm</p>
                                <p class="products-subtitle">Hiển thị 24 trên 128 kết quả</p>
                            </div>
                            <div class="sort-section">
                                <button class="sort-button">
                                    <p>Sắp xếp theo: Mới nhất</p>
                                    <span class="material-symbols-outlined">expand_more</span>
                                </button>
                            </div>
                        </div>
                       <div class="products-grid" style="grid-template-columns: repeat(4, 1fr);">

 @foreach ($category_by_id as $key => $value)
    <div class="product-card-new">
        <a href="{{ URL::to('/chi-tiet-san-pham/'.$value->product_id) }}" style="text-decoration:none; display: block; height: 100%;">
            <div class="p-card-img" style="background-image: url('{{ asset('uploads/product/'.$value->product_image) }}');">
                <!-- Badges Mockup -->
                @if($key % 2 == 0) <div class="badge-chinhhang">Chính Hãng</div> @endif
                <div class="badge-discount">
                    <span>34%</span>
                    <div style="font-size: 8px; font-weight: 400; color: white;">GIẢM</div>
                </div>
            </div>

            <div class="p-card-content">
                <div>
                    <div class="p-brand-name">{{ $value->brand_name ?? 'THƯƠNG HIỆU' }}</div>
                    <div class="p-name">{{ $value->product_name }}</div>
                    
                    <div class="p-tags">
                        <span class="p-tag">Mua kèm deal sốc</span>
                    </div>
                </div>

                <div>
                    <div class="p-price-row">
                        <div class="p-price-current">{{ number_format($value->product_price, 0, ',', '.') }}đ</div>
                        <div class="p-price-old">{{ number_format($value->product_price * 1.3, 0, ',', '.') }}đ</div>
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
                        <nav aria-label="Pagination" class="pagination">
                            <ul class="pagination-list">
                                <li><a class="pagination-link" href="#">Trước</a></li>
                                <li><a class="pagination-link" href="#">1</a></li>
                                <li><a aria-current="page" class="pagination-link active" href="#">2</a></li>
                                <li><a class="pagination-link" href="#">3</a></li>
                                <li><span class="pagination-link">...</span></li>
                                <li><a class="pagination-link" href="#">8</a></li>
                                <li><a class="pagination-link" href="#">Sau</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            @endsection