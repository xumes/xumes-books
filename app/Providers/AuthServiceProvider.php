<?php

namespace CodePub\Providers;

use CodePub\Models\Book;
use CodePub\Models\Permission;
use CodePub\Models\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'CodePub\Model' => 'CodePub\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        foreach($this->getPermissions() as $permission) {
            $gate->define($permission->name, function($user) use($permission) {
                return $user->hasRole($permission->roles) || $user->isAdmin();
            });
        }
    }

    public function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
