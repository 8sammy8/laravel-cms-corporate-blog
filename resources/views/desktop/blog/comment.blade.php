@foreach($items as $item)
    <div id="single-comment-{{ $item->id }}" style="margin-left: {{ $margin }}px">
        <div id="slidingDiv" class="row-fluid single-project">
            <div class="span2">
                {{--{{ dd($item->user->img) }}--}}
                <span class="comment-img">
                @if(isset($item->user->img) && file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.user') . DIRECTORY_SEPARATOR . $item->user->img))
                        <img src="{{ asset(config('img.user') . '/' . $item->user->img) }}" alt="{{ $item->user->name }}"/>
                    @else
                        <img src="{{ asset(config('img.user_default')) }}" alt="user_default"/>
                    @endif
                </span>
            </div>
            <div class="span10">
                <div class="project-description">
                    <div class="project-title clearfix">
                        <h3>{{ (isset($item->user->name)) ? $item->user->name : $item->name }} {{ $item->created_at->format('Y M d') }}</h3>
                    </div>
                    <p>{{ $item->text }}</p>

                    <span class="comment-reply"><a href="#comment-new" class="show_hide" onclick='return addComment.moveForm("{{ $item->id }}", "{{ $comments->max('id') }}")'> replay</a></span>
                </div>
            </div>

        </div>
    </div>
    @if($comments->where('parent_id', $item->id)->isNotEmpty())
        @include(config('theme.desktop') . '.blog.comment', [
       'items' => $comments->where('parent_id', $item->id)->sortBy('created_at'),
       'margin' => $margin + 20])
    @endif

@endforeach