@extends('backend.layouts.main')

@push('head')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{asset('ksl-stat/css/style_ip.css')}}" rel="stylesheet">
    <link href="{{asset('ksl-stat/css/jquery.toastmessage.css')}}" rel="stylesheet">
@endpush


@section('content')
    @include('backend.stat')
@endsection

@push('bottom')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('ksl-stat/js/jquery.toastmessage.js')}}"></script>
    <script src="{{asset('ksl-stat/js/api-ip.js')}}"></script>
@endpush

