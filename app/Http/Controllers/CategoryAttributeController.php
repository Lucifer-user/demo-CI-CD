<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\CategoryAttribute;

class CategoryAttributeController extends Controller
{
    /**
     * Hiển thị trang quản lý thuộc tính danh mục
     */
    public function index(Request $request)
    {
        $categories = DB::table('category')->orderby('id', 'desc')->get();
        
        $query = CategoryAttribute::with('category')->orderBy('category_id')->orderBy('sort_order');

        if ($request->has('category_id') && $request->category_id != 'all') {
            $query->where('category_id', $request->category_id);
        }

        $attributes = $query->get();
        
        return view('admin.category_attributes.index', compact('categories', 'attributes'));
    }

    /**
     * Lưu thuộc tính mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'attribute_name' => 'required|string|max:255',
            'attribute_type' => 'required|in:text,select,number',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'attribute_name' => $request->attribute_name,
            'attribute_type' => $request->attribute_type,
            'is_required' => $request->has('is_required') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ];

        // Xử lý options cho select type
        if ($request->attribute_type === 'select' && $request->options) {
            // Chuyển string thành array, mỗi dòng là một option
            $options = array_filter(array_map('trim', explode("\n", $request->options)));
            $data['options'] = json_encode(array_values($options));
        }

        DB::table('category_attributes')->insert($data);
        
        Session::put('message', 'Thêm thuộc tính thành công');
        return redirect()->back();
    }

    /**
     * Form chỉnh sửa thuộc tính
     */
    public function edit($id)
    {
        $categories = DB::table('category')->orderby('id', 'desc')->get();
        $attribute = CategoryAttribute::findOrFail($id);
        $attributes = CategoryAttribute::with('category')->orderBy('category_id')->orderBy('sort_order')->get();
        
        return view('admin.category_attributes.index', compact('categories', 'attributes', 'attribute'));
    }

    /**
     * Cập nhật thuộc tính
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:category,id',
            'attribute_name' => 'required|string|max:255',
            'attribute_type' => 'required|in:text,select,number',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'attribute_name' => $request->attribute_name,
            'attribute_type' => $request->attribute_type,
            'is_required' => $request->has('is_required') ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
        ];

        // Xử lý options cho select type
        if ($request->attribute_type === 'select' && $request->options) {
            $options = array_filter(array_map('trim', explode("\n", $request->options)));
            $data['options'] = json_encode(array_values($options));
        } else {
            $data['options'] = null;
        }

        DB::table('category_attributes')->where('id', $id)->update($data);
        
        Session::put('message', 'Cập nhật thuộc tính thành công');
        return redirect()->route('admin.category_attributes');
    }

    /**
     * Xóa thuộc tính
     */
    public function destroy($id)
    {
        DB::table('category_attributes')->where('id', $id)->delete();
        
        Session::put('message', 'Xóa thuộc tính thành công');
        return redirect()->back();
    }

    /**
     * API: Lấy danh sách thuộc tính theo category_id
     * Được gọi bằng AJAX khi admin chọn danh mục trong form thêm/sửa sản phẩm
     */
    public function getAttributesByCategory($category_id)
    {
        $attributes = CategoryAttribute::where('category_id', $category_id)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($attr) {
                return [
                    'id' => $attr->id,
                    'name' => $attr->attribute_name,
                    'type' => $attr->attribute_type,
                    'required' => $attr->is_required,
                    'options' => $attr->options ?? [],
                ];
            });

        return response()->json($attributes);
    }

    /**
     * API: Lấy giá trị thuộc tính của sản phẩm
     */
    public function getProductAttributes($product_id)
    {
        $attributes = DB::table('product_attribute_values')
            ->join('category_attributes', 'category_attributes.id', '=', 'product_attribute_values.category_attribute_id')
            ->where('product_attribute_values.product_id', $product_id)
            ->select('category_attributes.attribute_name', 'product_attribute_values.value')
            ->orderBy('category_attributes.sort_order')
            ->get();

        return response()->json($attributes);
    }
}
