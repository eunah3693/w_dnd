<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DashboardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        if($admin)
        {
            return true
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(Admin $admin)
    {
        if($admin)
        {
            return true
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        if($admin)
        {
            return true
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function delete(User $user, Admin $admin)
    {
        if($admin)
        {
            return true
                ? Response::allow()
                : Response::deny('You do not own this post.');
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function restore(User $members, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function forceDelete(User $members, Admin $admin)
    {
        //
    }
}
