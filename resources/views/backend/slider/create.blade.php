@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Add slider</h1>
            </div>
            <div class="row-fluid single-project">
                @include('backend.slider.form')
            </div>
        </div>
    </div>
@endsection