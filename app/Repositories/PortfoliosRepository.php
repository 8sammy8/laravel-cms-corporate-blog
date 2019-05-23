<?php

namespace App\Repositories;

use App\Models\Portfolio;
use Illuminate\Support\Facades\DB;
use App\Repositories\Traits\ImagesTrait;

class PortfoliosRepository extends Repository
{
    use ImagesTrait;

    /**
     * PortfoliosRepository constructor.
     * @param Portfolio $portfolio
     */
    public function __construct(Portfolio $portfolio)
    {
        $this->model = $portfolio;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        $this->setWith(['portfolioLang', 'filterLang']);
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
        $this->setWith(['portfolioLangs']);
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
                return ['status' => trans('rep.portfolios_store_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.portfolios_store_error')];
    }

    /**
     * @return bool
     */
    private function storeLangs()
    {
        if ($this->model->id && current($this->data)) {
            foreach ($this->data as $lang => $text) {
                $this->data[$lang] = [
                    'lang' => $lang,
                    'text' => $text,
                    'portfolio_id' => $this->model->id
                ];
            }
            return !! isset($this->data) && $this->model->portfolioLangs()->createMany($this->data);
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

            $this->model->setImgOrigin(true);
            $this->oldImg = $this->model->img;
        }
        $this->setData($request->except('_token', 'text', 'sort', 'img', '_method'));

        $this->model->fill($this->data);
        $this->model->sort = $request->input('sort');

        $this->setData($request->input('text'));
        return !! $this->model && $this->data && $this->fillImg($request, 'portfolios');
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
                    $this->oldImgUnlink('portfolios');
                }

                return ['status' => trans('rep.portfolios_update_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.portfolios_update_error')];
    }

    /**
     * @return bool
     */
    private function updateLangs()
    {
        if ($this->model->id && current($this->data)) {

            foreach ($this->data as $lang => $text) {
                $this->model->portfolioLangs()
                    ->where('lang', $lang)
                    ->update(['text' => $text]);
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
                $this->oldImgUnlink('portfolios');
                return ['status' => trans('rep.portfolios_destroy_status')];
            };
        };
        return ['error' => trans('rep.portfolios_destroy_error')];
    }

}