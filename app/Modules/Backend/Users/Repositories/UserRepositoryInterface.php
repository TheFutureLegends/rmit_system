<?php

namespace App\Modules\Backend\Users\Repositories;

interface UserRepositoryInterface
{
    public function loadAdvisorOptions(string $search = null);

    public function loadAdvisorWithNoClubOptions(string $search = null);

    public function loadPresidentOptions(string $search = null);

    public function findUserByRole();

    public function findByEmail(string $email);

    public function store(array $request);

    public function update(string $email, array $request);
}
