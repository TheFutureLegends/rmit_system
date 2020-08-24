<?php

namespace App\Modules\Backend\Permissions\Repositories;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Modules\Backend\Permissions\Repositories\PermissionsRepositoryInterface;

class PermissionsRepository implements PermissionsRepositoryInterface
{
    public function __construct()
    {
        # code...
    }

    public function loadOptions(string $search = null)
    {
        $result = array();

        $opt_group = array();

        if ($search != null) {
            $permissions = Permission::query()
            ->where([
                ['name', 'LIKE', '%'.$search.'%']
            ])
            ->get();
        } else {
            $permissions = Permission::all();
        }

        foreach ($permissions as $key => $permission) {
            $explode = explode(".", $permission->name);

            if (!in_array($explode[0], $opt_group)) {
                array_push($opt_group, $explode[0]);
            }
        }

        foreach ($opt_group as $key => $value) {
            $children = array();

            $groups = Permission::query()->where([
                ['name', 'LIKE', $value . '.%']
            ])->get();

            foreach ($groups as $key => $group) {
                $explode = explode(".", $group->name);

                unset($explode[0]);

                $explode = array_values($explode);

                $string = implode(" ", $explode);

                array_push($children, [
                    'id' => $group->id,
                    'text' => ucwords( $value . " " .$string )
                ]);
            }

            $init['text'] = ucfirst($value);

            $init['children'] = $children;

            array_push($result, $init);
        }

        return $result;
    }

    public function findAllPermissions()
    {
        return Permission::all();
    }

    public function findById($id)
    {
        return Permission::find($id);
    }

    public function findByName($name)
    {
        return Permission::query()
        ->where([
            ['name', '=', $name]
        ])
        ->first();
    }

    public function store(array $request)
    {
        $permission = Permission::create($request);

        $permission->syncRoles($this->role_array($request));

        return true;
    }

    public function update(string $name, array $request)
    {
        $permission = $this->findByName($name);

        $permission->update($request);

        $permission->syncRoles($this->role_array($request));

        return true;
    }

    public function destroy($slug)
    {

    }

    private function role_array(array $request)
    {
        $array = array();

        if (isset($request['roles'])) {
            foreach ($request['roles'] as $key => $value) {
                $role = Role::find($value);

                array_push($array, $role);
            }
        }

        return $array;
    }
}
