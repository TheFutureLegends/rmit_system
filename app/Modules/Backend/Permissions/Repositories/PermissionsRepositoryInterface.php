<?php

namespace App\Modules\Backend\Permissions\Repositories;

interface PermissionsRepositoryInterface
{
    public function loadOptions(string $search = null);

    public function findAllPermissions();

    public function findById($id);

    public function findByName($email);

    public function store(array $request);

    public function update(string $name, array $request);

    public function destroy($slug);
}
