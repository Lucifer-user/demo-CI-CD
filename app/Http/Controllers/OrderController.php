<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('admin')->send();
        }
    }
//all đơn hàng
    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('order')
        ->join('customer','order.customer_id','=','customer.customer_id')
        ->join('payment','order.payment_id','=','payment.payment_id')
        ->select('order.*','customer.customer_name','payment.payment_method')
        ->orderBy('order.order_id','desc')
        ->get();
        $manager_order_view = view('admin.manage_order')
        ->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order_view);
    }
    //chi tiết đơn hàng
    public function view_order($orderId){
        $this->AuthLogin();
        
        $order_details = DB::table('orderdetails')->where('order_id',$orderId)->get();
        
      
        $order = DB::table('order')
            ->join('customer','order.customer_id','=','customer.customer_id')
            ->join('shopping','order.shopping_id','=','shopping.shopping_id')
            ->join('payment','order.payment_id','=','payment.payment_id')
            ->where('order.order_id',$orderId)
            ->select('order.*','customer.*','shopping.*','payment.*')
            ->first();

        $manager_order_view = view('admin.view_order')
            ->with('order_by_id',$order) 
            ->with('order_details',$order_details);
            
        return view('admin_layout')->with('admin.view_order',$manager_order_view);
    }
    public function delete_order($orderId){
        $this->AuthLogin();
        // xóa chi tiết đơn hàng
        DB::table('orderdetails')->where('order_id',$orderId)->delete();
        // xóa đơn hàng
        DB::table('order')->where('order_id',$orderId)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return redirect()->back();
    }
}
