<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Nếu chưa đăng nhập, chuyển hướng đến trang login
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    
        // Nếu đã đăng nhập nhưng không phải admin, báo lỗi 403
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập.');
        }
    
        return $next($request);
    }
    

}