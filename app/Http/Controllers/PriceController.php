<?php

namespace App\Http\Controllers;

use App\Repositories\PricesRepository;
use App\Repositories\FiltersRepository;

class PriceController extends FrontendController
{
    /**
     * @var PricesRepository
     */
    protected $prices_rep;

    /**
     * PriceController constructor.
     * @param PricesRepository $pricesRepository
     * @param FiltersRepository $filtersRepository
     */
    public function __construct(PricesRepository $pricesRepository, FiltersRepository $filtersRepository)
    {
        parent::__construct();

        $this->prices_rep = $pricesRepository;
        $this->filters_rep = $filtersRepository;

        $this->template = $this->theme . '.price.show';
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function show($id)
    {
        $this->title = $this->title . trans('controllers.title_price');

        $filters = $this->filters_rep->make();

        $tariffItems = $this->prices_rep->one($id);

        $price = view($this->theme . '.layouts.price')
            ->with('filters', $filters)
            ->render();

        $tariff = view($this->theme . '.price.tariff')
            ->with('tariffs', $tariffItems)
            ->render();

        $this->vars = array_merge($this->vars, compact( 'price', 'tariff'));

        return $this->renderOutput();
    }

}
