<?php

namespace App\Modules\Backend\Events\Repositories;

use App\Modules\Backend\Events\Models\Events;

interface EventRepositoryInterface
{
    public function findAllEvents();

    public function findBySlug($slug);

    public function store(string $method, array $request);

    public function update(string $method, string $slug, array $request);

    public function destroy(Events $event);
}
