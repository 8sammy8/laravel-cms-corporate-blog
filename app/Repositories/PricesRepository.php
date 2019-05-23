<?php

namespace App\Repositories;

use App\Models\Price;
use Illuminate\Support\Facades\DB;

class PricesRepository extends Repository
{
    /**
     * PricesRepository constructor.
     * @param Price $price
     */
    public function __construct(Price $price)
    {
        $this->model = $price;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        $this->setWith(['priceLang', 'filterLang']);

        return parent::make();
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function one($arg = false)
    {
        $this->setWith(['priceLang', 'filterLang']);
        $this->setWhere(['filter_id' => $arg]);

        return parent::make();
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function oneLangs($arg = false)
    {
        $this->setWith(['priceLangs', 'filterLang']);
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
        $this->fill($request);

        DB::beginTransaction();
        if ($this->model->save() && $this->storeLangs()) {
            DB::commit();
            return ['status' => trans('rep.prices_store_status')];
        }
        DB::rollBack();
        return ['error' => trans('rep.prices_store_error')];
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
                    'bonus' => json_encode(explode(',', $this->data['bonus'][$lang])),
                    'options' => json_encode(explode(',', $this->data['options'][$lang])),
                    'price_id' => $this->model->id
                ];
            }
            return !! isset($data) && current($data) && $this->model->priceLangs()->createMany($data);
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
            $this->model = $this->oneLangs($id);
        }

        $this->setData($request->except('_token', 'title', 'bonus', 'options', 'sort', '_method'));

        $this->model->fill($this->data);
        $this->model->sort = $request->input('sort');

        $this->setData($request->only('title', 'bonus', 'options'));

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
        $this->fill($request, $id);

        DB::beginTransaction();
        if ($this->model->update() && $this->updateLangs()) {
            DB::commit();

            return ['status' => trans('rep.prices_destroy_status')];
        }
        DB::rollBack();
        return ['error' => trans('rep.prices_destroy_error')];
    }

    /**
     * @return bool
     */
    private function updateLangs()
    {
        if ($this->model->id && current($this->data)) {
            foreach (config('settings.locales') as $lang) {
                $this->model->priceLangs()
                    ->where('lang', $lang)
                    ->update([
                        'title' => $this->data['title'][$lang],
                        'bonus' => json_encode(explode(',', $this->data['bonus'][$lang])),
                        'options' => json_encode(explode(',', $this->data['options'][$lang])),
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
        if ($this->model->where('id', $id)->delete()) {
            return ['status' => trans('rep.prices_destroy_status')];
        }
        return ['error' => trans('rep.prices_destroy_error')];
    }
}