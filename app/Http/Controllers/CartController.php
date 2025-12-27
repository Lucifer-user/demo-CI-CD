<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str; 
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function save_cart(Request $request)
    {
         
        $product_id = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info=DB::table('sanpham')
           ->join('brand','brand.brand_id','=','sanpham.brand_id')
           ->where('product_id',$product_id)->first();
        $data['id']=$product_info->product_id;
        $data['name']=$product_info->product_name;
        $data['qty']=$quantity;
        $data['price'] = $product_info->product_price;
        $data['weight'] = 0; 
        $data['options']['product_weight'] = $product_info->product_weight;
        $data['options']['image'] = $product_info->product_image;
        $data['options']['brand_name'] = $product_info->brand_name;
        $data['options']['brand_id'] = $product_info->brand_id;
         
         Cart::add($data);
         return Redirect::to('/show_cart');
        }
       public function show_cart(){
    
        $cate_product = DB::table('category')->where('category_satus', '1')->orderby('id', 'desc')->get(); 
        $brand_product = DB::table('brand')->where('brand_satus', '1')->orderby('brand_id', 'desc')->get();
        $cart = Cart::content();
        return view('pages.cart.show_cart')
            ->with('cate_product', $cate_product)
            ->with('brand_product', $brand_product)
            ->with('cart', $cart); 
        }
        public function update_cart_quantity(Request $request)
        {
    
            $rowId = $request->rowId_cart;
            $qty = $request->cart_qty;
            Cart::update($rowId, $qty);
            return redirect()->back(); 
        }
        public function delete_to_cart($rowId){
            Cart::update($rowId,0);
            return Redirect::to('/show_cart');
        }
}
