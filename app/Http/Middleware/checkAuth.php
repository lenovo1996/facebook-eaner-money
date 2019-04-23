<?php

namespace App\Http\Middleware;

use Closure;

class checkAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session('access_token', null)) {
            return $next($request);
        }

        if ($request->ajax()) {
	        return response()->json([
		        'result' => false,
		        'msg' => 'Bạn chưa đăng nhập'
	        ]);
        }

		return redirect('login');
    }
}
