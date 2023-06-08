<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EventStatistics;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventStatisticsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the eventStatistics can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list alleventstatistics');
    }

    /**
     * Determine whether the eventStatistics can view the model.
     */
    public function view(User $user, EventStatistics $model): bool
    {
        return $user->hasPermissionTo('view alleventstatistics');
    }

    /**
     * Determine whether the eventStatistics can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create alleventstatistics');
    }

    /**
     * Determine whether the eventStatistics can update the model.
     */
    public function update(User $user, EventStatistics $model): bool
    {
        return $user->hasPermissionTo('update alleventstatistics');
    }

    /**
     * Determine whether the eventStatistics can delete the model.
     */
    public function delete(User $user, EventStatistics $model): bool
    {
        return $user->hasPermissionTo('delete alleventstatistics');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete alleventstatistics');
    }

    /**
     * Determine whether the eventStatistics can restore the model.
     */
    public function restore(User $user, EventStatistics $model): bool
    {
        return false;
    }

    /**
     * Determine whether the eventStatistics can permanently delete the model.
     */
    public function forceDelete(User $user, EventStatistics $model): bool
    {
        return false;
    }
}
