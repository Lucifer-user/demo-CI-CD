<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem admin_id có trong session không
        if(!session()->has('admin_id')){
            return redirect()->route('admin')->with('error', 'Bạn phải đăng nhập trước');
        }
        return $next($request);
    }
}
