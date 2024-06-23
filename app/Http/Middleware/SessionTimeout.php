<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
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
        if (Auth::check()) {
            $lastActivity = auth()->user()->last_activity;
            if ($lastActivity && now()->diffInMinutes($lastActivity) > 120) {
                Auth::logout(); // Logout user if inactive for 2 minutes
                return redirect()->route('login')->with('error', 'Your session has expired. Please log in again.');
            }
            auth()->user()->update(['last_activity' => now()]); // Update last activity timestamp
        }
        
        return $next($request);
    }
}
