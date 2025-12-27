<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
use Cart;
class CheckOutController extends Controller
{
    public function login_checkout()
    {
        return view('pages.checkout.login_checkout');
    }
    public function add_customer(Request $request)
    {
        $data=array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['customer_password']=$request->customer_password;
        
        $customer_id=DB::table('customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->customer_name);
        return redirect('/login-checkout');
    }
    //hàm đăng nhập
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = $request->password_account;
        $result = DB::table('customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        
        if($result){
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$result->customer_name);
            
            // Lấy thông tin shipping mới nhất của khách hàng này
            $shipping = DB::table('shopping')
                ->where('customer_id', $result->customer_id)
                ->orderBy('shopping_id', 'desc')
                ->first();
            
            if($shipping){
                Session::put('shopping_id', $shipping->shopping_id);
                Session::put('shopping_name', $shipping->shopping_name);
            }

            return redirect()->route('show_cart');
        }else{
            return redirect('/login-checkout');
        }
    }

    
    //hàm thông tin địa chỉ
    public function save_checkout(Request $request)
    {
      $request->validate([
        'shopping_name'=>'required',
        'shopping_phone'=>'required',
        'shopping_city'=>'required',
        'shopping_province'=>'required',
        'shopping_wards'=>'required',
        'shopping_address'=>'required',
      ],[
        'shopping_name.required'=>'Vui lòng nhập tên người nhận',
        'shopping_phone.required'=>'Vui lòng nhập số điện thoại',
        'shopping_city.required'=>'Vui lòng chọn thành phố',
        'shopping_province.required'=>'Vui lòng chọn quận',
        'shopping_wards.required'=>'Vui lòng chọn phường',
        'shopping_address.required'=>'Vui lòng nhập địa chỉ',
      ]);
      $data=array();

      $data['shopping_name']=$request->shopping_name;
      $data['shopping_phone']=$request->shopping_phone;
      $data['shopping_city']=$request->shopping_city;
      $data['shopping_province']=$request->shopping_province;
      $data['shopping_wards']=$request->shopping_wards;
      $data['shopping_address']=$request->shopping_address;
      $data['customer_id']=$request->customer_id;
      
      $data['customer_id']=Session::get('customer_id');

      $shopping_id=DB::table('shopping')->insertGetId($data);
      Session::put('shopping_id',$shopping_id);
      Session::put('shopping_name',$request->shopping_name);
      Session::put('shopping_name',$request->shopping_name);
      return redirect()->route('payment');
    }
//hàm thanh toán
    public function payment()
    {
        return view('pages.cart.payment');
    }
    //hàm đăng xuất
    public function logout_checkout(){
  
    Session::flush(); 
    return redirect('/login-checkout');
    }

    //hàm đặt hàng
    public function order_place(Request $request){
        // 1. Get payment method from request
        $payment_option = $request->payment_option;

        // Check if shopping_id exists in session, if not redirect to checkout to re-enter address
        if(!Session::get('shopping_id')){
            return redirect('/payment');
        }

        // 2. Insert into 'payment' table
        $data = array();
        $data['payment_method'] = $payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('payment')->insertGetId($data);

        // 3. Insert into 'order' table
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shopping_id'] = Session::get('shopping_id');
        $order_data['payment_id'] = $payment_id;
        // Clean the total string (remove dots/commas) because Cart::total() returns string like "1.200.000"
        $total_string = Cart::total(0, '', ''); 
        $order_data['order_total'] = (float)$total_string; 

        $order_data['order_status'] = 'Đang chờ xử lý';
       
        $order_id = DB::table('order')->insertGetId($order_data);

        // 4. Insert into 'orderdetails' table
        $content = Cart::content();
        foreach($content as $v_content){
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content->id;
            $order_details_data['product_name'] = $v_content->name;
            $order_details_data['product_price'] = $v_content->price;
            $order_details_data['product_sales_quantity'] = $v_content->qty;
            
            DB::table('orderdetails')->insert($order_details_data);
        }

        
        if($payment_option == 1){
           
            Cart::destroy();
            return view('pages.checkout.handcash'); 
        } elseif($payment_option == 2){
           
            Cart::destroy();
            return view('pages.checkout.handcash'); 
        } else {
            
            Cart::destroy();
            return view('pages.checkout.handcash');
        }
    }
   
   
    public function select_address(Request $request){
        $shopping_id = $request->selected_shopping_id;
        if($shopping_id){
            Session::put('shopping_id', $shopping_id);
            
            $addr = DB::table('shopping')->where('shopping_id', $shopping_id)->first();
            if($addr){
                Session::put('shopping_name', $addr->shopping_name);
            }
        }
        return redirect()->back();
    }
}
