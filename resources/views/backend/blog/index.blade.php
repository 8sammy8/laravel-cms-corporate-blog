@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Blog posts</h1>
            </div>

            <div class="row-fluid single-project">
                @if($posts && $posts->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>@sort_link('user_id', 'User')</th>
                            <th>@sort_link('menu_id', 'Menu')</th>
                            <th>@sort_link('created_at', 'Time')</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ Html::link(route('backend.blog.edit', ['id' => $post->id]), $post->postLang->title) }}</td>
                                <td>{{ $post->user_id }}</td>
                                <td>{{ $post->menuLang->title }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    {{ Form::open(['url' => route('backend.blog.destroy', ['id'=> $post->id]), 'method'=>'post']) }}
                                    @csrf
                                    @method('delete')
                                    {{ Html::link(route('backend.blog.show', ['id' => $post->id]), 'show', ['class' => 'btn btn-warning']) }}
                                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            {!! Html::link(route('backend.blog.create'), 'Add post', ['class'=> 'btn btn-primary']) !!}
        </div>

    </div>

@endsection

