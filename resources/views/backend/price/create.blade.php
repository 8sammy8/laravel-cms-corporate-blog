@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Add price</h1>
            </div>
            <div class="row-fluid single-project">
                @include('backend.price.form')
            </div>
        </div>
    </div>
@endsection