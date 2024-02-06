<?php

namespace App\Policies;

use App\Models\User;
use App\Models\commentaire;
use Illuminate\Auth\Access\Response;

class CommentairePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, commentaire $commentaire): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, commentaire $commentaire): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, commentaire $commentaire): bool
    {
        //
        return ($user->id == $commentaire->users_id) || ($user->roles_id == '2');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, commentaire $commentaire): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, commentaire $commentaire): bool
    {
        //
        return true;
    }
}
