<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('admin');
        }
    }
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        $this->AuthLogin();
        return view('admin.admin_dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = FacadesDB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        
        if($result){
            
            session(['admin_id' => $result->admin_id]);
            session(['admin_email' => $result->admin_email]);
            return redirect()->route('dashboard');
        } else {
            
            return redirect()->route('admin')->with('error', 'Email hoặc mật khẩu không đúng');
        }
    }
    
    public function logout(){
        $this->AuthLogin();
        session()->flush();
        return redirect()->route('admin');
    }
}
