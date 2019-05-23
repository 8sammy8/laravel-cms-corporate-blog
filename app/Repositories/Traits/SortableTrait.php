<?php

namespace App\Repositories\Traits;

use Illuminate\Support\Facades\Input;

trait SortableTrait
{
    /**
     * @param array $default
     * @param array $sortable
     */
    public function sortable($default = [], $sortable = [])
    {
        if(Input::has('sort')) {
            $sort = Input::get('sort');

            $order = 'ASC';
            if (strspn($sort, '-', 0, 1)) {
                $sort = substr($sort, 1);
                $order = 'DESC';
            }
            if($sortable && in_array($sort, $sortable)){
                $this->setOrderBy([$sort => $order]);
            }
        }
        elseif($default){
            $this->setOrderBy($default);
        }
    }

    /**
     * @param $parameters
     * @return string
     */
    public static function link_to($parameters)
    {
        list($sortColumn, $title) = $parameters;

        $queryString =  self::build_query_string($sortColumn);

        return '<a href="' . url(request()->path() . '?' . $queryString) . '">' . $title . '</a>';
    }

    /**
     * @param $sortColumn
     * @return string
     */
    public static function build_query_string($sortColumn)
    {
        if(Input::has('sort')) {
            $sort = Input::get('sort');
            if (strspn($sort, '-', 0, 1)) {
                if(substr($sort, 1) == $sortColumn){
                    $data = $sortColumn;
                }
            }
            else{
                if($sort == $sortColumn){
                    $data = '-' . $sortColumn;
                }
            }
        }
        $queryString = http_build_query([
            'sort'      => isset($data) ? $data : $sortColumn,
        ]);
        return $queryString;
    }
}