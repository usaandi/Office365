<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }
    public function admin(User $user)
    {
       return $this->userIsAdmin($user);
    }
    public function createMilestone(User $user, User $model)
    {
        return $this->userCanEditCareer($user, $model);
    }
    public function createCareer(User $user, User $model)
    {
        return $this->userCanEditCareer($user, $model);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {

          return $this->userCanEdit($user, $model);

    }
    public function updateMilestone(User $user, User $model)
    {

        return $this->userCanEditCareer($user, $model);

    }
    public function updateCareer(User $user, User $model)
    {

        return $this->userCanEditCareer($user, $model);

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $this->userCanEdit($user, $model);
    }


    public function deleteMilestone(User $user, User $model)
    {
        return $this->userCanEditCareer($user, $model);
    }

    protected function userCanEdit(User $user, User $model) {

        if ($user->id === $model->id) {
            return TRUE;
        }

        if($user->hasRole('Admin'))
        {
            return TRUE;
        }

        $modelTeamId = $model->team()->first()->team_id;

        if($user->isModeratorOfTeam($modelTeamId)){
            return TRUE;
        }

        return FALSE;

    }
    protected function userCanEditCareer(User $user, User $model) {

        if($user->hasRole('Admin'))
        {
            return TRUE;
        }

        $modelTeamId = $model->team()->first()->team_id;

        if($user->isModeratorOfTeam($modelTeamId)){
            return TRUE;
        }

        return FALSE;

    }
    protected function userIsAdmin(User $user) {

        if($user->hasRole('Admin'))
        {
            return TRUE;
        }

        return FALSE;

    }
}
