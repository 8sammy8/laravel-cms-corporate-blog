@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Edit price</h1>
            </div>
            <div class="row-fluid single-project">
                @if($price && $priceLangs)
                    @include('backend.price.form')
                @endif
            </div>
        </div>
    </div>
@endsection