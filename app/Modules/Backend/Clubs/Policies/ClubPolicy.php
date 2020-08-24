<?php

namespace App\Modules\Backend\Clubs\Policies;

use App\User;
use App\Modules\Backend\Clubs\Models\Clubs;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClubPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('club.view')) {
            return true;
        }

        abort(404);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Clubs  $clubs
     * @return mixed
     */
    public function view(User $user, Clubs $clubs)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('club.create')) {
            return true;
        }

        abort(404);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Clubs  $clubs
     * @return mixed
     */
    public function update(User $user, Clubs $clubs)
    {
        if ($user->can('club.update')) {

            if ($user->hasAnyRole(['super-admin', 'admin'])) {
                return true;
            } else {
                if ($user->id == $clubs->advisor_id) {
                    return true;
                }
            }
        }

        abort(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Clubs  $clubs
     * @return mixed
     */
    public function delete(User $user, Clubs $clubs)
    {
        if ($user->can('club.delete')) {

            if ($user->hasAnyRole(['super-admin', 'admin'])) {
                return true;
            } else {
                if ($user->id == $clubs->advisor_id) {
                    return true;
                }
            }
        }

        abort(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Clubs  $clubs
     * @return mixed
     */
    public function restore(User $user, Clubs $clubs)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Clubs  $clubs
     * @return mixed
     */
    public function forceDelete(User $user, Clubs $clubs)
    {
        //
    }
}
