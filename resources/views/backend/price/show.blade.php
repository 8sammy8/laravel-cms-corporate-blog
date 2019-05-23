@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Show price</h1>
            </div>
            <div class="row-fluid single-project">
                @if($price && $priceLangs)

                    <ul>
                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('title[' . $locale . ']', 'Enter title (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                                    <h5>{{ $priceLangs[$locale]->title }}</h5>
                                </div>
                            </li>
                        @endforeach

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('bonus[' . $locale . ']', 'Enter bonus (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                                    <h5>{{ (isset($priceLangs[$locale]->bonus) && current($priceLangs[$locale]->bonus)) ?? implode(',', $priceLangs[$locale]->bonus) }}</h5>
                                </div>
                            </li>
                        @endforeach

                        @foreach(config('settings.locales') as $locale)
                            <li>
                                {{ Form::label('options[' . $locale . ']', 'Enter options (' . $locale . ')', ['class' => 'control-label']) }}
                                <div class="input-prepend"><span class="add-on"><i class="icon-location"></i></span>
                                    <h5>{{ (isset($priceLangs[$locale]->options) && current($priceLangs[$locale]->options)) ?? implode(',', $priceLangs[$locale]->options) }}</h5>
                                </div>
                            </li>
                        @endforeach

                        <li>
                            {{ Form::label('price', 'Enter price', ['class' => 'control-label']) }}
                            <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
                                <h5>{{ $price->price }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('sort', 'Sort number', ['class' => 'control-label']) }}
                            <div class="input-prepend"><span class="add-on"><i class="icon-plus"></i></span>
                                <h5>{{ $price->sort }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('filter_id', 'Select filter', ['class' => 'control-label']) }}
                            <div class="input-prepend"><span class="add-on"><i class="icon-desktop"></i></span>
                                <h5>{{ $price->filterLang->title }}</h5>
                            </div>
                        </li>

                    </ul>
                    <div class="span6">
                        {{ Form::open(['url' => route('backend.prices.destroy', ['id'=> $price->id]), 'method'=>'post']) }}
                        @csrf
                        @method('delete')
                        {{ Html::link(route('backend.prices.edit', ['id' => $price->id]), 'edit', ['class' => 'btn btn-warning']) }}
                        {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection