// Load product details from URL parameter
document.addEventListener('DOMContentLoaded', function () {
    // Get the products database
    const products = window.productsData || {};

    // Get product ID from URL
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');

    if (!productId) {
        // Not a product detail page, or ID missing. Just exit silently or log info
        // console.log('No product ID found in URL'); 
        return;
    }

    if (!products[productId]) {
        // Product ID exists but not in static JS data. 
        // Since we are using Laravel backend, this static check might be obsolete/interfering.
        // We should probably just return to let Laravel handle it, or log a warning.
        console.warn('Product ID found in URL but not in static products data. Ignoring static data check.');
        // return; // Don't return here, let the rest of the script (or Laravel) handle it
    }

    const product = products[productId];

    // Update page title
    document.title = `${product.name} - SALA Beauty`;

    // Update product images
    const mainImage = document.querySelector('.main-image');
    if (mainImage && product.images && product.images.length > 0) {
        mainImage.style.backgroundImage = `url("${product.images[0]}")`;
    }

    // Update thumbnails
    const thumbnailContainer = document.querySelector('.thumbnail-images');
    if (thumbnailContainer && product.images) {
        thumbnailContainer.innerHTML = '';
        product.images.forEach((img, index) => {
            const thumb = document.createElement('div');
            thumb.className = 'thumbnail' + (index === 0 ? ' active' : '');
            thumb.style.backgroundImage = `url("${img}")`;
            thumb.addEventListener('click', function () {
                // Remove active class from all thumbnails
                document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                // Add active to clicked thumbnail
                this.classList.add('active');
                // Update main image
                mainImage.style.backgroundImage = `url("${img}")`;
            });
            thumbnailContainer.appendChild(thumb);
        });
    }

    // Update product title
    const titleEl = document.querySelector('.product-title');
    if (titleEl) titleEl.textContent = product.name;

    // Update price
    const priceEl = document.querySelector('.product-price-large');
    if (priceEl) priceEl.textContent = product.price;

    // Update rating
    const ratingCountEl = document.querySelector('.rating-count');
    if (ratingCountEl) ratingCountEl.textContent = `(${product.reviewCount} đánh giá)`;

    // Update description
    const descEl = document.querySelector('.product-description');
    if (descEl) descEl.textContent = product.description;

    // Update features
    const featuresEl = document.querySelector('.product-features ul');
    if (featuresEl && product.features) {
        featuresEl.innerHTML = '';
        product.features.forEach(feature => {
            const li = document.createElement('li');
            li.innerHTML = `<span class="material-symbols-outlined">check_circle</span> ${feature}`;
            featuresEl.appendChild(li);
        });
    }

    // Update SKU
    const skuEl = document.querySelector('.product-meta p:nth-child(1)');
    if (skuEl) skuEl.innerHTML = `<strong>SKU:</strong> ${product.sku}`;

    // Update category
    const categoryEl = document.querySelector('.product-meta p:nth-child(2)');
    if (categoryEl) categoryEl.innerHTML = `<strong>Danh mục:</strong> ${product.category}, ${product.subcategory}`;

    // Update brand
    const brandEl = document.querySelector('.product-meta p:nth-child(3)');
    if (brandEl) brandEl.innerHTML = `<strong>Thương hiệu:</strong> ${product.brand}`;

    // Update breadcrumb
    const breadcrumbCategory = document.querySelector('.breadcrumb a:nth-child(2)');
    if (breadcrumbCategory) breadcrumbCategory.textContent = product.category;

    const breadcrumbCurrent = document.querySelector('.breadcrumb .current');
    if (breadcrumbCurrent) breadcrumbCurrent.textContent = product.name;

    // Tab switching functionality
    const tabHeaders = document.querySelectorAll('.tab-header');
    const tabContents = document.querySelectorAll('.tab-content');

    tabHeaders.forEach(header => {
        header.addEventListener('click', function () {
            const tabName = this.dataset.tab;

            // Remove active class from all headers and contents
            tabHeaders.forEach(h => h.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            // Add active class to clicked header and corresponding content
            this.classList.add('active');
            const content = document.getElementById(tabName);
            if (content) content.classList.add('active');
        });
    });

    // Quantity controls
    const minusBtn = document.querySelector('.qty-btn.minus');
    const plusBtn = document.querySelector('.qty-btn.plus');
    const qtyInput = document.querySelector('.quantity-controls input');

    if (minusBtn && qtyInput) {
        minusBtn.addEventListener('click', function () {
            const currentValue = parseInt(qtyInput.value) || 1;
            if (currentValue > 1) {
                qtyInput.value = currentValue - 1;
            }
        });
    }

    if (plusBtn && qtyInput) {
        plusBtn.addEventListener('click', function () {
            const currentValue = parseInt(qtyInput.value) || 1;
            qtyInput.value = currentValue + 1;
        });
    }
});
