// Cart functionality
document.addEventListener('DOMContentLoaded', function () {

    // --- 1. XỬ LÝ NÚT CỘNG TRỪ SỐ LƯỢNG ---
    const quantityControls = document.querySelectorAll('.quantity-controls');

    if (quantityControls) { // Kiểm tra có tồn tại mới chạy
        quantityControls.forEach(control => {
            const minusBtn = control.querySelector('.minus');
            const plusBtn = control.querySelector('.plus');
            const quantityInput = control.querySelector('input[name="cart_qty"]'); // Sửa selector cho đúng name

            if (minusBtn && plusBtn && quantityInput) {
                // Nút Trừ
                minusBtn.addEventListener('click', function (e) {
                    e.preventDefault(); // Chặn load lại trang nếu là thẻ a hoặc button submit
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                    }
                });

                // Nút Cộng
                plusBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    let currentValue = parseInt(quantityInput.value);
                    quantityInput.value = currentValue + 1;
                });
            }
        });
    }

    // --- 2. XỬ LÝ MÃ GIẢM GIÁ (Giữ lại tính năng UI) ---
    const couponLink = document.querySelector('.coupon-link');
    if (couponLink) {
        couponLink.addEventListener('click', function (e) {
            e.preventDefault();
            const couponCode = prompt('Nhập mã giảm giá của bạn:');
            if (couponCode) {
                // Sau này sẽ gửi Ajax lên server ở đây
                alert(`Tính năng nhập mã "${couponCode}" đang phát triển!`);
            }
        });
    }

    // --- 3. FIX LỖI NÚT THANH TOÁN (Như câu trước đã nhắc) ---
    const checkoutBtn = document.querySelector('.btn-checkout');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function () {
            // Logic khi bấm thanh toán (nếu cần JS)
        });
    }
});

// Delete buttons
const deleteButtons = document.querySelectorAll('.delete-btn');

deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
        const cartItem = this.closest('.cart-item');
        cartItem.style.opacity = '0';

        setTimeout(() => {
            cartItem.remove();
            updateCartTotals();
            updateCartCount();
        }, 300);
    });
});

// Update cart totals
function updateCartTotals() {
    let subtotal = 0;
    const cartItems = document.querySelectorAll('.cart-item');

    cartItems.forEach(item => {
        const quantity = parseInt(item.querySelector('.quantity-input').value);
        const priceText = item.querySelector('.item-price').textContent;
        const price = parseFloat(priceText.replace('$', ''));

        subtotal += quantity * price;
    });

    // Update subtotal display
    document.querySelectorAll('.summary-row span').forEach(span => {
        if (span.textContent.includes('Tổng phụ')) {
            span.nextElementSibling.textContent = `$${subtotal.toFixed(2)}`;
        }
    });

    // Update total display
    document.querySelector('.summary-total span:last-child').textContent = `$${subtotal.toFixed(2)}`;
}

// Update cart count in header
function updateCartCount() {
    const cartItems = document.querySelectorAll('.cart-item');
    const cartBadge = document.querySelector('.cart-badge');
    const pageTitle = document.querySelector('.page-title');

    cartBadge.textContent = cartItems.length;

    // Update page title with new count
    pageTitle.textContent = `Giỏ Hàng Của Tôi (${cartItems.length})`;
}



// Coupon link
// Coupon link
const couponLink = document.querySelector('.coupon-link');

if (couponLink) {
    couponLink.addEventListener('click', function (e) {
        e.preventDefault();

        // In a real application, this would show a coupon input field
        const couponCode = prompt('Nhập mã giảm giá của bạn:');
        if (couponCode) {
            alert(`Mã giảm giá "${couponCode}" đã được áp dụng!`);
        }
    });
}

// Initialize cart totals
// updateCartTotals(); 


//form đia chỉ

    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    axios.get("https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json").then(function (result) { renderCity(result.data); });
    function renderCity(data) {
        for (const x of data) citis.options[citis.options.length] = new Option(x.Name, x.Name);
        citis.onchange = function () {
            districts.length = 1; wards.length = 1;
            if(this.value != ""){
                const result = data.filter(n => n.Name === this.value);
                for (const k of result[0].Districts) districts.options[districts.options.length] = new Option(k.Name, k.Name);
            }
        };
        districts.onchange = function () {
            wards.length = 1;
            const dataCity = data.filter((n) => n.Name === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;
                for (const w of dataWards) wards.options[wards.options.length] = new Option(w.Name, w.Name);
            }
        };
    }
