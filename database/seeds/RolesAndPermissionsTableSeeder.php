<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'event.view']);
        Permission::create(['name' => 'event.create']);
        Permission::create(['name' => 'event.update']);
        Permission::create(['name' => 'event.delete']);

        Permission::create(['name' => 'club.view']);
        Permission::create(['name' => 'club.create']);
        Permission::create(['name' => 'club.update']);
        Permission::create(['name' => 'club.delete']);

        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.delete']);

        Role::create(['name' => 'super-admin']);

        $admin = Role::create(['name' => 'admin']);
        $advisor = Role::create(['name' => 'advisor']);
        $president = Role::create(['name' => 'president']);
        $vice_president = Role::create(['name' => 'vice-president']);
        $human_resource = Role::create(['name' => 'human-resource']);
        $member = Role::create(['name' => 'member']);

        $event_permission = Permission::query()->where([
            ['name', 'LIKE', 'event.%']
        ])->get();

        $user_permission = Permission::query()->where([
            ['name', 'LIKE', 'user.%']
        ])->get();

        $admin->syncPermissions(Permission::all());

        $advisor->syncPermissions(Permission::all());

        $president->syncPermissions($event_permission);
        $president->syncPermissions($user_permission);
    }
}
