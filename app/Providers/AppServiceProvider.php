<?php

namespace App\Providers;

use Webpatser\Uuid\Uuid;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Observers\ClubObserver;
use App\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Begin : MySQL Adjustment*/
        Schema::defaultStringLength(191);
        /* End : MySQL Adjustment*/

        /* Begin Spatie: UUID Adjustment */
        Permission::retrieved(function (Permission $permission) {
            $permission->incrementing = false;
        });

        Permission::creating(function (Permission $permission) {
            $permission->incrementing = false;
            $permission->id = Uuid::generate(4)->string;
        });

        Role::retrieved(function (Role $role) {
            $role->incrementing = false;
        });

        Role::creating(function (Role $role) {
            $role->incrementing = false;
            $role->id = Uuid::generate(4)->string;
        });

        Media::retrieved(function (Media $media) {
            $media->incrementing = false;
        });

        Media::creating(function (Media $media) {
            $media->incrementing = false;
            do {
                $media->id = (string) Uuid::generate(4);
            } while ($media->where($media->getKeyName(), $media->id)->first() != null);
        });

        // Activity::retrieved(function (Activity $activity) {
        //     $activity->incrementing = false;
        // });

        // Activity::creating(function (Activity $activity) {
        //     $activity->incrementing = false;
        //     do {
        //         $activity->id = (string) Uuid::generate(4);
        //     } while ($activity->where($activity->getKeyName(), $activity->id)->first() != null);
        // });
        /* End Spatie: UUID Adjustment */

        Clubs::observe(ClubObserver::class);

        User::observe(UserObserver::class);
    }
}
