<?php

namespace App\Modules\Backend\Events\Policies;

use App\User;
use App\Modules\Backend\Events\Models\Events;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can provide feedback.
     *
     * @param  \App\User  $user
     * @param  \App\Modules\Backend\Events\Models\Events  $events
     * @return mixed
     */
    public function feedback(User $user, Events $events)
    {
        if ($user->hasAnyRole(['super-admin', 'admin', 'advisor'])) {
            return true;
        }

        abort(404);
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('event.view')) {
            return true;
        }

        abort(404);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules\Backend\Events\Models\Events  $events
     * @return mixed
     */
    public function view(User $user, Events $events)
    {
        if ($user->can('event.view')) {
            if ($user->hasAnyRole(['super-admin', 'admin'])) {
                if ($event->status == 2) {
                    abort(404);
                }
                return true;
            } else if ($user->hasRole('advisor')) {
                if ($events->status == 2) {
                    abort(404);
                }

                if ($user->id == $events->club->advisor_id) {
                    return true;
                }
            } else {
                if ($user->hasRole('president')) {
                    if ($user->president->id == $events->club_id) {
                        return true;
                    }
                } else {
                    // Other members of club that has permission to update event
                }
            }
        }

        abort(404);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('event.create')) {
            return true;
        }

        abort(404);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules\Backend\Events\Models\Events  $events
     * @return mixed
     */
    public function update(User $user, Events $events)
    {
        if ($user->can('event.update')) {
            if ($events->status == 1) {
                abort(404);
            }

            if ($user->hasAnyRole(['super-admin','admin'])) {
                return true;
            } else if ($user->hasRole('advisor')) {
                if ($user->id == $events->author_id) {
                    return true;
                }
            } else {
                if ($user->hasRole('president')) {
                    if ($user->president->id == $events->club_id) {
                        return true;
                    }
                } else {
                    // Other members of club that has permission to update event
                }
            }
        }

        abort(404);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules\Backend\Events\Models\Events  $events
     * @return mixed
     */
    public function delete(User $user, Events $events)
    {
        if ($user->can('event.delete')) {
            return true;
        }

        abort(404);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules\Backend\Events\Models\Events  $events
     * @return mixed
     */
    public function restore(User $user, Events $events)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Modules\Backend\Events\Models\Events  $events
     * @return mixed
     */
    public function forceDelete(User $user, Events $events)
    {
        //
    }
}
