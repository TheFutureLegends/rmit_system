<?php

namespace App\Modules\Backend\Users\Repositories;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Jobs\SendVerifyEmailJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Modules\Backend\Clubs\Models\Clubs;
use App\Modules\Backend\Teams\Models\Teams;
use App\Modules\Backend\Teams\Repositories\TeamRepositoryInterface;
use App\Modules\Backend\Users\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;

        $this->user = null;
    }

    public function loadAdvisorOptions(string $search = null)
    {
        $result = array();

        $users = User::role('advisor')
            ->where(function ($query) use ($search) {
                if ($search != null) {
                    return $query->where([
                        ['email', 'LIKE', '%'.$search.'%']
                    ]);
                }
            })
            ->get();

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

        $users = User::role('advisor')
            ->whereNotIn('id', $advisor_id)
            ->where(function ($query) use ($search) {
                if ($search != null) {
                    return $query->where([
                        ['email', 'LIKE', '%'.$search.'%']
                    ]);
                }
            })
            ->get();

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

        if (Auth::user()->hasRole('advisor')) {
            $users = User::role('president')
            ->whereIn('id', Teams::query()->where('leader_id', Auth::id())->pluck('member_id'))
            ->whereNotIn('id', Clubs::query()->pluck('president_id'))
            ->where(function ($query) use ($search) {
                if ($search != null) {
                    return $query->where([
                        ['email', 'LIKE', '%'.$search.'%']
                    ]);
                }
            })
            ->get();
        } else {
            $users = User::role('president')
            ->whereNotIn('id', Clubs::query()->pluck('president_id'))
            ->where(function ($query) use ($search) {
                if ($search != null) {
                    return $query->where([
                        ['email', 'LIKE', '%'.$search.'%']
                    ]);
                }
            })
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
            ->whereIn('id', Teams::query()->where('leader_id', Auth::id())->pluck('member_id') )
            ->OrWhereIn('id', Clubs::query()->where([
                ['advisor_id', '=', Auth::id()]
            ])->pluck('president_id'))
            ->get();

        } else {
            if (Auth::user()->hasRole('president')) {
                return Auth::user()->leader;
            }
        }
    }

    public function findByEmail(string $email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function store(array $request)
    {
        // $password = Str::random(10, 30);

        $password = 'password';

        $token = Str::random(60);

        if (Auth::user()->hasAnyRole(['super-admin', 'admin', 'advisor'])) {
            # code...
            $this->user = User::create($this->format($token, $password, $request));

            if (Auth::user()->hasRole('super-admin')) {

                ($this->user)->assignRole('admin');

            } else if (Auth::user()->hasRole('admin')) {

                ($this->user)->assignRole('advisor');

            } else {

                ($this->user)->assignRole('president');

                // Add created user as temporary to teams table
                $this->teamRepository->store(($this->user)->toArray());

            }
        } else {
            if (Auth::user()->hasRole('president')) {
                # code...
                switch ($request['role']) {
                    case 'member':
                        $this->teamRepository->store($request);

                        break;
                    default:
                        $this->user = User::create($this->format($token, $password, $request));

                        ($this->user)->assignRole($request['role']);

                        $this->teamRepository->store(($this->user)->toArray());

                        break;
                }
            } else {

            }
        }

        if ($this->user != null) {
            $job = (new SendVerifyEmailJob($this->user, $password))->delay(Carbon::now()->addSeconds(15));

            dispatch($job);
        }

        return true;
    }

    // Transfer club advisor
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

    public function destroy(string $email)
    {
        $user = $this->findByEmail($email);

        if ($user == null) {
            if (Auth::user()->hasRole('president')) {
                $user = Teams::query()
                    ->where([
                        ['leader_id', '=', Auth::id()]
                    ])
                    ->where([
                        ['email', '=', $email]
                    ])
                    ->first();
            } else {
                # Other executives have permission to delete user
            }
        }

        $user->delete();

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

        $result['token'] = $token;

        /**
         * This is for developing purpose only
         */
        $result['status'] = 1;

        return $result;
    }
}
