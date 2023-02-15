<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;

class AuthCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $prevUrl = url()->previous();
        $domain_path = parse_url($prevUrl)['path'];

        if ($domain_path != '/password-reset-page')
        {
            return redirect()->route('login_form');

        }

        return $next($request);
    }
}
