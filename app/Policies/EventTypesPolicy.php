<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EventTypes;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventTypesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the eventTypes can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list alleventtypes');
    }

    /**
     * Determine whether the eventTypes can view the model.
     */
    public function view(User $user, EventTypes $model): bool
    {
        return $user->hasPermissionTo('view alleventtypes');
    }

    /**
     * Determine whether the eventTypes can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create alleventtypes');
    }

    /**
     * Determine whether the eventTypes can update the model.
     */
    public function update(User $user, EventTypes $model): bool
    {
        return $user->hasPermissionTo('update alleventtypes');
    }

    /**
     * Determine whether the eventTypes can delete the model.
     */
    public function delete(User $user, EventTypes $model): bool
    {
        return $user->hasPermissionTo('delete alleventtypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete alleventtypes');
    }

    /**
     * Determine whether the eventTypes can restore the model.
     */
    public function restore(User $user, EventTypes $model): bool
    {
        return false;
    }

    /**
     * Determine whether the eventTypes can permanently delete the model.
     */
    public function forceDelete(User $user, EventTypes $model): bool
    {
        return false;
    }
}
