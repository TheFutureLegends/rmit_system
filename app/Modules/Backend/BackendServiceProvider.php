<?php

namespace App\Modules\Backend;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use App\Modules\Backend\Clubs\Repositories\ClubRepository;
use App\Modules\Backend\Users\Repositories\UserRepository;
use App\Modules\Backend\Roles\Repositories\RolesRepository;
use App\Modules\Backend\Events\Repositories\EventRepository;
use App\Modules\Backend\Clubs\Repositories\ClubRepositoryInterface;
use App\Modules\Backend\Users\Repositories\UserRepositoryInterface;
use App\Modules\Backend\Roles\Repositories\RolesRepositoryInterface;
use App\Modules\Backend\Events\Repositories\EventRepositoryInterface;
use App\Modules\Backend\Permissions\Repositories\PermissionsRepository;
use App\Modules\Backend\Permissions\Repositories\PermissionsRepositoryInterface;

class BackendServiceProvider extends ServiceProvider {
    public function boot(){
        $listModule = array_map('basename', File::directories(__DIR__));
        foreach ($listModule as $module) {
            // register routes
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }
            // boot Views
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
            // boot Migration
            if(is_dir(__DIR__.'/'.$module.'/Migrations')) {
                $this->loadMigrationsFrom(__DIR__.'/'.$module.'/Migrations', $module);
            }
        }
    }
    public function register(){
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);

        $this->app->bind(ClubRepositoryInterface::class, ClubRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(RolesRepositoryInterface::class, RolesRepository::class);

        $this->app->bind(PermissionsRepositoryInterface::class, PermissionsRepository::class);
    }
}
?>
