<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Teams;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the teams can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allteams');
    }

    /**
     * Determine whether the teams can view the model.
     */
    public function view(User $user, Teams $model): bool
    {
        return $user->hasPermissionTo('view allteams');
    }

    /**
     * Determine whether the teams can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allteams');
    }

    /**
     * Determine whether the teams can update the model.
     */
    public function update(User $user, Teams $model): bool
    {
        return $user->hasPermissionTo('update allteams');
    }

    /**
     * Determine whether the teams can delete the model.
     */
    public function delete(User $user, Teams $model): bool
    {
        return $user->hasPermissionTo('delete allteams');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allteams');
    }

    /**
     * Determine whether the teams can restore the model.
     */
    public function restore(User $user, Teams $model): bool
    {
        return false;
    }

    /**
     * Determine whether the teams can permanently delete the model.
     */
    public function forceDelete(User $user, Teams $model): bool
    {
        return false;
    }
}
