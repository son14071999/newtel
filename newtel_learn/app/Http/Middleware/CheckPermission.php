<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permit = null)
    {

        $user = Auth::user();
        return response()->json([
            'user' => $user
        ], 200);
        $userId = $request->header('userId');
        if ($user = User::find($userId)
        ) {
            if(($role = $user->role)
            && ($permits = $role->permissions)){
                foreach ($permits as $p) {
                    if ($p->code == $permit) {
                        return $next($request);
                    }
                }
            }
            return response()->json([
                'message' => 'Bạn không có quyền',
                'permit' => $permit,
                'user' => $user,
                'auth' => Auth::check()
            ], 402);
        }
        return response()->json([
            'message' => 'Bạn chưa đăng nhập',
            'auth' => Auth::check()
        ], 401);

    }
}
