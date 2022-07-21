<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

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
        if ($user = User::find($userId)) {
            if (($role = $user->role)
                && ($permits = $role->permissions)
            ) {
                foreach ($permits as $p) {
                    if ($p->code == $permit) {
                        return $next($request);
                    }
                }
                return response()->json([
                    'permits' => $permits,
                    'permit' => $permit
                ]);
            }

            return response()->json([
                'message' => 'Bạn không có quyền'
            ], 402);
        }
    }
}
