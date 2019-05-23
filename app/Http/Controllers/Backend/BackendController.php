<?php

namespace App\Http\Controllers\Backend;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Repositories\MenusRepository;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    /**
     * @var
     */
    protected $rep;

    /**
     * @var string
     */
    protected $title = 'Uzlink';

    /**
     * @var string
     */
    protected $template = 'backend.';

    /**
     * @var array
     */
    protected $vars = [];

    /**
     * BackendController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'menuAdmin', MenusRepository::makeAdmin());

        return view($this->template)->with($this->vars);
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        $action = substr(strrchr(Route::currentRouteAction(), "@"), 1);
        if (Gate::denies($action, new Permission)) {
            abort(403);
        }
        if(!in_array($action, ['store', 'update', 'destroy'])){
            $this->template .= $action;
            parent::callAction($method, $parameters);
            return $this->renderOutput();
        }
        return parent::callAction($method, $parameters);
    }
}
