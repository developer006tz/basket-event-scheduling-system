<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Games;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the games can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allgames');
    }

    /**
     * Determine whether the games can view the model.
     */
    public function view(User $user, Games $model): bool
    {
        return $user->hasPermissionTo('view allgames');
    }

    /**
     * Determine whether the games can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allgames');
    }

    /**
     * Determine whether the games can update the model.
     */
    public function update(User $user, Games $model): bool
    {
        return $user->hasPermissionTo('update allgames');
    }

    /**
     * Determine whether the games can delete the model.
     */
    public function delete(User $user, Games $model): bool
    {
        return $user->hasPermissionTo('delete allgames');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allgames');
    }

    /**
     * Determine whether the games can restore the model.
     */
    public function restore(User $user, Games $model): bool
    {
        return false;
    }

    /**
     * Determine whether the games can permanently delete the model.
     */
    public function forceDelete(User $user, Games $model): bool
    {
        return false;
    }
}
