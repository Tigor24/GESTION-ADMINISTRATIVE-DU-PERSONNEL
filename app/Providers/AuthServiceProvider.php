<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log; 
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            Log::info('Role check', ['role' => $user->role]);  // ← Utilise Log directement
            return strtolower(trim($user->role)) === 'admin';
        });

        Gate::define('isRH', function ($user) {
            return $user->role === 'rh';
        });

        Gate::define('isAgent', function ($user) {
            return $user->role === 'agent';
        });
    }
}


