<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('category')->where('category_satus','1')->orderby('id','desc')->get(); 
        $brand_product = DB::table('brand')->where('brand_satus','1')->orderby('brand_id','desc')->get(); 

        $all_product = DB::table('sanpham')->where('product_status','0')->orderby('product_id','desc')->limit(6)->get(); 

        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }

    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('category')->where('category_satus','1')->orderby('id','desc')->get(); 
        $brand_product = DB::table('brand')->where('brand_satus','1')->orderby('brand_id','desc')->get(); 

        $search_product = DB::table('sanpham')->where('product_name','like','%'.$keywords.'%')->get(); 

        return view('pages.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }

    public function product(Request $request)
{
 
    $cate_product = DB::table('category')->where('category_satus', '1')->orderby('id', 'desc')->get(); 
    $brand_product = DB::table('brand')->where('brand_satus', '1')->orderby('brand_id', 'desc')->get();

    
    
    $query = DB::table('sanpham')
        ->join('brand', 'brand.brand_id', '=', 'sanpham.brand_id') 
        ->where('product_status', '0');

   
    if ($request->sort_by) {
        $sort_by = $request->sort_by;
        if ($sort_by == 'price_asc') {
            $query->orderby('product_price', 'asc');
        } elseif ($sort_by == 'price_desc') {
            $query->orderby('product_price', 'desc');
        } elseif ($sort_by == 'newest') {
             $query->orderby('product_id', 'desc');
        }
    } else {
        $query->orderby('product_id', 'desc');
    }

    if ($request->brand) {
        $brand_ids = $request->brand; 
        $query->whereIn('sanpham.brand_id', $brand_ids);
    }
    if ($request->category) {
        $category_ids = $request->category;
        $query->whereIn('sanpham.id', $category_ids);
    }
    if ($request->price) {
        $price = $request->price;
        switch ($price) {
            case '1': // Dưới 100k
                $query->where('product_price', '<', 100000);
                break;
            case '2': // 100k - 500k
                $query->whereBetween('product_price', [100000, 500000]);
                break;
            case '3': // 500k - 1tr
                $query->whereBetween('product_price', [500000, 1000000]);
                break;
            case '4': // Trên 1tr
                $query->where('product_price', '>', 1000000);
                break;
        }
    }

    
    $all_sanpham = $query->paginate(20)->appends($request->query());

    return view('pages.product')
        ->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product)
        ->with('all_sanpham', $all_sanpham);
}
    public function show_brand_home($brand_id){
        $cate_product = DB::table('category')->where('category_satus','1')->orderby('id','desc')->get(); 
        $brand_product = DB::table('brand')->where('brand_satus','1')->orderby('brand_id','desc')->get(); 

        $brand_by_id = DB::table('sanpham')
        ->join('brand','brand.brand_id','=','sanpham.brand_id')
        ->where('sanpham.brand_id',$brand_id)
        ->get();

        $brand_name = DB::table('brand')->where('brand_id',$brand_id)->limit(1)->get();

        return view('pages.sanpham.thuonghieu_sanpham_home')
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product)
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name);
    }
}
