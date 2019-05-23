<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Repositories\Traits\ImagesTrait;
use App\Repositories\Traits\SortableTrait;

class BlogRepository extends Repository
{
    use SortableTrait, ImagesTrait;

    const DEFAULT_SORT = ['created_at' => 'desc'];

    /**
     * BlogRepository constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function make($arg = false)
    {
        $this->setWith(['postLang']);
        $this->setPagination(config('settings.paginate_post'));

        if (is_array($arg) && $arg['post']) {
            $this->setWhere(['id' => $arg['post']]);
            $this->setPagination(false);
            return $this->one();
        } elseif (is_array($arg) && $arg['cat']) {
            $this->setWhere(['menu_id' => $arg['cat']]);
        }
        return parent::make();
    }

    /**
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function makeAdmin()
    {
        $this->setWith(['postLang', 'menuLang']);
        $this->sortable(self::DEFAULT_SORT, $this->model->sortable);
        $this->setPagination(config('settings.backend_paginate_blog'));

        return parent::make();
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function one($arg = false)
    {
        $this->setWith(['postLangs']);
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
                return ['status' => trans('rep.blog_store_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.blog_store_error')];
    }

    /**
     * @return bool
     */
    private function storeLangs():bool
    {
        if ($this->model->id && current($this->data)) {
            foreach (config('settings.locales') as $lang) {
                $data[] = [
                    'lang' => $lang,
                    'title' => $this->data['title'][$lang],
                    'text' => $this->data['text'][$lang],
                    'post_id' => $this->model->id
                ];
            }
            return !! isset($data) && $this->model->postLangs()->createMany($data);
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
        $this->setData($request->except('_token', 'title', 'text', 'img', '_method'));

        $this->model->fill($this->data);
        $this->model->user_id = auth()->id();

        $this->setData($request->only('title', 'text'));
        return !! $this->model && $this->data && $this->fillImg($request, 'posts');
    }

    /**
     * @param $request
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
                    $this->oldImgUnlink('posts');
                }

                return ['status' => trans('rep.blog_update_status')];
            }
            DB::rollBack();
        }
        return ['error' => trans('rep.blog_update_error')];
    }

    /**
     * @return bool
     */
    private function updateLangs()
    {
        if ($this->model->id && current($this->data)) {

            foreach (config('settings.locales') as $lang) {
                $this->model->postLangs()
                    ->where('lang', $lang)
                    ->update([
                        'title' => $this->data['title'][$lang],
                        'text' => $this->data['text'][$lang]
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
                $this->oldImgUnlink('posts');
                return ['status' => trans('rep.blog_destroy_status')];
            };
        };
        return ['error' => trans('rep.blog_destroy_error')];
    }
}