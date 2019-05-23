<?php

namespace App\Http\Controllers;

use App\Repositories\FiltersRepository;
use App\Repositories\SlidersRepository;
use App\Repositories\PortfoliosRepository;

class IndexController extends FrontendController
{
    /**
     * IndexController constructor.
     * @param SlidersRepository $slidersRepository
     * @param PortfoliosRepository $portfoliosRepository
     * @param FiltersRepository $filtersRepository
     */
    public function __construct(SlidersRepository $slidersRepository, PortfoliosRepository $portfoliosRepository, FiltersRepository $filtersRepository)
    {
        parent::__construct();

        $this->sliders_rep = $slidersRepository;
        $this->portfolios_rep = $portfoliosRepository;
        $this->filters_rep = $filtersRepository;

        $this->template = $this->theme . '.index';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index()
    {
        $slider = view($this->theme . '.slider')
            ->with('sliders', $this->sliders_rep->make())
            ->render();

        $filters = $this->filters_rep->make();

        $portfolio = view($this->theme . '.layouts.portfolio')
            ->with('portfolios', $this->portfolios_rep->make(config('settings.portfolio_take')))
            ->with('filters', $filters)
            ->render();

        $about = view($this->theme . '.layouts.about')
            ->with('filters', $filters)
            ->render();

        $price = view($this->theme . '.layouts.price')
            ->with('filters', $filters)
            ->render();

        $this->vars = array_merge($this->vars, compact('slider','portfolio', 'about', 'price'));

        return $this->renderOutput();
    }

}
