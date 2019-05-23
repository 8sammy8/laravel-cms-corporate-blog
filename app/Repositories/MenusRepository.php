<?php

namespace App\Repositories;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenusRepository extends Repository
{
    /**
     * @var array
     */
    private $menuArray = [];
    /**
     * @var array
     */
    private $menuNew = [];

    /**
     * @var null | int
     */
    private $sign = null;

    /**
     * MenusRepository constructor.
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        $this->setWith(['menuLang']);

        return parent::make();
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function one($arg = false)
    {
        $this->setWith(['menuLangs']);
        $this->setWhere(['id' => $arg]);

        return parent::one();
    }

    /**
     * @return array
     */
    public static function makeAdmin()
    {
        return [
            'menus' => route('backend.menus.index'),
            'portfolios' => route('backend.portfolios.index'),
            'prices' => route('backend.prices.index'),
            'sliders' => route('backend.sliders.index'),
            'filters' => route('backend.filters.index'),
            'permissions' => route('backend.permissions.index'),
            'messages' => route('backend.messages.index'),
            'comments' => route('backend.comments.index'),
            'blog' => route('backend.blog.index')
        ];
    }

    /**
     * @return array
     */
    public function makeArray()
    {
        $this->setDefault();
        $this->setMenuArray($this->make()->keyBy('id')->toArray());
        $this->menusCreate();

        return $this->getMenuNew();
    }

    /**
     * @param string $mark
     */
    private function menusCreate($mark = '')
    {
        foreach ($this->filterItems() as $menu) {

            $this->setMenuNew(array_add($this->getMenuNew(), $menu['id'], $mark . ucfirst($menu['menu_lang']['title'])));
            $this->setSign($menu['id']);

            if ($this->filterItems()) {
                $this->menusCreate($mark . ' ... ');
            }
        }
    }

    /**
     * @return array
     */
    private function filterItems()
    {
        $menus = $this->getMenuArray();

        return array_filter($menus, function ($menus) {
            return ($menus['parent_id'] == $this->getSign());
        });
    }

    /**
     * @return array
     */
    public function getMenuArray(): array
    {
        return $this->menuArray;
    }

    /**
     * @param array $menuArray
     */
    public function setMenuArray(array $menuArray): void
    {
        $this->menuArray = $menuArray;
    }

    /**
     * @return array
     */
    public function getMenuNew(): array
    {
        return $this->menuNew;
    }

    /**
     * @param array $menuNew
     */
    public function setMenuNew(array $menuNew): void
    {
        $this->menuNew = $menuNew;
    }

    /**
     * @return null
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @param null|int $sign
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws \Exception
     */
    public function store($request)
    {
        if($this->fill($request))
        {
            DB::beginTransaction();
            if ($this->model->save() && $this->storeLangs()) {
                DB::commit();
                return ['status' => trans('rep.menus_store_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.menus_store_error')];
    }

    /**
     * @return bool
     */
    private function storeLangs()
    {
        if ($this->model->id && current($this->data)) {
            foreach ($this->data as $lang => $title) {
                $this->data[$lang] = [
                    'lang' => $lang,
                    'title' => $title,
                    'menu_id' => $this->model->id
                ];
            }
            return !! isset($this->data) && $this->model->menuLangs()->createMany($this->data);
        }
        return false;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param bool $id
     * @return bool
     */
    private function fill($request, $id = false)
    {
        if($id){
            $this->model = $this->one($id);
        }
        $this->setData($request->except('_token', 'title', 'sort', '_method'));

        $this->model->fill($this->data);
        $this->model->sort = $request->input('sort');

        $this->setData($request->input('title'));

        return !! $this->model && $this->data;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update($request, $id)
    {
        if ($this->fill($request, $id))
        {
            DB::beginTransaction();
            if ($this->model->update() && $this->updateLangs()) {
                DB::commit();
                return ['status' => trans('rep.menus_update_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.menus_update_error')];
    }

    /**
     * @return bool
     */
    private function updateLangs()
    {
        if ($this->model->id && current($this->data)) {

            foreach ($this->data as $lang => $title) {
                $this->model->menuLangs()
                    ->where('lang', $lang)
                    ->update(['title' => $title]);
            }
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        if($this->model->where('parent_id', $id)->first())
        {
            return ['error' => trans('rep.menus_destroy_error_parent')];
        }
        if ($this->model->where('id', $id)->delete())
        {
            return ['status' => trans('rep.menus_destroy_status')];
        }
        return ['error' => trans('rep.menus_destroy_error')];
    }

}