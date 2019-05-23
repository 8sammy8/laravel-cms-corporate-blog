<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentsRepository;

class CommentController extends Controller
{
    /**
     * @var CommentsRepository
     */
    protected $rep;

    /**
     * CommentController constructor.
     * @param CommentsRepository $commentsRepository
     */
    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->rep = $commentsRepository;
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
