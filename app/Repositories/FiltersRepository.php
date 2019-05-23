<?php

namespace App\Repositories;

use App\Models\Filter;
use Illuminate\Support\Facades\DB;

class FiltersRepository extends Repository
{
    /**
     * FiltersRepository constructor.
     * @param Filter $filter
     */
    public function __construct(Filter $filter)
    {
        $this->model = $filter;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        $this->setWith(['filterLang']);
        $this->setTake($arg);

        return parent::make();
    }

    /**
     * @return array
     */
    public function makeArray()
    {
        $this->setDefault();
        $this->setData($this->make()->keyBy('id')->toArray());

        if($this->data && current($this->data)){
            foreach ($this->data as $filter){
                $this->data[$filter['id']] = $filter['filter_lang']['title'];
            }
        }
        return $this->data;
    }

    /**
     * @param bool $arg
     * @return bool
     */
    public function one($arg = false)
    {
        $this->setWith(['filterLangs']);
        $this->setWhere(['id' => $arg]);

        return parent::one();
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
                return ['status' => trans('rep.filters_store_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.filters_store_error')];
    }

    /**
     * @return bool
     */
    private function storeLangs()
    {
        if ($this->model->id && current($this->data)) {
            foreach (config('settings.locales') as $lang) {
                $data[] = [
                    'lang' => $lang,
                    'title' => $this->data['title'][$lang],
                    'desc' => json_encode(explode(',', $this->data['desc'][$lang])),
                    'filter_id' => $this->model->id
                ];
            }
            return !! isset($data) && $this->model->filterLangs()->createMany($data);
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
        $this->setData($request->except('_token', 'title', 'desc', 'sort', '_method'));

        $this->model->fill($this->data);
        $this->model->sort = $request->input('sort');

        $this->setData($request->only('title', 'desc'));

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
                return ['status' => trans('rep.filters_update_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.filters_update_error')];
    }

    /**
     * @return bool
     */
    private function updateLangs()
    {
        if ($this->model->id && current($this->data)) {

            foreach ($this->data as $lang => $title) {
                $this->model->filterLangs()
                    ->where('lang', $lang)
                    ->update([
                        'title' => $this->data['title'][$lang],
                        'desc' => json_encode(explode(',', $this->data['desc'][$lang])),
                    ]);
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
        $model =$this->model->where('id', $id)->first();

        if($model->load('prices')->prices)
        {
            return ['error' => trans('rep.filters_destroy_error_price')];
        }
        if($model->load('portfolios')->portfolios)
        {
            return ['error' => trans('rep.filters_destroy_error_portfolio')];
        }
        if ($this->model->destroy($id))
        {
            return ['status' => trans('rep.filters_destroy_status')];
        }
        return ['error' => trans('rep.filters_destroy_error')];
    }
}