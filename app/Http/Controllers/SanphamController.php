<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
class SanphamController extends Controller
{
      public function add_sanpham()
    {
        $cate_product = DB::table('category')->orderby('id', 'desc')->get();
        $brand_product = DB::table('brand')->orderby('brand_id', 'desc')->get();
        return view('admin.add_sanpham')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_sanpham()
    {
        $all_sanpham = DB::table('sanpham')
        ->join('category','category.id','=','sanpham.id')
        ->join('brand','brand.brand_id','=','sanpham.brand_id')
        ->select('sanpham.*', 'category.category_name', 'brand.brand_name')
        ->orderby('sanpham.id','desc')->get();
        return view('admin.all_sanpham')->with('all_sanpham',$all_sanpham);
    }
    public function save_sanpham(Request $request)
    {
        $data = [];
        $data['product_name'] = $request->product_name;
        $data['brand_id'] = $request->brand_id;
        $data['id'] = $request->category_id;
        $data['product_price'] = $request->product_price;
        $data['product_sale_price'] = $request->product_sale_price;
        $data['product_stock'] = $request->product_stock;
        $data['product_status'] = $request->product_status;
        $data['product_description'] = $request->product_description;
        $data['product_ingredient'] = $request->product_ingredient;
        $data['product_weight'] = $request->product_weight;
        $data['product_origin'] = $request->product_origin;
        $data['product_expiry'] = $request->product_expiry;
        $data['product_usage'] = $request->product_usage;
        
        $get_images = $request->file('product_image');
        
        if($get_images){
           $new_image = uniqid() . '.' . $get_images->getClientOriginalExtension();
           $get_images->move(public_path('uploads/product'), $new_image);
           $data['product_image'] = $new_image;
        } else {
            $data['product_image'] = '';
        }

        $product_id = DB::table('sanpham')->insertGetId($data, 'product_id');

      //anh chi tiết
        if($request->hasFile('product_gallery')){
            $gallery_images = $request->file('product_gallery');
            foreach($gallery_images as $image){
                $new_gallery_name = uniqid() . '_' . rand(1, 1000) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), $new_gallery_name);
                
                DB::table('anh_chitiet')->insert([
                    'product_id' => $product_id,
                    'image' => $new_gallery_name,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
//thuộc tính/thông số kỹ thuật
        if ($request->has('specifications')) {
            $specs = $request->specifications;
            foreach ($specs as $attr_id => $attr_value) {
                if ($attr_value !== null) {
                    $attribute = DB::table('category_attributes')
                        ->where('id', $attr_id)
                        ->first();

                    if ($attribute) {
                        DB::table('product_attribute_values')->insert([
                            'product_id' => $product_id,
                            'category_attribute_id' => $attribute->id,
                            'value' => $attr_value,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        }

        Session::put('message', 'Thêm sản phẩm thành công');
        return redirect()->back();
    }
//sửa sản phẩm admin
    public function edit_sanpham($sanpham_id)
    {
         $cate_product = DB::table('category')->orderby('id', 'desc')->get();
        $brand_product = DB::table('brand')->orderby('brand_id', 'desc')->get();
        $edit_sanpham = DB::table('sanpham')->where('product_id', $sanpham_id)->first();
        
        // thông số kỹ thuật
        $existing_attributes = DB::table('product_attribute_values')
            ->join('category_attributes', 'category_attributes.id', '=', 'product_attribute_values.category_attribute_id')
            ->where('product_attribute_values.product_id', $sanpham_id)
            ->select('category_attributes.id as attribute_id', 'product_attribute_values.value')
            ->get();
            
        return view('admin.edit_sanpham')
            ->with('edit_sanpham', $edit_sanpham)
            ->with('brand_product',$brand_product)
            ->with('cate_product',$cate_product)
            ->with('existing_attributes', $existing_attributes);
    }

    public function update_sanpham(Request $request, $sanpham_id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['brand_id'] = $request->brand_id;
        $data['id'] = $request->category_id;
        $data['product_price'] = $request->product_price;
        $data['product_sale_price'] = $request->product_sale_price;
        $data['product_stock'] = $request->product_stock;
        $data['product_status'] = $request->product_status ?? 0;
        $data['product_description'] = $request->product_description;
        $data['product_ingredient'] = $request->product_ingredient;
        $data['product_weight'] = $request->product_weight;
        $data['product_origin'] = $request->product_origin;
        $data['product_expiry'] = $request->product_expiry;
        $data['product_usage'] = $request->product_usage;
        
        $get_images = $request->file('product_image');
        if($get_images){
            $new_image = time().rand(0,99).'.'.$get_images->getClientOriginalExtension();
            $get_images->move(public_path('uploads/product'), $new_image);
            $data['product_image'] = $new_image;
        }
        
        DB::table('sanpham')->where('product_id', $sanpham_id)->update($data);

        if ($request->has('specifications')) {
            
            DB::table('product_attribute_values')->where('product_id', $sanpham_id)->delete();

            $specs = $request->specifications;
            foreach ($specs as $attr_id => $attr_value) {
                if ($attr_value !== null) {
                    $attribute = DB::table('category_attributes')
                        ->where('id', $attr_id)
                        ->first();

                    if ($attribute) {
                        DB::table('product_attribute_values')->insert([
                            'product_id' => $sanpham_id,
                            'category_attribute_id' => $attribute->id,
                            'value' => $attr_value,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        }

        Session::put('message', 'Cập nhật sản phẩm thành công');
        return redirect()->back();
    }

    public function unactive_sanpham($sanpham_id){
        DB::table('sanpham')->where('product_id',$sanpham_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return redirect()->back();
    }
    public function active_sanpham($sanpham_id){
        DB::table('sanpham')->where('product_id',$sanpham_id)->update(['product_status'=>0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return redirect()->back();
    }
    public function delete_sanpham($sanpham_id){
        DB::table('sanpham')->where('product_id',$sanpham_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return redirect()->back();
    }

    //end admin

    // chi tiết sản phẩm
    public function product_details($product_id)
    {

    $cate_product = DB::table('category')->where('category_satus', '1')->orderby('id', 'desc')->get(); 
    $brand_product = DB::table('brand')->where('brand_satus', '1')->orderby('brand_id', 'desc')->get();

    $product_details = DB::table('sanpham')
        ->join('category', 'category.id', '=', 'sanpham.id')
        ->leftJoin('brand', 'brand.brand_id', '=', 'sanpham.brand_id')
        ->where('sanpham.product_id', $product_id)
        ->select('sanpham.*', 'category.category_name', 'brand.brand_name', 'brand.brand_id', 'sanpham.id as real_category_id')
        ->get(); 

    $category_id = null;
    foreach($product_details as $key => $value){
        $category_id = $value->real_category_id;
        $product_id = $value->product_id;
    }

    $related_products = [];
    if($category_id) {
        $related_products = DB::table('sanpham')
            ->join('category', 'category.id', '=', 'sanpham.id')
            ->leftJoin('brand', 'brand.brand_id', '=', 'sanpham.brand_id')
            ->where('sanpham.id', $category_id) 
            ->whereNotIn('sanpham.product_id', [$product_id]) 
            ->get();
    }

    $gallery_images = DB::table('anh_chitiet')->where('product_id', $product_id)->get();

    // thuoc tinh
    $product_attributes = DB::table('product_attribute_values')
        ->join('category_attributes', 'category_attributes.id', '=', 'product_attribute_values.category_attribute_id')
        ->where('product_attribute_values.product_id', $product_id)
        ->select('category_attributes.attribute_name', 'product_attribute_values.value')
        ->orderBy('category_attributes.sort_order')
        ->get();

    return view('pages.sanpham.chitiet_sanpham')
        ->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product)
        ->with('product_details', $product_details) 
        ->with('related_products', $related_products)
        ->with('gallery_images', $gallery_images)
        ->with('product_attributes', $product_attributes);
    }
}
