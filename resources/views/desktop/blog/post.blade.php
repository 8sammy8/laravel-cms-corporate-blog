@if($post)
    <!-- Post section start -->
    <div class="section secondary-section " id="portfolio">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>{{ $post->postLang->title }}</h1>
            </div>

            <!-- Start details for blog post -->
            <div id="single-project">
                <div id="slidingDiv" class="row-fluid single-project">

                    <div class="span12">
                        <div class="project-description">
                            @if(file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.post') . DIRECTORY_SEPARATOR . $post->img))
                                <span class="post-img">
                                    <img src="{{ asset(config('img.post') . '/' . $post->img) }}" alt="{{ $post->postLang->title }}"/>
                                </span>
                            @endif
                            <p> {{ $post->postLang->text }} </p>
                        </div>
                    </div>
                </div>
                <!-- End details for blog post -->

            </div>

        </div>

    </div>
    <!-- Post section end -->


    <!-- START COMMENTS -->
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>{{ __('desktop/blog.title_posts_comments') }}</h1>
                <p>Duis mollis placerat quam, eget laoreet tellus tempor eu. Quisque dapibus in purus in dignissim.</p>
            </div>

            <!-- Start comments tree post -->
        @if($comments && $comments->isNotEmpty())
            @include(config('theme.desktop') . '.blog.comment', [
            'comments' => $comments,
            'items' => $comments->where('parent_id', null)->sortBy('created_at'),
            'margin' => 0])
        @endif
        <!-- End comments tree post -->

            <div class="container" id="comment-new">
                <div class="span8 contact-form centered">
                    <h3>Your comment</h3>

                    <div id="comment-successSend" class="alert alert-success invisible">
                        <strong>Well done!</strong> Your commit has been sent and public after moderate.
                    </div>
                    <div id="comment-errorSend" class="alert alert-error invisible">There was an error.</div>
                    <div class="control-group">
                        <a rel="nofollow" id="cancel-comment-reply-link" href="#comment-new" style="display:none;">Cancel reply</a>
                    </div>
                    <form action="{{ route('comment.store') }}" id="comment-form">
                        @if(!Auth::check())
                            <div class="control-group">
                                <div class="controls">
                                    <input class="span8" type="text" id="comment-name" name="name" placeholder="* Your name..."/>

                                    <div class="error left-align" id="err-commit-name">Please enter name.</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input class="span8" type="email" name="email" id="comment-email" placeholder="* Your email..."/>

                                    <div class="error left-align" id="err-commit-email">Please enter valid email adress.</div>
                                </div>
                            </div>
                        @else
                            <script>
                                var user_id = {{ auth()->user()->id }};
                            </script>
                        @endif
                        <div class="control-group">
                            <div class="controls">
                                <textarea class="span8" name="comment" id="comment-text" placeholder="* Comments..."></textarea>

                                <div class="error left-align" id="err-commit-comment">Please enter your comment.</div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button id="send-commit" class="message-btn">Send comment</button>
                            </div>
                        </div>
                        @csrf
                        <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $post->id }}"/>
                        <input id="comment_parent" type="hidden" name="comment_parent" value=""/>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!-- END COMMENTS -->

@endif