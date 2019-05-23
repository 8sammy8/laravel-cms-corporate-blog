<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsRepository extends Repository
{
    /**
     * @var RolesRepository
     */
    protected $role_rep;

    /**
     * PermissionsRepository constructor.
     * @param Permission $permission
     * @param RolesRepository $rolesRepository
     */
    public function __construct(Permission $permission, RolesRepository $rolesRepository)
    {
        $this->model = $permission;
        $this->role_rep = $rolesRepository;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function update($request)
    {
        $this->data = $request->except('_token');

        foreach ($this->role_rep->make() as $role)
        {
            if(isset($this->data['role_' . $role->id])){

                /** @var \App\Models\Role $role */
                $role->sync($this->data['role_' . $role->id]);
            }
            else{
                /** @var \App\Models\Role $role */
                $role->detach();
            }
        }
        return ['status' => trans('rep.permissions_update_status')];
    }

}