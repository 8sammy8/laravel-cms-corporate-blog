@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Show slider</h1>
            </div>
            <div class="row-fluid single-project">
                @if($slider && $sliderLangs)
                    <ul>
                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('first_title[' . $locale . ']', 'Enter first title (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $sliderLangs[$locale]->first_title  }}</h5>
                                </div>
                            </li>
                        @endforeach

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('second_title[' . $locale . ']', 'Enter second title (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $sliderLangs[$locale]->second_title }}</h5>
                                </div>
                            </li>
                        @endforeach

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('desc[' . $locale . ']', 'Enter description (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $sliderLangs[$locale]->desc }}</h5>
                                </div>
                            </li>
                        @endforeach

                        <li>
                            {{ Form::label('path', 'Enter path', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $slider->path }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $slider->sort }}</h5>
                            </div>
                        </li>

                        @if(isset($slider->img) && file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.slider') . DIRECTORY_SEPARATOR . $slider->img))
                            <li>
                                <div class="span6">
                                    <img src="{{ asset(config('img.slider') . '/' . $slider->img) }}" alt="{{ $slider->path }}"/>
                                </div>

                            </li>
                        @endif

                    </ul>
                    <div class="span6">
                        {{ Form::open(['url' => route('backend.sliders.destroy', ['id'=> $slider->id]), 'method'=>'post']) }}
                        @csrf
                        @method('delete')
                        {{ Html::link(route('backend.sliders.edit', ['id' => $slider->id]), 'edit', ['class' => 'btn btn-warning']) }}
                        {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection