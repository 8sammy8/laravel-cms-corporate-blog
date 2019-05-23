@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Show portfolio</h1>
            </div>
            <div class="row-fluid single-project">
                @if($portfolio && $portfolioLangs)
                    <ul>
                        <li>
                            {{ Form::label('title', 'Enter title', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $portfolio->title }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('customer', 'Enter customer', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $portfolio->customer }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('site', 'Enter site', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $portfolio->site ?? $portfolio->site }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('skills', 'Enter skills', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $portfolio->skills }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $portfolio->sort }}</h5>
                            </div>
                        </li>

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('text[' . $locale . ']', 'Enter text (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend">
                                    <h5>{{ $portfolioLangs[$locale]->text }}</h5>
                                </div>
                            </li>
                        @endforeach

                        <li>
                            {{ Form::label('filter_id', 'Select filter', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $portfolio->filterLang->title }}</h5>
                            </div>
                        </li>

                        @if(isset($portfolio->img) && file_exists(public_path() . DIRECTORY_SEPARATOR . config('img.portfolio') . DIRECTORY_SEPARATOR . $portfolio->img))
                            <li>
                                <div class="span6">
                                    <img src="{{ asset(config('img.portfolio') . '/' . $portfolio->img) }}" alt="{{ $portfolio->title }}"/>
                                </div>

                            </li>
                        @endif

                    </ul>
                    <div class="span6">
                        {{ Form::open(['url' => route('backend.portfolios.destroy', ['id'=> $portfolio->id]), 'method'=>'post']) }}
                        @csrf
                        @method('delete')
                        {{ Html::link(route('backend.portfolios.edit', ['id' => $portfolio->id]), 'edit', ['class' => 'btn btn-warning']) }}
                        {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection