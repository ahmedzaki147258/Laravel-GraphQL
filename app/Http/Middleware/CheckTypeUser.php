<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTypeUser
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userType = $request->header('userType');
        if (!$userType) {
            return $this->apiResponse((object)[], 'userType not provided', 203);
        } elseif (!in_array($userType, ['user', 'admin', 'manager'])) {
            return $this->apiResponse((object)[], 'Invalid userType value (user, admin, manager)', 203);
        }
        return $next($request);
    }
}
