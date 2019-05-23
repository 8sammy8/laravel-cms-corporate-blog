@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Edit portfolio</h1>
            </div>
            <div class="row-fluid single-project">
                @if($portfolio && $portfolioLangs)
                    @include('backend.portfolio.form')
                @endif
            </div>
        </div>
    </div>
@endsection