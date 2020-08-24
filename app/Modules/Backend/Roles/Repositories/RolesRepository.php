<?php

namespace App\Modules\Backend\Roles\Repositories;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Modules\Backend\Roles\Repositories\RolesRepositoryInterface;
use App\Modules\Backend\Permissions\Repositories\PermissionsRepositoryInterface;

class RolesRepository implements RolesRepositoryInterface
{
    public function __construct(PermissionsRepositoryInterface $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    public function loadOptions(string $search = null)
    {
        $result = array();

        if ($search != null) {
            $roles = Role::query()
            ->where(function ($query) use ($search) {
                return $query->where([
                    ['name', '!=', 'super-admin']
                ])->where([
                    ['name', 'LIKE', '%'.$search.'%']
                ]);
            })
            ->get();
        } else {
            $roles = $this->findAllRoles(['id', 'name']);
        }

        foreach ($roles as $key => $value) {
            $init["id"] = $value->id;

            $init["text"] = format_string($value->name);

            array_push($result, $init);
        }

        return $result;
    }

    public function findAllRoles(array $fields)
    {
        return Role::query()
        ->where([
            ['name', '!=', 'super-admin']
        ])
        ->select($fields)
        ->get();
    }

    public function findById($id)
    {

    }

    public function findByName($name)
    {
        return Role::query()
        ->where([
            ['name', '=', $name]
        ])
        ->first();
    }

    public function store(array $request)
    {
        $role = Role::create($request);

        $role->syncPermissions($this->permission_array($request));

        return true;
    }

    public function update(string $name, array $request)
    {
        $role = $this->findByName($name);

        $role->update($request);

        $role->syncPermissions($this->permission_array($request));

        return true;
    }

    public function destroy($slug)
    {

    }

    private function permission_array(array $request)
    {
        $array = array();

        if (isset($request['permissions'])) {
            foreach ($request['permissions'] as $key => $value) {
                $permission = $this->permissionsRepository->findById($value);

                array_push($array, $permission);
            }
        }

        return $array;
    }
}
