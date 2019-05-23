@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Edit post</h1>
            </div>
            <div class="row-fluid single-project">
                @if($post && $postLangs && $menuArray)
                    <ul>

                        <li>
                            {{ Form::label('menu_id', 'Select menu', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $menuArray[$post->menu_id] }}</h5>
                            </div>
                        </li>

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('title[' . $locale . ']', 'Title (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $postLangs[$locale]->title }}</h5>
                                </div>
                            </li>
                        @endforeach

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('text[' . $locale . ']', 'Text (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $postLangs[$locale]->text }}</h5>
                                </div>
                            </li>
                        @endforeach

                        <li>
                            {{ Form::label('keywords', 'Keywords', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $post->keywords }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('meta_desc', 'Meta description', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $post->meta_desc }}</h5>
                            </div>
                        </li>

                        @if(isset($post->img) && file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.post') . DIRECTORY_SEPARATOR . $post->img))
                            <li>
                                <div class="span6">
                                    <img src="{{ asset(config('img.post') . '/' . $post->img) }}" alt=""/>
                                </div>
                            </li>
                        @endif

                    </ul>
                    {{ Form::open(['url' => route('backend.blog.destroy', ['id'=> $post->id]), 'method'=>'post']) }}
                    @csrf
                    @method('delete')
                    {{ Html::link(route('backend.blog.edit', ['id' => $post->id]), 'edit', ['class' => 'btn btn-warning']) }}
                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
@endsection