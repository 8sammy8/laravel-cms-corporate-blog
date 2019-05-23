<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PortfolioRequest;
use App\Repositories\FiltersRepository;
use App\Repositories\PortfoliosRepository;

class PortfolioController extends BackendController
{
    /**
     * @var FiltersRepository
     */
    protected $filter_rep;

    /**
     * PortfolioController constructor.
     * @param PortfoliosRepository $portfoliosRepository
     * @param FiltersRepository $filtersRepository
     */
    public function __construct(PortfoliosRepository $portfoliosRepository, FiltersRepository $filtersRepository)
    {
        parent::__construct();

        $this->rep = $portfoliosRepository;
        $this->filter_rep = $filtersRepository;

        $this->template .= 'portfolio.';
        $this->title .= ' Portfolio';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' view';
        $this->vars = array_add($this->vars, 'portfolios', $this->rep->make());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->title .= ' create';
        $this->vars = array_add($this->vars, 'filtersLang', $this->filter_rep->makeArray());
    }

    /**
     * @param PortfolioRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PortfolioRequest $request)
    {
        $result = $this->rep->store($request);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.portfolios.index')->with($result);
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
        $this->vars = array_add($this->vars, 'filtersLang', $this->filter_rep->makeArray());
    }

    /**
     * @param PortfolioRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PortfolioRequest $request, $id)
    {
        $result = $this->rep->update($request, $id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.portfolios.index')->with($result);
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
        return redirect()->route('backend.portfolios.index')->with($result);
    }

    /**
     * @param $id
     */
    private function one($id)
    {
        $portfolio = $this->rep->one($id);

        if ($portfolio) $this->vars = array_add($this->vars, 'portfolio', $portfolio);
        $this->vars = array_add($this->vars, 'portfolioLangs', $portfolio->portfolioLangs->keyBy('lang'));
    }
}
