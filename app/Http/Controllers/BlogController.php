<?php

namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\CommentsRepository;
use App\Repositories\FiltersRepository;

class BlogController extends FrontendController
{
    /**
     * @var BlogRepository
     */
    protected $blog_rep;

    /**
     * @var CommentsRepository
     */
    protected $comments_rep;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     * @param FiltersRepository $filtersRepository
     * @param CommentsRepository $commentsRepository
     */
    public function __construct(BlogRepository $blogRepository, FiltersRepository $filtersRepository, CommentsRepository $commentsRepository)
    {
        parent::__construct();

        $this->blog_rep = $blogRepository;
        $this->filters_rep = $filtersRepository;
        $this->comments_rep = $commentsRepository;

        $this->template = $this->theme . '.blog.blog';
        $this->title = $this->title . trans('controllers.title_blog');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index()
    {
        $this->getContent();

        return $this->renderOutput();
    }

    /**
     * @param $cat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function cat($cat)
    {
        $this->getContent($cat);

        return $this->renderOutput();
    }

    /**
     * @param $cat
     * @param $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function post($cat, $post)
    {
        $this->getContent($cat, $post);
        return $this->renderOutput();
    }

    /**
     * @return array|string
     * @throws \Throwable
     */
    private function getPrice()
    {
        return view($this->theme . '.layouts.price')
            ->with('filters', $this->filters_rep->make())
            ->render();
    }

    /**
     * @param bool $cat
     * @param bool $post
     * @throws \Throwable
     */
    private function getContent($cat = false, $post = false)
    {
        $arg = [];
        $arg = array_merge($arg, compact('cat', 'post'));

        ($post) ? $postItem = 'post' : $postItem = 'posts';

        $posts = view($this->theme . '.blog.' . $postItem)
            ->with($postItem, $this->blog_rep->make($arg))
            ->with('comments', $this->comments_rep->make($post))
            ->render();

        $this->vars = array_add($this->vars, 'post', $posts);
        $this->vars = array_add($this->vars, 'price', $this->getPrice());
    }
}
