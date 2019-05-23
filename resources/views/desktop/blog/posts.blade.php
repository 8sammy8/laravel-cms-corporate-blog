@if($posts && $posts->isNotEmpty())
    <!-- Posts section start -->
    <div class="section secondary-section " id="portfolio">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Blog posts</h1>

                <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
            </div>

            <!-- Start details for blog post -->
            <div id="single-project">
                @foreach($posts as $post)
                    <div id="slidingDiv" class="row-fluid single-project">
                        <div class="span6">
                            @if(file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.post') . DIRECTORY_SEPARATOR . $post->img))
                                <a href="{{ route('blogPost', ['cat' => $post->menu_id, 'post' => $post->id]) }}"><img
                                            src="{{ asset(config('img.post') . '/' . $post->img) }}"
                                            alt="{{ $post->postLang->title }}"/></a>
                            @endif
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <a href="{{ route('blogPost', ['cat' => $post->menu_id, 'post' => $post->id]) }}">
                                        <h3>{{ $post->postLang->title }}</h3></a>
                                </div>

                                <p>{{ str_limit($post->postLang->text, config('settings.str_limit_post')) }}</p>
                            </div>
                        </div>
                    </div>
            @endforeach
            <!-- End details for blog post -->

            </div>
        </div>
        <div class="post-div-nav">
            @if($posts->lastPage() > 1)
                <ul class="post-nav">
                    @if($posts->currentPage() !== 1)
                        <li>
                            <a href="{{ $posts->url($posts->currentPage() - 1) }}">
                                <i class="icon-left-open"></i>
                            </a>
                        </li>
                    @endif

                    @for($i = 1; $i <= $posts->lastPage(); $i++)
                        @if($posts->currentPage() == $i)
                            <li><a class="selected disabled">{{ $i }}</a></li>
                        @else
                            <li><a href="{{ $posts->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor

                    @if($posts->currentPage() !== $posts->lastPage())
                        <li>
                            <a href="{{ $posts->url($posts->currentPage() + 1) }}">
                                <i class="icon-right-open"></i>
                            </a>
                        </li>
                    @endif

                </ul>
            @endif
        </div>
    </div>
    <!-- Posts section end -->
@endif



