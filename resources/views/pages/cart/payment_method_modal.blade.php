
<!-- Payment Method Modal -->
<div id="payment-method-modal" class="modal-overlay" style="display: none;">
    <div class="modal-container" style="max-width: 600px;">
        <div class="modal-header">
            <h3>Hình thức thanh toán</h3>
            <span class="close-btn" onclick="document.getElementById('payment-method-modal').style.display='none'">&times;</span>
        </div>
        
        <div class="modal-body">
            <!-- Option 1: COD -->
            <div class="payment-option-item selected">
                <label class="radio-container">
                    <input type="radio" name="modal_payment_option" value="1" checked>
                    <span class="checkmark"></span>
                    <span class="method-text">
                        <span class="material-symbols-outlined text-warning" style="vertical-align: middle; margin-right: 10px; font-size: 24px;">payments</span>
                        <span style="font-weight: 500;">Thanh toán khi nhận hàng (COD)</span>
                    </span>
                </label>
                <div class="payment-warning">
                    <span class="material-symbols-outlined" style="font-size: 18px; margin-right: 5px;">warning</span>
                    Lưu ý: SALA chỉ nhận thanh toán vào tài khoản công ty (không chuyển qua tài khoản cá nhân)
                </div>
            </div>

            <!-- Option 2: ATM -->
            <div class="payment-option-item mt-3">
                <label class="radio-container">
                    <input type="radio" name="modal_payment_option" value="2">
                    <span class="checkmark"></span>
                    <span class="method-text">
                        <span class="material-symbols-outlined" style="vertical-align: middle; margin-right: 10px; font-size: 24px;">credit_card</span>
                         <span style="font-weight: 500;">Thẻ ATM nội địa/Internet Banking (Hỗ trợ Internet Banking)</span>
                    </span>
                </label>
            </div>

            <!-- Option 3: VNPAY -->
            <div class="payment-option-item mt-3">
                <label class="radio-container">
                    <input type="radio" name="modal_payment_option" value="3">
                    <span class="checkmark"></span>
                    <span class="method-text">
                        <img src="https://vinadesign.vn/uploads/images/2023/05/vnpay-logo-vinadesign-25-12-57-55.png" height="24" style="margin-right: 10px; vertical-align: middle;">
                         <span style="font-weight: 500;">Thanh toán trực tuyến VNPAY</span>
                    </span>
                </label>
            </div>

            <!-- Option 4: Vietcombank -->
            <div class="payment-option-item mt-3">
                <label class="radio-container">
                    <input type="radio" name="modal_payment_option" value="4">
                    <span class="checkmark"></span>
                    <span class="method-text">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-Vietcombank.png" height="24" style="margin-right: 10px; vertical-align: middle;">
                         <span style="font-weight: 500;">Thanh toán trực tuyến Vietcombank</span>
                    </span>
                </label>
            </div>
            
            <!-- Option 5: Payoo -->
            <div class="payment-option-item mt-3">
                <label class="radio-container">
                    <input type="radio" name="modal_payment_option" value="5">
                    <span class="checkmark"></span>
                    <span class="method-text">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-Payoo-V.png" height="24" style="margin-right: 10px; vertical-align: middle;">
                         <span style="font-weight: 500;">Thanh toán trực tuyến Payoo</span>
                    </span>
                </label>
            </div>


        </div>

        <div class="modal-footer justify-content-end gap-2 p-3">
             <button type="button" class="btn-cancel" onclick="document.getElementById('payment-method-modal').style.display='none'">Hủy</button>
             <button type="button" class="btn-confirm" onclick="document.getElementById('payment-method-modal').style.display='none'">Tiếp tục</button>
        </div>
    </div>
</div>


