<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Message;
use App\Notifications\ContactMessage;
use App\Repositories\Traits\SortableTrait;

class MessagesRepository extends Repository
{
    use SortableTrait;

    const DEFAULT_SORT = ['created_at' => 'desc'];

    /**
     * MessagesRepository constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    /**
     * @param bool $arg
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function make($arg = false)
    {
        $this->sortable(self::DEFAULT_SORT, $this->model->sortable);
        $this->setPagination(config('settings.backend_paginate_message'));

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
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store($request)
    {
        if($this->fill($request) && !$this->validator()->fails() && $this->model->save())
        {
            User::find(1)->notify(new ContactMessage($this->model));
            return ['success'=>true];
        }
        return ['error' => true];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function fill($request)
    {
        $this->setData([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'text' => $request->input('comment'),
        ]);

        return !! $this->model->fill($this->data);
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator()
    {
        return validator()->make($this->data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'text' => 'required|string|max:5000',
        ]);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        if ($this->model->where('id', $id)->delete()) {
            return ['status' => trans('rep.messages_destroy_status')];
        }
        return ['error' => trans('rep.messages_destroy_error')];
    }
}