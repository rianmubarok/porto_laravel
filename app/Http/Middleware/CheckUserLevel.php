<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user tidak login, redirect ke home dengan pesan
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.');
        }

        $user = Auth::user();
        
        // Cek apakah user punya level Admin
        if ($user->hasLevel('Admin')) {
            // Admin bisa akses semua halaman
            return $next($request);
        }
        
        // Jika user biasa (User level), cek halaman yang diakses
        if ($user->hasLevel('User')) {
            $currentRoute = $request->route()->getName();
            
            // Daftar route yang hanya bisa diakses Admin
            $adminOnlyRoutes = [
                'project-management.index',
                'project-management.create',
                'project-management.store',
                'project-management.edit',
                'project-management.update',
                'project-management.destroy',
                'project-management.delete-image',
                'project-management.reorder-images',
                'test-upload.index',
                'test-upload.upload',
                'test-upload.delete'
            ];
            
            // Jika user mencoba akses halaman admin, redirect ke home
            if (in_array($currentRoute, $adminOnlyRoutes)) {
                return redirect()->route('home')->with('error', 'Maaf, Anda tidak memiliki akses ke halaman tersebut. Hanya Admin yang dapat mengakses fitur ini.');
            }
            
            // User biasa bisa akses halaman publik
            return $next($request);
        }
        
        // Jika user tidak punya level apapun, redirect ke home
        return redirect()->route('home')->with('error', 'Level akses tidak valid. Silakan hubungi administrator.');
    }
}
