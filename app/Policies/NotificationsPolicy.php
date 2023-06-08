<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Notifications;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the notifications can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allnotifications');
    }

    /**
     * Determine whether the notifications can view the model.
     */
    public function view(User $user, Notifications $model): bool
    {
        return $user->hasPermissionTo('view allnotifications');
    }

    /**
     * Determine whether the notifications can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allnotifications');
    }

    /**
     * Determine whether the notifications can update the model.
     */
    public function update(User $user, Notifications $model): bool
    {
        return $user->hasPermissionTo('update allnotifications');
    }

    /**
     * Determine whether the notifications can delete the model.
     */
    public function delete(User $user, Notifications $model): bool
    {
        return $user->hasPermissionTo('delete allnotifications');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allnotifications');
    }

    /**
     * Determine whether the notifications can restore the model.
     */
    public function restore(User $user, Notifications $model): bool
    {
        return false;
    }

    /**
     * Determine whether the notifications can permanently delete the model.
     */
    public function forceDelete(User $user, Notifications $model): bool
    {
        return false;
    }
}
