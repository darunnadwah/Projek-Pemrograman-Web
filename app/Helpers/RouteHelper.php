<?php

namespace App\Helpers;

class RouteHelper
{
    /**
     * Get dashboard route based on user role
     */
    public static function getDashboardRoute()
    {
        if (!auth()->check()) {
            return route('welcome');
        }

        return auth()->user()->role === 'admin' 
            ? route('admin.dashboard') 
            : route('dashboard');
    }
}
