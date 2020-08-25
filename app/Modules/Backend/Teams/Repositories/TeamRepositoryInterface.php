<?php

namespace App\Modules\Backend\Teams\Repositories;

interface TeamRepositoryInterface
{
    public function loadRoleForMember(string $search = null);

    public function store(array $request);
}
