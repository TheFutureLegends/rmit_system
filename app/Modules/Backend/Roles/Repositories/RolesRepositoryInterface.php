<?php

namespace App\Modules\Backend\Roles\Repositories;

interface RolesRepositoryInterface
{
    public function loadOptions(string $search = null);

    public function findAllRoles(array $fields);

    public function findById($id);

    public function findByName($email);

    public function store(array $request);

    public function update(string $name, array $request);

    public function destroy($slug);
}
