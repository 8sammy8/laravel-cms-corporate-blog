@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Edit menu</h1>
            </div>
            <div class="row-fluid single-project">
                @if($menu && $menuLangs)
                    @include('backend.menu.form')
                @endif
            </div>
        </div>
    </div>
@endsection