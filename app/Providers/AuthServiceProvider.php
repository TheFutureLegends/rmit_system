<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Modules\Backend\Events\Models\Events;
use App\Modules\Backend\Clubs\Policies\ClubPolicy;
use App\Modules\Backend\Events\Policies\EventPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Events::class => EventPolicy::class,
        Clubs::class => ClubPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
