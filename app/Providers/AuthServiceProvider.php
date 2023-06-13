<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $ttl = 60 * 60 * 24; // 1 day
        $roles = Cache::remember('roles', $ttl, fn () => Role::all());

        foreach ($roles as $role) {
            Gate::define($role->slug, fn (User $user) => $user->role_id == $role->id);
        }
    }
}
