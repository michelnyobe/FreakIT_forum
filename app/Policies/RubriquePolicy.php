<?php

namespace App\Policies;

use App\Models\User;
use App\Models\rubrique;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class RubriquePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user ): bool 
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user , rubrique $rubrique): bool
    {
        //
         return ($rubrique->users_id == $user->id) || ($user->roles_id == '2');;
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
    public function update(User $user, rubrique $rubrique): bool
    {
        //
        return ($rubrique->users_id == $user->id) || ($user->roles_id == '2');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, rubrique $rubrique): bool
    {
        //
        return $user->roles_id == '2';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, rubrique $rubrique): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, rubrique $rubrique): bool
    {
        //
        return true;
    }
}
