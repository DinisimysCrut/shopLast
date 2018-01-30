<?php

namespace App\Http\Middleware;

use Basket;
use Closure;

class IsBasket
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
        if(!Basket::is()) {
            return redirect()->route('public.basket.show');
        }

        return $next($request);
    }
}
