<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Organization;

class EnsureUserBelongsToOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $organization = $request->route('organization');

        $user = $request->user();

        if (!$organization->users()->where('user_id', $user->id)->exists()) {
            abort(404, 'Organization not found or you do not belong to this organization.');
        }

        return $next($request);
    }
}
