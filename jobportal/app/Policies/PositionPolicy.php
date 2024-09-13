<?php

namespace App\Policies;

use App\Models\Position;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PositionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the position.
     */
    public function view(User $user, Position $position): bool
    {
        // Everyone can view positions
        return true;
    }

    /**
     * Determine whether the user can create positions.
     */
    public function create(User $user): bool
    {
        // Only users with the "company" role can create positions
        return $user->role === 'company';
    }

    /**
     * Determine whether the user can update the position.
     */
    public function update(User $user, Position $position): bool
    {
        // Only the creator of the position can update it
        return $user->id === $position->user_id;
    }

    /**
     * Determine whether the user can delete the position.
     */
    public function delete(User $user, Position $position): bool
    {
        // Only the creator of the position can delete it
        return $user->id === $position->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Position $position): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Position $position): bool
    {
        //
    }
}
