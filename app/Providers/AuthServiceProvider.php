<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isModir', function($user) {
            return $user->role_id == 1;
        });
        Gate::define('isDaftar', function($user) {
            return $user->role_id == 2;
        });
        Gate::define('isForoshEjare', function($user) {
            return $user->role_id == 3;
        });
        Gate::define('isForosh', function($user) {
            return $user->role_id == 4;
        });
        Gate::define('isEjare', function($user) {
            return $user->role_id == 5;
        });
        Gate::define('isMoshaverMajazy', function($user) {
            return $user->role_id == 6;
        });
    }
}
