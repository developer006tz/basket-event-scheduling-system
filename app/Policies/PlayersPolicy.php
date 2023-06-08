<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Players;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the players can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allplayers');
    }

    /**
     * Determine whether the players can view the model.
     */
    public function view(User $user, Players $model): bool
    {
        return $user->hasPermissionTo('view allplayers');
    }

    /**
     * Determine whether the players can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allplayers');
    }

    /**
     * Determine whether the players can update the model.
     */
    public function update(User $user, Players $model): bool
    {
        return $user->hasPermissionTo('update allplayers');
    }

    /**
     * Determine whether the players can delete the model.
     */
    public function delete(User $user, Players $model): bool
    {
        return $user->hasPermissionTo('delete allplayers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allplayers');
    }

    /**
     * Determine whether the players can restore the model.
     */
    public function restore(User $user, Players $model): bool
    {
        return false;
    }

    /**
     * Determine whether the players can permanently delete the model.
     */
    public function forceDelete(User $user, Players $model): bool
    {
        return false;
    }
}
