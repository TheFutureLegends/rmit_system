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

        $clubs = Clubs::query()
        ->where(function ($query) {
            if (!Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
                return $query->where([
                    ['advisor_id', '=', Auth::id()]
                ]);
            }
        })
        ->where(function ($query) use ($search) {
            if ($search != null) {
                return $query->where([
                    ['name', 'LIKE', '%'.$search.'%']
                ]);
            }
        })
        ->get();

        foreach ($clubs as $key => $value) {
            $init["id"] = $value->id;

            $init["text"] = format_string($value->name);

            array_push($result, $init);
        }

        return $result;
    }

    public function findAllClubs()
    {
        return Clubs::query()
        ->where(function ($query) {
            if (!Auth::user()->hasAnyRole(['super-admin', 'admin'])) {
                return $query->where([
                    ['advisor_id', '=', Auth::id()]
                ]);
            }
        })
        ->get();
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

        $club->president->member->delete();

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

    public function destroy(Clubs $club)
    {
        # Delete associate file in storage
        $club->clearMediaCollection('logo');

        $club->president->delete();

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
