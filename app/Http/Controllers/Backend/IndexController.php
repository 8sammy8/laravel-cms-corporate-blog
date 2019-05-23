<?php

namespace App\Http\Controllers\Backend;

use Klisl\Statistics\Controllers\StatController;

class IndexController extends BackendController
{
    /**
     * @var StatController
     */
    protected $stat;

    /**
     * IndexController constructor.
     *
     * @param StatController $statController
     */
    public function __construct(StatController $statController)
    {
        parent::__construct();

        $this->title .= ' Admin panel';

        $this->stat = $statController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parent = $this->stat->index();

        $this->vars = array_add($this->vars, 'count_ip', $parent->count_ip);
        $this->vars = array_add($this->vars, 'stat_ip', $parent->stat_ip);
        $this->vars = array_add($this->vars, 'black_list', $parent->black_list);
    }
}
