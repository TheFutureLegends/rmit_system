<?php

namespace App\Modules\Backend\Users\Repositories;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Modules\Backend\Users\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        # code...
    }

    public function loadAdvisorOptions(string $search = null)
    {
        $result = array();

        if ($search != null) {
            $users = User::role('advisor')
            ->where(function ($query) use ($search) {
                return $query->where([
                    ['email', 'LIKE', '%'.$search.'%']
                ]);
            })
            ->get();
        } else {
            $users = User::role('advisor')->get();
        }

        foreach ($users as $key => $value) {
            $init["id"] = $value->id;

            $init["text"] = ($value->email);

            array_push($result, $init);
        }

        return $result;
    }

    public function loadAdvisorWithNoClubOptions(string $search = null)
    {
        $result = array();

        $advisor_id = Clubs::query()->distinct('advisor_id')->pluck('advisor_id');

        if ($search != null) {
            $users = User::role('advisor')
            ->whereNotIn('id', $advisor_id)
            ->where(function ($query) use ($search) {
                return $query->where([
                    ['email', 'LIKE', '%'.$search.'%']
                ]);
            })
            ->get();
        } else {
            $users = User::role('advisor')
            ->whereNotIn('id', $advisor_id)
            ->get();
        }

        foreach ($users as $key => $value) {
            $init["id"] = $value->id;

            $init["text"] = ($value->email);

            array_push($result, $init);
        }

        return $result;
    }

    public function loadPresidentOptions(string $search = null)
    {
        $result = array();

        if ($search != null) {
            $users = User::role('president')
            ->whereNotIn('id', Clubs::query()->pluck('president_id'))
            ->where(function ($query) use ($search) {
                return $query->where([
                    ['email', 'LIKE', '%'.$search.'%']
                ]);
            })
            ->get();
        } else {
            $users = User::role('president')
            ->whereNotIn('id', Clubs::query()->pluck('president_id'))
            ->get();
        }

        foreach ($users as $key => $value) {
            $init["id"] = $value->id;

            $init["text"] = ($value->email);

            array_push($result, $init);
        }

        return $result;
    }

    public function findUserByRole()
    {
        if (Auth::user()->hasRole('super-admin')) {
            return User::role('admin')->get();
        } else if (Auth::user()->hasRole('admin')) {
            return User::whereHas("roles", function($q){
                $q->where("name", "advisor");
            })->get();

            // ->orWhere("name", "president")
        } else if (Auth::user()->hasRole('advisor')) {
            return User::query()
            ->whereIn('id', Clubs::query()->where([
                ['advisor_id', '=', Auth::id()]
            ])->pluck('president_id'))
            ->get();
        }
    }

    public function findByEmail(string $email)
    {
        return User::query()->where('email', $email)->firstOrFail();
    }

    public function store(array $request)
    {
        // $password = Str::random(10);

        $password = 'password';

        $token = Str::random(60);

        $user = User::create($this->format($token, $password, $request));

        if (Auth::user()->hasRole('super-admin')) {

            $user->assignRole('admin');

        } else if (Auth::user()->hasRole('admin')) {

            $user->assignRole('advisor');

        } else if (Auth::user()->hasRole('advisor')) {

            $user->assignRole('president');

        } else {
            $user->assignRole($request['role']);
        }

        $result['user'] = $user;

        $result['password'] = $password;

        return $result;
    }

    public function update(string $email, array $request)
    {
        $user = $this->findByEmail($email);

        Clubs::query()
        ->where([
            ['advisor_id', '=', $user->id]
        ])
        ->update(['advisor_id' => $request['transfer_advisor']]);

        return true;
    }

    private function format(string $token, string $password, array $request)
    {
        $result = array();

        if (isset($request['name'])) {
            $result['name'] = $request['name'];
        }

        if (isset($request['email'])) {
            $result['email'] = $request['email'];
        }

        $result['password'] = Hash::make($password);

        // $result['token'] = $token;

        /**
         * This is for developing purpose only
         */
        $result['status'] = 1;

        return $result;
    }
}
