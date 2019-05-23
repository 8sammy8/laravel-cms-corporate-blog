@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Comments</h1>
            </div>

            <div id="slidingDiv" class="row-fluid single-project">
                @if($comments && $comments->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>@sort_link('name', 'Name')</th>
                            <th>@sort_link('email', 'Email')</th>
                            <th>@sort_link('status', 'Status')</th>
                            <th>@sort_link('post_id', 'Post')</th>
                            <th>@sort_link('user_id', 'User')</th>
                            <th>Short text</th>
                            <th>@sort_link('created_at', 'Time')</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->status }}</td>
                                <td>{{ $comment->post_id }}</td>
                                <td>{{ ($comment->user_id) ? $comment->user->name : '' }}</td>
                                <td>{{ Html::link(route('backend.comments.edit', ['id' => $comment->id]), str_limit($comment->text, config('settings.backend_str_limit_comment'))) }}</td>
                                <td>{{ $comment->created_at }}</td>
                                <td>
                                    {{ Form::open(['url' => route('backend.comments.destroy', ['id'=> $comment->id]), 'method'=>'comment']) }}
                                    @csrf
                                    @method('delete')
                                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>

        </div>
        <div class="post-div-nav">

            @if($comments->lastPage() > 1)
                <ul class="post-nav">
                    @if($comments->currentPage() !== 1)
                        <li>
                            <a href="{{ $comments->url($comments->currentPage() - 1) }}">
                                <i class="icon-left-open"></i>
                            </a>
                        </li>
                    @endif

                    @for($i = 1; $i <= $comments->lastPage(); $i++)
                        @if($comments->currentPage() == $i)
                            <li><a class="selected disabled">{{ $i }}</a></li>
                        @else
                            <li><a href="{{ $comments->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor

                    @if($comments->currentPage() !== $comments->lastPage())
                        <li>
                            <a href="{{ $comments->url($comments->currentPage() + 1) }}">
                                <i class="icon-right-open"></i>
                            </a>
                        </li>
                    @endif

                </ul>
            @endif
        </div>


    </div>

@endsection


