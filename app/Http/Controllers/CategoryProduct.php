<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
class CategoryProduct extends Controller
{
    public function add_category()
    {
        return view('admin.add_category_product');
    }
    public function all_category_product()
    {
        $all_category_product = DB::table('category')->paginate(5);
        return view('admin.all_category_product')->with('all_category_product', $all_category_product);
    }
     public function save_category(Request $request)
    {
        $data = [];
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->categoryDescription;
        
        $data['category_satus'] = $request->category_product_status;

        $data['category_sl'] = Str::slug($request->category_product_name ?: '');
        $data['ngay_tao'] = now();

        DB::table('category')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return redirect()->route('admin.all_category_product');
    }

    public function edit_category_product($category_product_id)
    {
        $edit_category_product = DB::table('category')->where('id', $category_product_id)->first();
        return view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
    }

    public function update_category_product(Request $request, $category_product_id)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->categoryDescription;
        $data['category_satus'] = $request->category_product_status;
        $data['category_sl'] = Str::slug($request->category_product_name ?: '');
        
        DB::table('category')->where('id', $category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return redirect()->route('admin.all_category_product');
    }

    public function delete_category_product($category_product_id)
    {
        DB::table('category')->where('id', $category_product_id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return redirect()->back();
    }
    // kết thúc admin


    //danh mục sản phẩm trang chủ
    public function category_home($category_id)
{
  
    $cate_product = DB::table('category')->where('category_satus', '1')->orderby('id', 'desc')->get(); 
    $brand_product = DB::table('brand')->where('brand_satus', '0')->orderby('brand_id', 'desc')->get();

    
    $category_by_id = DB::table('sanpham')
        
       
        ->join('category', 'sanpham.id', '=', 'category.id') 
        
        ->join('brand', 'sanpham.brand_id', '=', 'brand.brand_id') 

      
        ->where('sanpham.id', $category_id)

        ->select('sanpham.*', 'brand.brand_name', 'category.category_name')
        ->get();

    
    $category_name = DB::table('category')->where('id', $category_id)->limit(1)->get();

    return view('pages.sanpham.danhmuc_sanpham_home')
        ->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product)
        ->with('category_by_id', $category_by_id) 
        ->with('category_name', $category_name);   
}
}



