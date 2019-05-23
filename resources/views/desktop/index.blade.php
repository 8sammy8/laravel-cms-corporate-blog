@extends(config('theme.desktop') . '.layouts.main')

@section('slider')
    {!! $slider !!}
@endsection

@section('layouts.service')
    @include(config('theme.desktop') . '.layouts.service')
@endsection

@section('layouts.portfolio')
    {!! $portfolio !!}
@endsection

@section('layouts.about')
    {!! $about !!}
@endsection

@section('layouts.purchase')
    @include(config('theme.desktop') . '.layouts.purchase')
@endsection

@section('layouts.price')
    {!! $price !!}
@endsection