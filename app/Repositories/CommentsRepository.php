<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Repositories\Traits\SortableTrait;

class CommentsRepository extends Repository
{
    use SortableTrait;

    const STATUS_MODERATED = 1;
    const DEFAULT_SORT = ['created_at' => 'desc'];

    /**
     * CommentsRepository constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        if ($arg) {
            $this->setWith(['user']);
            $this->setWhere(['post_id' => $arg, 'status' => self::STATUS_MODERATED]);
            return parent::make();
        }
        return false;
    }

    /**
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function makeAdmin()
    {
        $this->sortable(self::DEFAULT_SORT, $this->model->sortable);
        $this->setPagination(config('settings.backend_paginate_comment'));

        return parent::make();
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object
     */
    public function one($arg = false)
    {
        $this->setWhere(['id' => $arg]);

        return parent::one();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store($request)
    {
        if($this->fill($request) && !$this->validator()->fails())
        {
            if(auth()->user()){
                $this->model->user_id = auth()->id();
            }
            $post = Post::find($this->data['post_id']);
            $post->comments()->save($this->model);

            return ['success'=>true];
        }
        return ['error' => true];
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function fill($request)
    {
        $this->setData([
            'post_id' => $request->input('comment_post_ID'),
            'text' => $request->input('comment'),
            'parent_id' => $request->input('comment_parent'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return !! $this->model->fill($this->data);
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator()
    {
        $validator = validator()->make($this->data, [
            'post_id' => 'required|integer',
            'text' => 'required|string',
        ]);
        $validator->sometimes(['name', 'email'], 'required:max:255', function(){
            return !auth()->check();
        });
        return $validator;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update($request, $id)
    {
        $this->model = $this->one($id);
        $this->model->fill($request->only('text', 'status'));

        $this->setData([
            'post_id' => $this->model->id,
            'text' => $request->input('text')
        ]);

        if ($this->model->update() && !$this->validator()->fails())
        {
            return ['status' => trans('rep.comments_update_status')];
        }
        return ['error' => trans('rep.comments_update_error')];
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        if ($this->model->where('id', $id)->delete()) {
            return ['status' => trans('rep.comments_destroy_status')];
        };
        return ['error' => trans('rep.comments_destroy_error')];
    }
}