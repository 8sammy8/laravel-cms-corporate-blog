<?php

namespace App\Repositories;

use App\Models\Subscribe;
use App\Notifications\Subscribe as SubscribeMessage;

class SubscribesRepository extends Repository
{
    /**
     * SubscribesRepository constructor.
     * @param Subscribe $subscribe
     */
    public function __construct(Subscribe $subscribe)
    {
        $this->model = $subscribe;
    }

    /**
     * @param $request
     * @return array
     */
    public function store($request)
    {
        if($this->fill($request) && !$this->validator()->fails() && $this->restoreOrCreate())
        {
            return ['success'=>true];
        }
        return ['error' => true];
    }

    /**
     * @return bool
     */
    public function restoreOrCreate()
    {
        $subscribe = $this->model::onlyTrashed()->where('email', $this->data['email'])->restore();

        if (!$subscribe) {
            $subscribe = $this->model::firstOrCreate($this->data);
        }
        if ($subscribe) {
            $subscribe->notify(new SubscribeMessage($subscribe));
        }
        return !! $subscribe;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function fill($request)
    {
        $this->setData([
            'email' => $request->input('email'),
        ]);

        return !! $this->model->fill($this->data);
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validator()
    {
        return validator()->make($this->data, [
            'email' => 'required|email',
        ]);
    }

    /**
     * @param $hash
     * @return bool
     */
    public function destroy($hash)
    {
        return !! $this->model::where('email', decrypt($hash))->delete();
    }
}