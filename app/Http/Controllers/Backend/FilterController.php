<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\FilterRequest;
use App\Repositories\FiltersRepository;

class FilterController extends BackendController
{
    /**
     * FilterController constructor.
     * @param FiltersRepository $filtersRepository
     */
    public function __construct(FiltersRepository $filtersRepository)
    {
        parent::__construct();

        $this->rep = $filtersRepository;

        $this->template .= 'filter.';
        $this->title .= ' Filter';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' view';
        $this->vars = array_add($this->vars, 'filters', $this->rep->make());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->title .= ' create';
    }

    /**
     * @param FilterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(FilterRequest $request)
    {
        $result = $this->rep->store($request);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.filters.index')->with($result);
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
     * @param FilterRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(FilterRequest $request, $id)
    {
        $result = $this->rep->update($request, $id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.filters.index')->with($result);
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
        return redirect()->route('backend.filters.index')->with($result);
    }

    /**
     * @param $id
     */
    private function one($id)
    {
        $filter = $this->rep->one($id);

        if ($filter) $this->vars = array_add($this->vars, 'filter', $filter);
        $this->vars = array_add($this->vars, 'filterLangs', $filter->filterLangs->keyBy('lang'));
    }
}
