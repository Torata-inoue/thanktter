<?php

namespace App\Http\Middleware;

use App\Domains\User\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLimitedAccess
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/');
        }

        /** @var User $user */
        $user = auth()->guard()->user();
        if ($user->isAdmin() && $this->isAdminIps($request)) {
            return $next($request);
        }

        return redirect('/');
    }

    private function isAdminIps(Request $request): bool
    {
        $admin_ips = explode(',', config('common.admin.ips'));

        return in_array($request->ip(), $admin_ips);
    }
}
