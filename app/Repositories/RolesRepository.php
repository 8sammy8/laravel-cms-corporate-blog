<?php

namespace App\Repositories;

use App\Models\Role;

class RolesRepository extends Repository
{
    /**
     * RolesRepository constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        $this->setWith(['permissions']);
        return parent::make($arg);
    }

}