<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;

class Authenticate extends BaseAuthenticate
{
    protected function redirectTo($request)
   {
    if (! $request->expectsJson()) {
        abort(response()->json([
            'message' => 'Unauthorized'
        ], 401));
    }
   }

}