<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
    if (\Auth::user()->level == 1) {
      return $next($request);
    }

    return api_response_error('You are not authorized for this endpoint');
  }
}
