<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MenuRequest;
use App\Repositories\MenusRepository;

class MenuController extends BackendController
{
    /**
     * MenuController constructor.
     * @param MenusRepository $menusRepository
     */
    public function __construct(MenusRepository $menusRepository)
    {
        parent::__construct();

        $this->rep = $menusRepository;

        $this->template .= 'menu.';
        $this->title .= ' Menu';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' view';
        $this->vars = array_add($this->vars, 'menu', $this->rep->make());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->title .= ' create';
        $this->vars = array_add($this->vars, 'menuArray', $this->rep->makeArray());
    }

    /**
     * @param MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(MenuRequest $request)
    {
        $result = $this->rep->store($request);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.menus.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $this->title .= ' show';
        $this->one($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->title .= ' edit';
        $this->one($id);
    }

    /**
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(MenuRequest $request, $id)
    {
        $result = $this->rep->update($request, $id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.menus.index')->with($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->rep->destroy($id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.menus.index')->with($result);
    }

    /**
     * @param $id
     */
    private function one($id)
    {
        $menus = $this->rep->one($id);

        $this->vars = array_add($this->vars, 'menuArray', $this->rep->makeArray());

        if ($menus) $this->vars = array_add($this->vars, 'menu', $menus);
        $menus->setPathOrigin(true);
        $this->vars = array_add($this->vars, 'menuLangs', $menus->menuLangs->keyBy('lang'));
    }
}
