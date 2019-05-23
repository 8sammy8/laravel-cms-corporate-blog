<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\RolesRepository;
use App\Repositories\PermissionsRepository;

class PermissionController extends BackendController
{
    /**
     * @var RolesRepository
     */
    protected $role_rep;

    /**
     * PermissionController constructor.
     * @param PermissionsRepository $permissionsRepository
     * @param RolesRepository $rolesRepository
     */
    public function __construct(PermissionsRepository $permissionsRepository, RolesRepository $rolesRepository)
    {
        parent::__construct();

        $this->rep = $permissionsRepository;
        $this->role_rep = $rolesRepository;

        $this->template .= 'permission.';
        $this->title .= ' Permission';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' manager';

        $this->vars = array_add($this->vars, 'roles', $this->role_rep->make());
        $this->vars = array_add($this->vars, 'permissions', $this->rep->make());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return back()->with($this->rep->update($request));
    }
}
