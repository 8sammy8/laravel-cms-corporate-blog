<?php

namespace App\Repositories;

use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use App\Repositories\Traits\ImagesTrait;

class SlidersRepository extends Repository
{
    use ImagesTrait;

    /**
     * SlidersRepository constructor.
     * @param Slider $slider
     */
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        $this->setWith(['sliderLang']);
        $this->setTake($arg);
        $this->setOrderBy(['sort' => 'asc']);

        return parent::make();
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function one($arg = false)
    {
        $this->setWith(['sliderLangs']);
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
        if($this->fill($request)) {

            DB::beginTransaction();
            if ($this->model->save() && $this->storeLangs()) {
                DB::commit();
                return ['status' => trans('rep.sliders_store_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.sliders_store_error')];
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
                    'first_title' => $this->data['first_title'][$lang],
                    'second_title' => $this->data['second_title'][$lang],
                    'desc' => $this->data['desc'][$lang],
                    'slider_id' => $this->model->id
                ];
            }
            return !! isset($data) && $this->model->sliderLangs()->createMany($data);
        }
        return false;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param bool $id
     * @return array|bool
     */
    private function fill($request, $id = false)
    {
        if($id){
            $this->model = $this->one($id);

            $this->model->setImgOrigin(true);
            $this->oldImg = $this->model->img;
        }
        $this->setData($request->except('_token', 'first_title', 'second_title', 'desc', 'img', 'sort', '_method'));

        $this->model->fill($this->data);
        $this->model->sort = $request->input('sort');

        $this->setData($request->only('first_title', 'second_title', 'desc'));

        return !! $this->model && $this->data && $this->fillImg($request, 'sliders');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update($request, $id)
    {
        if($this->fill($request, $id)) {

            DB::beginTransaction();
            if ($this->model->update() && $this->updateLangs()) {
                DB::commit();

                if(current(json_decode($this->oldImg)) !== current(json_decode($this->model->img))){
                    $this->oldImgUnlink('sliders');
                }
                return ['status' => trans('rep.sliders_update_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.sliders_update_error')];
    }

    /**
     * @return bool
     */
    private function updateLangs()
    {
        if ($this->model->id && current($this->data)) {

            foreach (config('settings.locales') as $lang) {
                $this->model->sliderLangs()
                    ->where('lang', $lang)
                    ->update([
                        'first_title' => $this->data['first_title'][$lang],
                        'second_title' => $this->data['second_title'][$lang],
                        'desc' => $this->data['desc'][$lang],
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
        if ($this->model = $this->one($id)) {

            $this->model->setImgOrigin(true);
            $this->oldImg = $this->model->img;

            if ($this->model->destroy($id)) {
                $this->oldImgUnlink('sliders');
                return ['status' => trans('rep.sliders_destroy_status')];
            };
        };
        return ['error' => trans('rep.sliders_destroy_error')];
    }

}