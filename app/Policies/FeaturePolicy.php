<?php

namespace App\Policies;

use App\Models\Feature;
use App\Models\User;

class FeaturePolicy
{
    /**
     * Determine whether the user can view any features.
     */
    public function viewAny(User $user): bool
    {
        // Everyone can view features
        return true;
    }

    /**
     * Determine whether the user can view the feature.
     */
    public function view(User $user, Feature $feature): bool
    {
        // Everyone can view features
        return true;
    }

    /**
     * Determine whether the user can create features.
     */
    public function create(User $user): bool
    {
        // Only admin and author can create features
        return $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can update the feature.
     */
    public function update(User $user, Feature $feature): bool
    {
        // Admin can update any feature
        if ($user->isAdmin()) {
            return true;
        }

        // Authors can only update their own features
        if ($user->isUser()) {
            return $user->id === $feature->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the feature.
     */
    public function delete(User $user, Feature $feature): bool
    {
        // Admin can delete any feature
        if ($user->isAdmin()) {
            return true;
        }

        // Authors can only delete their own features
        if ($user->isUser()) {
            return $user->id === $feature->user_id;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the feature.
     */
    public function restore(User $user, Feature $feature): bool
    {
        return $this->delete($user, $feature);
    }

    /**
     * Determine whether the user can permanently delete the feature.
     */
    public function forceDelete(User $user, Feature $feature): bool
    {
        return $this->delete($user, $feature);
    }
}