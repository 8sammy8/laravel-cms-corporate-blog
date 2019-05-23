<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Repositories\SubscribesRepository;
use Illuminate\Http\Request;

class SubscribeController extends FrontendController
{
    protected $subscribe_rep;

    public function __construct(SubscribesRepository $subscribesRepository)
    {
        parent::__construct();

        $this->subscribe_rep = $subscribesRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json($this->subscribe_rep->store($request));
    }

    /**
     * @param $hash
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($hash)
    {
        $this->template = $this->theme . '.unsubscribe.unsubscribe';

        $this->vars = array_merge($this->vars, compact('hash'));

        return $this->renderOutput();
    }

    /**
     * @param $hash
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($hash)
    {
        if ($this->subscribe_rep->destroy($hash)) {
            return redirect('/')->with(['status' => trans('controllers.status_unsubscribe')]);
        }
        return back()->with(['error' => trans('controllers.error_unsubscribe')]);
    }
}
