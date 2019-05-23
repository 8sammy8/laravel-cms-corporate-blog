@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Show filter</h1>
            </div>
            <div class="row-fluid single-project">
                @if($filter && $filterLangs)
                    <ul>
                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('title[' . $locale . ']', 'Enter title (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $filterLangs[$locale]->title }}</h5>
                                </div>
                            </li>
                        @endforeach

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('desc[' . $locale . ']', 'Enter description (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ implode(',', $filterLangs[$locale]->desc) }}</h5>
                                </div>
                            </li>
                        @endforeach

                        <li>
                            {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $filter->sort }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('price', 'Enter price', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $filter->price }}</h5>
                            </div>
                        </li>

                    </ul>
                    <div class="span6">
                        {{ Form::open(['url' => route('backend.filters.destroy', ['id'=> $filter->id]), 'method'=>'post']) }}
                        @csrf
                        @method('delete')
                        {{ Html::link(route('backend.filters.edit', ['id' => $filter->id]), 'edit', ['class' => 'btn btn-warning']) }}
                        {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection