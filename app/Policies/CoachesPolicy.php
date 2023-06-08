<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Coaches;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoachesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the coaches can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allcoaches');
    }

    /**
     * Determine whether the coaches can view the model.
     */
    public function view(User $user, Coaches $model): bool
    {
        return $user->hasPermissionTo('view allcoaches');
    }

    /**
     * Determine whether the coaches can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allcoaches');
    }

    /**
     * Determine whether the coaches can update the model.
     */
    public function update(User $user, Coaches $model): bool
    {
        return $user->hasPermissionTo('update allcoaches');
    }

    /**
     * Determine whether the coaches can delete the model.
     */
    public function delete(User $user, Coaches $model): bool
    {
        return $user->hasPermissionTo('delete allcoaches');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allcoaches');
    }

    /**
     * Determine whether the coaches can restore the model.
     */
    public function restore(User $user, Coaches $model): bool
    {
        return false;
    }

    /**
     * Determine whether the coaches can permanently delete the model.
     */
    public function forceDelete(User $user, Coaches $model): bool
    {
        return false;
    }
}
