<?php

namespace App\Modules\Backend\Events\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Modules\Backend\Events\Models\Events;
use App\Modules\Backend\Events\Repositories\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{
    public function findAllEvents()
    {
        if (Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
            $events = Events::query()
            ->where([
                ['status', '!=', 2]
            ])
            ->get();
        } else if (Auth::user()->hasRole('advisor')) {
            $events = Events::query()
            ->whereIn('club_id', Auth::user()->advisor->pluck('id'))
            ->where([
                ['status', '!=', 2]
            ])
            ->get();
        } else if (Auth::user()->hasRole('president')) {
            $events = Events::query()
            ->where([
                ['club_id', '=', Auth::user()->president->id]
            ])
            ->get();
        } else {

        }

        return $events;
    }

    public function findBySlug($slug)
    {
        return Events::query()
        ->where([
            ['slug', '=', $slug]
        ])
        ->firstOrFail();
    }

    public function store(string $method, array $request)
    {
        $event = Events::create($this->format($method, $request));

        $this->addFile($event, $request);

        return true;
    }

    public function update(string $method, string $slug, array $request)
    {
        $event = $this->findBySlug($slug);

        $event->update( $this->format($method, $request) );

        $this->addFile($event, $request);

        return true;
    }

    private function format(string $method, array $request)
    {
        $result = array();

        if (isset($request['name'])) {
            $result['name'] = $request['name'];
        }

        if (isset($request['description'])) {
            $result['description'] = $request['description'];
        }

        if ($method == "POST") {

            $result['author_id'] = Auth::id();

            if (Auth::user()->hasAnyRole(['super-admin','admin','advisor'])) {
                # code...
                $result['club_id'] = $request['club'];
            } else {
                if (Auth::user()->hasRole('president')) {
                    // Current user that has role president creating new event
                    $result['club_id'] = Auth::user()->president->id;
                } else {
                    // Other members that has permission to create event
                }
            }

            // Set status of event
            if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor'])) {
                $result['status'] = 1;
            }
        }

        if ($method == "PUT") {
            $result['status'] = 0;
        }

        if (isset($request['event_start']) && isset($request['event_end'])) {
            $result['start_at'] = Carbon::parse($request['event_start'])->format('Y-m-d H:i:s');

            $result['end_at'] = Carbon::parse($request['event_end'])->format('Y-m-d H:i:s');
        }

        return $result;
    }

    private function addFile(Events $event, array $request)
    {
        if (isset($request['cover'])) {
            $name = Str::random(10, 60) . time();

            $extension = $request['cover']->getClientOriginalExtension();

            $event->addMediaFromRequest('cover')->usingName($name)->usingFileName($name . '.' . $extension)->toMediaCollection('cover');
        }

        if (isset($request['proposal'])) {
            $files = $request['proposal'];

            $event->clearMediaCollection('file');

            foreach ($files as $file) {
                $event->addMedia($file)->toMediaCollection('file');
            }
        }

        return true;
    }
}
