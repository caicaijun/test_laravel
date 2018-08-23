<?php

namespace App\Http\Middleware;

use Closure;

class Admins
{
    /**
     * 运行请求过滤器。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* 判断用户是否登录 */
        if (!session()->has('admin.account')) {
            return redirect('admin/login');
        }
        return $next($request);
    }

}