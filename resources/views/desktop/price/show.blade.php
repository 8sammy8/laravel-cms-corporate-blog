@extends(config('theme.desktop') . '.layouts.main')

@section('layouts.service')
    @include(config('theme.desktop') . '.layouts.service')
@endsection

@section('price.tariff')
    {!! $tariff !!}
@endsection

@section('layouts.price')
    {!! $price !!}
@endsection