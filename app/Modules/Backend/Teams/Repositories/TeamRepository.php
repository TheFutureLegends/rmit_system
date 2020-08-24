<?php

namespace App\Modules\Backend\Teams\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Modules\Backend\Teams\Models\Teams;
use App\Modules\Backend\Teams\Repositories\TeamRepositoryInterface;

class TeamRepository implements TeamRepositoryInterface
{
    public function store(array $request)
    {
        return Teams::create($this->format($request));
    }

    private function format(array $request)
    {
        $result = array();

        if (Auth::user()->hasAnyRole(['advisor','president'])) {
            $result['leader_id'] = Auth::id();

            $result['member_id'] = $request['id'];

            $result['name'] = $request['name'];

            $result['email'] = $request['email'];

            $roles = $request['roles'];

            $result['type'] = $roles[0]['name'];
        } else {
            if (isset($request['name'])) {
                $result['name'] = $request['name'];
            }

            if (isset($request['email'])) {
                $result['email'] = $request['email'];
            }

            if (Auth::user()->hasRole('president')) {
                $result['type'] = $request['type'];
            }

            if (isset($request['major'])) {
                $result['major'] = $request['major'];
            }
        }

        return $result;
    }
}
