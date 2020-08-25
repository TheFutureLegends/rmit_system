<?php

namespace App\Modules\Backend\Teams\Repositories;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Modules\Backend\Teams\Models\Teams;
use App\Modules\Backend\Teams\Repositories\TeamRepositoryInterface;

class TeamRepository implements TeamRepositoryInterface
{
    public function loadRoleForMember(string $search = null)
    {
        $result = array();

        $roles = Role::query()
            ->whereNotIn('name', ['super-admin', 'admin', 'advisor', 'president'])
            ->whereNotIn('name', Teams::query()->where('leader_id', Auth::id())->distinct('type')->except_type('member')->pluck('type') )
            ->where(function ($query) use ($search) {
                if ($search != null) {
                    return $query->where([
                        ['name', 'LIKE', '%'.$search.'%']
                    ]);
                }
            })
            ->pluck('name');

        if (!empty($roles)) {
            foreach ($roles as $key => $role) {
                $init['id'] = $role;

                $init['text'] = format_string($role);

                array_push($result, $init);
            }
        }

        return $result;
    }

    public function store(array $request)
    {
        return Teams::create($this->format($request));
    }

    private function format(array $request)
    {
        $result = array();

        if (Auth::user()->hasAnyRole(['advisor','president'])) {
            $result['leader_id'] = Auth::id();

            if (isset($request['id'])) {
                $result['member_id'] = $request['id'];
            }

            if (isset($request['roles'])) {
                $roles = $request['roles'];

                $result['type'] = $roles[0]['name'];
            }
        } else {
            if (Auth::user()->hasRole('president')) {
                $result['type'] = $request['type'];
            }

            if (isset($request['major'])) {
                $result['major'] = $request['major'];
            }
        }

        if (isset($request['name'])) {
            $result['name'] = $request['name'];
        }

        if (isset($request['email'])) {
            $result['email'] = $request['email'];
        }

        return $result;
    }
}
