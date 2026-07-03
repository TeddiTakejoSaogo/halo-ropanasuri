<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class AdminLoginProtection
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        $expectedPath = Config::get('admin.login_path', 'admin-login');
        
        // Cek apakah URL mengandung secret
        if (!str_contains($path, $expectedPath)) {
            abort(404);
        }
        
        // Cek referer untuk mencegah direct access dari luar
        if ($request->isMethod('get') && !$request->session()->has('url.intended')) {
            $referer = $request->headers->get('referer');
            if (!$referer || !str_contains($referer, $request->getHost())) {
                // Allow direct access untuk testing, tapi log untuk monitoring
                Log::info('Admin login accessed directly', [
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent()
                ]);
            }
        }
        
        return $next($request);
    }
}