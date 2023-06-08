<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Practices;
use Illuminate\Auth\Access\HandlesAuthorization;

class PracticesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the practices can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allpractices');
    }

    /**
     * Determine whether the practices can view the model.
     */
    public function view(User $user, Practices $model): bool
    {
        return $user->hasPermissionTo('view allpractices');
    }

    /**
     * Determine whether the practices can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allpractices');
    }

    /**
     * Determine whether the practices can update the model.
     */
    public function update(User $user, Practices $model): bool
    {
        return $user->hasPermissionTo('update allpractices');
    }

    /**
     * Determine whether the practices can delete the model.
     */
    public function delete(User $user, Practices $model): bool
    {
        return $user->hasPermissionTo('delete allpractices');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allpractices');
    }

    /**
     * Determine whether the practices can restore the model.
     */
    public function restore(User $user, Practices $model): bool
    {
        return false;
    }

    /**
     * Determine whether the practices can permanently delete the model.
     */
    public function forceDelete(User $user, Practices $model): bool
    {
        return false;
    }
}
