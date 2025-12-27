<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
class BrandController extends Controller
{
     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('admin');
        }
    }
     public function add_brand()
    {
        
        return view('admin.add_brand');
    }
    public function all_brand()
    {
        $all_brand = DB::table('brand')->paginate(5);
        return view('admin.all_brand')->with('all_brand', $all_brand);
    }
    public function save_brand(Request $request)
    {
        \Illuminate\Support\Facades\Log::info($request->all());
        $data = [];
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_satus'] = $request->brand_satus;

        $get_image = $request->file('brand_image');
        if($get_image){
            $new_image = time().rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move(public_path('uploads/brand'), $new_image);
            $data['brand_image'] = $new_image;
        }

        DB::table('brand')->insert($data);
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return redirect()->route('admin.all_brand');
    }

    public function edit_brand($brand_id)
    {
        $edit_brand = DB::table('brand')->where('brand_id', $brand_id)->first();
        return view('admin.edit_brand')->with('edit_brand', $edit_brand);
    }

    public function update_brand(Request $request, $brand_id)
    {
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_satus'] = $request->brand_satus;
        
        
        DB::table('brand')->where('brand_id', $brand_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return redirect()->route('admin.all_brand');
    }

    public function delete_brand($brand_id)
    {
        DB::table('brand')->where('brand_id', $brand_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return redirect()->back();
    }
    //end admin

    //Thuonghieu
public function brand_home($brand_id)
{
    
    $cate_product = DB::table('category')->where('category_satus', '0')->orderby('id', 'desc')->get(); 
    $brand_product = DB::table('brand')->where('brand_satus', '1')->orderby('brand_id', 'desc')->get();

    
    $brand_by_id = DB::table('sanpham')
        
        ->join('category', 'sanpham.id', '=', 'category.id') 
        
        ->join('brand', 'sanpham.brand_id', '=', 'brand.brand_id')
        
        ->where('sanpham.brand_id', $brand_id) 
        
        ->select('sanpham.*', 'brand.brand_name', 'category.category_name')
        ->get();

  
    $brand_name = DB::table('brand')->where('brand_id', $brand_id)->limit(1)->get();

    return view('pages.sanpham.thuonghieu_sanpham_home')
        ->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product)
        ->with('brand_by_id', $brand_by_id) 
        ->with('brand_name', $brand_name);   
}
}
