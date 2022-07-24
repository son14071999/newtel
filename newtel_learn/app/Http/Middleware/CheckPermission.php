<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Exception;

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
        $userId = $request->header('userId');

        if (($user = User::find($userId))
            && ($permits = $user->role->permissions)
        ) {
            foreach ($permits as $p) {
                if ($p->code == $permit) {
                    return $next($request);
                }
            }
            return response()->json([
                'message' => 'Bạn không có quyền',
                'permit' => $permit,
                'user' => $user,
                'permits' => $permits
            ], 402);
        }
        return response()->json([
            'message' => 'Bạn chưa đăng nhập'
        ], 401);

    }
}
