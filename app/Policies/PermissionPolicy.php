<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return $user->permission(Route::currentRouteName());
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->permission(Route::currentRouteName());
    }

    /**
     * @param User $user
     * @return bool
     */
    public function store(User $user)
    {
        return $user->permission(Route::currentRouteName());
    }

    /**
     * @param User $user
     * @return bool
     */
    public function show(User $user)
    {
        return $user->permission(Route::currentRouteName());
    }

    /**
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->permission(Route::currentRouteName());
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->permission(Route::currentRouteName());
    }

    /**
     * @param User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return $user->permission(Route::currentRouteName());
    }

}
