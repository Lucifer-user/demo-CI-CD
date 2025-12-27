<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryAttributeSeeder extends Seeder
{
    /**
     * Seed dữ liệu mẫu cho category_attributes
     * Các thuộc tính động cho từng loại danh mục sản phẩm mỹ phẩm
     */
    public function run()
    {
        // Lấy danh sách category từ database
        $categories = DB::table('category')->get();
        
        // Định nghĩa attributes cho từng loại danh mục
        $attributesByCategory = [
            // Son môi
            'Son' => [
                ['attribute_name' => 'Màu sắc', 'attribute_type' => 'select', 'options' => ['Đỏ', 'Cam', 'Hồng', 'Nude', 'Đỏ Cam', 'Hồng Đất', 'Nâu'], 'is_required' => true, 'sort_order' => 1],
                ['attribute_name' => 'Chất son', 'attribute_type' => 'select', 'options' => ['Matte (Lì)', 'Dưỡng', 'Bóng', 'Velvet', 'Ombre'], 'is_required' => true, 'sort_order' => 2],
                ['attribute_name' => 'Quy cách', 'attribute_type' => 'select', 'options' => ['Thỏi', 'Tuýp', 'Dạng lỏng'], 'is_required' => false, 'sort_order' => 3],
            ],
            // Sữa tắm
            'Sữa tắm' => [
                ['attribute_name' => 'Dung tích', 'attribute_type' => 'text', 'options' => null, 'is_required' => true, 'sort_order' => 1],
                ['attribute_name' => 'Mùi hương', 'attribute_type' => 'text', 'options' => null, 'is_required' => false, 'sort_order' => 2],
                ['attribute_name' => 'Loại da phù hợp', 'attribute_type' => 'select', 'options' => ['Mọi loại da', 'Da khô', 'Da dầu', 'Da nhạy cảm', 'Da hỗn hợp'], 'is_required' => false, 'sort_order' => 3],
            ],
            // Bột giặt / Chất tẩy rửa
            'Bột giặt' => [
                ['attribute_name' => 'Trọng lượng', 'attribute_type' => 'text', 'options' => null, 'is_required' => true, 'sort_order' => 1],
                ['attribute_name' => 'Dạng', 'attribute_type' => 'select', 'options' => ['Bột', 'Nước', 'Viên'], 'is_required' => false, 'sort_order' => 2],
            ],
            // Kem dưỡng da
            'Kem dưỡng' => [
                ['attribute_name' => 'Dung tích', 'attribute_type' => 'text', 'options' => null, 'is_required' => true, 'sort_order' => 1],
                ['attribute_name' => 'Loại da', 'attribute_type' => 'select', 'options' => ['Mọi loại da', 'Da khô', 'Da dầu', 'Da hỗn hợp', 'Da nhạy cảm'], 'is_required' => false, 'sort_order' => 2],
                ['attribute_name' => 'Công dụng chính', 'attribute_type' => 'select', 'options' => ['Dưỡng ẩm', 'Chống lão hóa', 'Trị mụn', 'Trắng da', 'Chống nắng'], 'is_required' => false, 'sort_order' => 3],
            ],
            // Nước hoa
            'Nước hoa' => [
                ['attribute_name' => 'Dung tích', 'attribute_type' => 'text', 'options' => null, 'is_required' => true, 'sort_order' => 1],
                ['attribute_name' => 'Nhóm hương', 'attribute_type' => 'select', 'options' => ['Hoa cỏ', 'Trái cây', 'Gỗ', 'Oriental', 'Tươi mát', 'Biển'], 'is_required' => false, 'sort_order' => 2],
                ['attribute_name' => 'Độ lưu hương', 'attribute_type' => 'select', 'options' => ['2-4 tiếng', '4-6 tiếng', '6-8 tiếng', '8-12 tiếng', 'Trên 12 tiếng'], 'is_required' => false, 'sort_order' => 3],
            ],
            // Dầu gội
            'Dầu gội' => [
                ['attribute_name' => 'Dung tích', 'attribute_type' => 'text', 'options' => null, 'is_required' => true, 'sort_order' => 1],
                ['attribute_name' => 'Loại tóc', 'attribute_type' => 'select', 'options' => ['Mọi loại tóc', 'Tóc khô', 'Tóc dầu', 'Tóc nhuộm', 'Tóc hư tổn'], 'is_required' => false, 'sort_order' => 2],
                ['attribute_name' => 'Công dụng', 'attribute_type' => 'select', 'options' => ['Dưỡng ẩm', 'Trị gàu', 'Chống rụng', 'Suôn mượt', 'Phục hồi'], 'is_required' => false, 'sort_order' => 3],
            ],
        ];

        foreach ($categories as $category) {
            $categoryName = $category->category_name;
            
            // Tìm attributes phù hợp dựa trên tên danh mục
            $matchedAttributes = null;
            foreach ($attributesByCategory as $key => $attrs) {
                if (stripos($categoryName, $key) !== false) {
                    $matchedAttributes = $attrs;
                    break;
                }
            }

            if ($matchedAttributes) {
                foreach ($matchedAttributes as $attr) {
                    DB::table('category_attributes')->insert([
                        'category_id' => $category->id,
                        'attribute_name' => $attr['attribute_name'],
                        'attribute_type' => $attr['attribute_type'],
                        'is_required' => $attr['is_required'],
                        'options' => $attr['options'] ? json_encode($attr['options'], JSON_UNESCAPED_UNICODE) : null,
                        'sort_order' => $attr['sort_order'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
