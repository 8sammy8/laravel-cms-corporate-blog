@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Edit menu</h1>
            </div>
            <div class="row-fluid single-project">
                @if($menu && $menuLangs)
                    <ul>
                        <li>
                            {{ Form::label('path', 'Path', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $menu->path }}</h5>
                            </div>
                        </li>

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('title[' . $locale . ']', 'Title (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $menuLangs[$locale]->title ?? $menuLangs[$locale]->title }}</h5>
                                </div>
                            </li>
                        @endforeach

                        <li>
                            {{ Form::label('parent_id', 'Parent', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ isset($menu->parent->title) ? $menu->parent->title : 'main'}}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $menu->sort }}</h5>
                            </div>
                        </li>

                    </ul>
                    {{ Form::open(['url' => route('backend.menus.destroy', ['id'=> $menu->id]), 'method'=>'post']) }}
                    @csrf
                    @method('delete')
                    {{ Html::link(route('backend.menus.edit', ['id' => $menu->id]), 'edit', ['class' => 'btn btn-warning']) }}
                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                    {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
@endsection