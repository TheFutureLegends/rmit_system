<?php

namespace App\Modules\Backend\Clubs\Repositories;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Modules\Backend\Clubs\Repositories\ClubRepositoryInterface;

class ClubRepository implements ClubRepositoryInterface
{
    public function loadOptions(string $search = null)
    {
        $result = array();

        if ($search != null) {
            if (Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
                $clubs = Clubs::query()
                ->where([
                    ['name', 'LIKE', '%'.$search.'%']
                ])
                ->get();
            } else {
                $clubs = Clubs::query()
                ->where([
                    ['advisor_id', '=', Auth::id()]
                ])
                ->where([
                    ['name', 'LIKE', '%'.$search.'%']
                ])
                ->get();
            }
        } else {
            $clubs = $this->findAllClubs();
        }

        foreach ($clubs as $key => $value) {
            $init["id"] = $value->id;

            $init["text"] = format_string($value->name);

            array_push($result, $init);
        }

        return $result;
    }

    public function findAllClubs()
    {
        if (Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
            return Clubs::all();
        } else {
            return Clubs::query()
            ->where([
                ['advisor_id', '=', Auth::id()]
            ])
            ->get();
        }
    }

    public function findBySlug(string $slug)
    {
        return Clubs::query()
        ->where([
            ['slug', '=', $slug]
        ])
        ->firstOrFail();
    }

    public function store(array $request)
    {
        $club = Clubs::create($this->format($request));

        $this->addFile($club, $request);

        return true;
    }

    public function update(string $slug, array $request)
    {
        $club = $this->findBySlug($slug);

        $club->update($this->format($request));

        $this->addFile($club, $request);

        return true;
    }

    private function format(array $request)
    {
        $result = array();

        if (isset($request['name'])) {
            $result['name'] = $request['name'];
        }

        if (isset($request['abbreviation'])) {
            $result['abbreviation'] = $request['abbreviation'];
        }

        if (isset($request['description'])) {
            $result['description'] = $request['description'];
        }

        if (Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
            $result['advisor_id'] = $request['advisor'];
        } else {
            // Current logged in advisor
            $result['advisor_id'] = Auth::id();
        }

        if (isset($request['president'])) {
            $result['president_id'] = $request['president'];
        }

        return $result;
    }

    private function addFile(Clubs $club, array $request)
    {
        if (isset($request['logo'])) {
            $name = Str::random(10, 60) . time();

            $extension = $request['logo']->getClientOriginalExtension();

            $club->addMediaFromRequest('logo')->usingName($name)->usingFileName($name . '.' . $extension)->toMediaCollection('logo');
        }

        return true;
    }
}
