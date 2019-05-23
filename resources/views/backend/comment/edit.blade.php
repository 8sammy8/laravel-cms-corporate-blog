@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Edit comment</h1>
            </div>
            <div class="row-fluid single-project">
                @if($comment)
                    {{ Form::open([
                                    'url' => route('backend.comments.update', ['id' => $comment->id]),
                                    'class' => 'form-control',
                                    'method' => 'post',
                                    'enctype' => 'multipart/form-data']) }}

                    <ul>

                        <li>
                            {{ Form::label('text', 'Edit text', ['class' => 'control-label']) }}
                            <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
                                {{ Form::text('text', isset($comment->text) ? $comment->text : old('text'), [
                                        'id' => 'text',
                                        'placeholder' => 'Text',
                                        'class' => 'form-control'
                                ]) }}
                            </div>
                            {{ $errors->first('text') }}
                        </li>

                        <li>
                            {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ Form::select('status',
                                [
                                    '' => 'Not moderate',
                                    1 => 'Moderated',
                                    2 => 'Blocked',
                                ],
                                $comment->status ?? '') }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $comment->name ?? $comment->name }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $comment->email ?? $comment->email }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('parent_id', 'Parent', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $comment->parent_id ?? $comment->parent_id }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('post_id', 'Post', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $comment->post_id ?? $comment->post_id }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('user_id', 'User', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $comment->user_id ?? $comment->user_id }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('created_at', 'Time', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $comment->created_at ?? $comment->created_at }}</h5>
                            </div>
                        </li>

                    </ul>
                        {!! Form::hidden('_method', 'PUT') !!}
                    <div class="span">
                        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                    </div>

                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
@endsection