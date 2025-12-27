
<!-- Address Selection Modal -->
<div id="address-selection-modal" class="modal-overlay" style="display: none;">
    <div class="modal-container" style="max-width: 600px;">
        <div class="modal-header">
            <h3>Địa chỉ nhận hàng</h3>
            <span class="close-btn" onclick="document.getElementById('address-selection-modal').style.display='none'">&times;</span>
        </div>
        
        <form action="{{ URL::to('/select-address') }}" method="POST" id="address-selection-form">
            @csrf
            <div class="modal-body" style="padding: 0;">
                <?php 
                    $customer_id = Session::get('customer_id');
                    $current_shopping_id = Session::get('shopping_id');
                    // Get all addresses for this customer
                    $addresses = DB::table('shopping')->where('customer_id', $customer_id)->get();
                ?>
                @if($addresses->count() > 0)
                    @foreach($addresses as $addr)
                    <div class="address-item {{ $addr->shopping_id == $current_shopping_id ? 'selected' : '' }}">
                        <div class="address-radio">
                            <input type="radio" name="selected_shopping_id" value="{{ $addr->shopping_id }}" {{ $addr->shopping_id == $current_shopping_id ? 'checked' : '' }}>
                        </div>
                        <div class="address-content">
                            <div class="address-row-header">
                                <span class="name-phone">{{ $addr->shopping_name }} - {{ $addr->shopping_phone }}</span>
                                <div class="address-actions">
                                    <!-- Optional: Add delete/edit logic later -->
                                    <!-- <span class="material-symbols-outlined action-icon">delete</span> -->
                                </div>
                            </div>
                            <p class="address-text">{{ $addr->shopping_address }}, {{ $addr->shopping_wards }}, {{ $addr->shopping_province }}, {{ $addr->shopping_city }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div style="padding: 20px; text-align: center; color: #888;">
                        Chưa có địa chỉ nào. Vui lòng thêm địa chỉ mới.
                    </div>
                @endif
            </div>

            <div class="modal-footer justify-content-between align-items-center pt-3 pb-3">
                 <div class="add-new-address" style="cursor: pointer; color: #277b57; font-weight: 600; display: flex; align-items: center; gap: 5px;" onclick="window.location.href='{{ URL::to('/checkout') }}'">
                      <span class="material-symbols-outlined">add_box</span> Thêm địa chỉ mới
                 </div>
                 <div class="modal-actions gap-2 d-flex">
                     <button type="button" class="btn-cancel" onclick="document.getElementById('address-selection-modal').style.display='none'">Hủy</button>
                     <button type="submit" class="btn-confirm">Tiếp tục</button>
                 </div>
            </div>
        </form>
    </div>
</div>
