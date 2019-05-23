<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MessagesRepository;

class MessageController extends Controller
{
    /**
     * @var MessagesRepository
     */
    protected $rep;

    /**
     * MessageController constructor.
     * @param MessagesRepository $messagesRepository
     */
    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->rep = $messagesRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json($this->rep->store($request));
    }
}
