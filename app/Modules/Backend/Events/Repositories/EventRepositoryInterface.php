<?php

namespace App\Modules\Backend\Events\Repositories;

interface EventRepositoryInterface
{
    public function findAllEvents();

    public function findBySlug($slug);

    public function store(string $method, array $request);

    public function update(string $method, string $slug, array $request);
}
