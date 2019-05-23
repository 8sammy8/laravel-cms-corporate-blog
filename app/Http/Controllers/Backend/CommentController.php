<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\CommentsRepository;

class CommentController extends BackendController
{
    /**
     * CommentController constructor.
     * @param CommentsRepository $commentsRepository
     */
    public function __construct(CommentsRepository $commentsRepository)
    {
        parent::__construct();

        $this->rep = $commentsRepository;

        $this->template .= 'comment.';
        $this->title .= ' Comment';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title .= ' view';
        $this->vars = array_add($this->vars, 'comments', $this->rep->makeAdmin()
            ->appends(\Illuminate\Support\Facades\Request::except('page')));
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        $this->title .= ' edit';
        $this->vars = array_add($this->vars, 'comment',  $this->rep->one($id));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $result = $this->rep->update($request, $id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.comments.index')->with($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = $this->rep->destroy($id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.comments.index')->with($result);
    }

}
