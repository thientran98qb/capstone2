<?php

namespace App\Providers;

use App\Comment;
use App\Policies\CommentPolicy;
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
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('category-list',function($user){
            return $user->checkPermissions(config('permissions.access.list-category'));
        });
        Gate::define('access-staff', function ($user) {
            return $user->checkRole('staff');
        });
    }
}