<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Request;
use App\Repositories\MessagesRepository;

class MessageController extends BackendController
{
    /**
     * MessageController constructor.
     * @param MessagesRepository $messageRepository
     */
    public function __construct(MessagesRepository $messageRepository)
    {
        parent::__construct();

        $this->rep = $messageRepository;

        $this->template .= 'message.';
        $this->title .= ' Message';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' view';
        $this->vars = array_add($this->vars, 'messages', $this->rep->make()->appends(Request::except('page')));
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     */
    public function show($id)
    {
        $this->title .= ' show';
        $this->vars = array_add($this->vars, 'message', $this->rep->one($id));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        return back()->with($this->rep->destroy($id));
    }
}
