<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostRequest;
use App\Repositories\BlogRepository;
use App\Repositories\MenusRepository;

class BlogController extends BackendController
{
    /**
     * @var MenusRepository
     */
    protected $menu_rep;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     * @param MenusRepository $menusRepository
     */
    public function __construct(BlogRepository $blogRepository, MenusRepository $menusRepository)
    {
        parent::__construct();

        $this->rep = $blogRepository;
        $this->menu_rep = $menusRepository;

        $this->template .= 'blog.';
        $this->title .= 'Blog';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->title = ' posts view';
        $this->vars = array_add($this->vars, 'posts', $this->rep->makeAdmin());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->title .= ' create';
        $this->vars = array_add($this->vars, 'menuArray', $this->menu_rep->makeArray());
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PostRequest $request)
    {
        $result = $this->rep->store($request);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.blog.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $this->title .= ' show';
        $this->one($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->title .= ' edit';
        $this->one($id);
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PostRequest $request, $id)
    {
        $result = $this->rep->update($request, $id);

        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect()->route('backend.blog.index')->with($result);
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
        return redirect()->route('backend.blog.index')->with($result);
    }

    /**
     * @param $id
     */
    private function one($id)
    {
        $post = $this->rep->one($id);

        $this->vars = array_add($this->vars, 'menuArray', $this->menu_rep->makeArray());

        if ($post) $this->vars = array_add($this->vars, 'post', $post);
        $this->vars = array_add($this->vars, 'postLangs', $post->postLangs->keyBy('lang'));
    }
}
