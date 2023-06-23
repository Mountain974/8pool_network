<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model'=>'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        // Gate::define('update-post', function(User $user){    Autre façon de vérifier si c'est un admin
        //     return $user->isAdmin();
        // });
    }
}
