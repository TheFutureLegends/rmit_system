<?php

namespace App\Modules\Backend\Clubs\Repositories;

interface ClubRepositoryInterface
{
    public function loadOptions(string $search = null);

    public function findAllClubs();

    public function findBySlug(string $slug);

    public function store(array $request);

    public function update(string $slug, array $request);
}
