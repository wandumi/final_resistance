<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class         => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user.index', function($user){
            if($user->permission == 'admin'){
                return true;
            }
        });

        Gate::define('user.create', function($user){
            if($user->permission == 'admin'){
                return true;
            }
        });

        Gate::before(function($user, $ability){
            if($user->permission == 'admin' && in_array($ability, ['edit', 'delete']) ){
                return true;
            };
         });
    }
}
