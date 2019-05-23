<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PriceRequest;
use App\Repositories\FiltersRepository;
use App\Repositories\PricesRepository;

class PriceController extends BackendController
{
    /**
     * @var FiltersRepository
     */
    protected $filter_rep;

    /**
     * PriceController constructor.
     * @param PricesRepository $pricesRepository
     * @param FiltersRepository $filtersRepository
     */
    public function __construct(PricesRepository $pricesRepository, FiltersRepository $filtersRepository)
    {
        parent::__construct();

        $this->rep = $pricesRepository;
        $this->filter_rep = $filtersRepository;

        $this->template .= 'price.';
        $this->title .= ' Price';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' view';
        $this->vars = array_add($this->vars, 'prices', $this->rep->make());
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
     * @param PriceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PriceRequest $request)
    {
        $result = $this->rep->store($request);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.prices.index')->with($result);
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
     * @param PriceRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PriceRequest $request, $id)
    {
        $result = $this->rep->update($request, $id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.prices.index')->with($result);
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
        return redirect()->route('backend.prices.index')->with($result);
    }

    /**
     * @param int $id
     */
    private function one($id)
    {
        $price = $this->rep->oneLangs($id);

        if ($price) $this->vars = array_add($this->vars, 'price', $price);
        $this->vars = array_add($this->vars, 'priceLangs', $price->priceLangs->keyBy('lang'));
    }
}
