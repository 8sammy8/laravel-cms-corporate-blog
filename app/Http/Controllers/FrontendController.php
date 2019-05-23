<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\MenusRepository;

class FrontendController extends Controller
{
    /**
     * @var MenusRepository
     */
    protected $menus_rep;

    /**
     * @var \App\Repositories\FiltersRepository
     */
    protected $filters_rep;

    /**
     * @var \App\Repositories\SlidersRepository
     */
    protected $sliders_rep;

    /**
     * @var \App\Repositories\PortfoliosRepository
     */
    protected $portfolios_rep;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $keywords;

    /**
     * @var string
     */
    protected $meta_desc;

    /**
     * @var
     */
    protected $template;

    /**
     * @var array
     */
    protected $vars = [];

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $theme;

    /**
     * FrontendController constructor.
     */
    public function __construct()
    {
        $this->title = trans('controllers.title_main');
        $this->keywords = trans('controllers.meta_keywords');
        $this->meta_desc = trans('controllers.meta_description');

        $this->menus_rep = new MenusRepository(new Menu);

        $this->theme = config('theme.default');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);
        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);

        $this->vars = array_add($this->vars, 'menu', $this->menus_rep->make());

        return view($this->template)->with($this->vars);
    }

}
