// Products Database

    // 1. Lắng nghe sự kiện khi trang tải xong
    document.addEventListener('DOMContentLoaded', function () {
        
        // 2. Lấy tất cả các nút tab và các nội dung tab
        const tabHeaders = document.querySelectorAll('.tab-header');
        const tabContents = document.querySelectorAll('.tab-content');

        // 3. Gán sự kiện Click cho từng nút tab
        tabHeaders.forEach(header => {
            header.addEventListener('click', () => {
                
                // Bước A: Xóa class 'active' ở tất cả các nút và nội dung cũ
                tabHeaders.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Bước B: Thêm class 'active' vào nút vừa bấm
                header.classList.add('active');

                // Bước C: Lấy ID của tab cần hiện (ví dụ: 'description', 'specifications')
                const targetId = header.getAttribute('data-tab');
                
                // Bước D: Hiện nội dung tương ứng
                const targetContent = document.getElementById(targetId);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });
    });


// Function to navigate to product details
function viewProductDetails(productId) {
    window.location.href = `details.html?id=${productId}`;
}

// Add click handlers to product cards
document.addEventListener('DOMContentLoaded', function () {
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        // Make the entire card clickable except for buttons
        card.addEventListener('click', function (e) {
            // Don't navigate if clicking on a button or link
            if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A' || e.target.closest('button') || e.target.closest('a')) {
                return;
            }

            const productId = this.dataset.productId;
            if (productId) {
                viewProductDetails(productId);
            }
        });

        // Add pointer cursor
        card.style.cursor = 'pointer';
    });
});
