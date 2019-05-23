@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Edit post</h1>
            </div>
            <div class="row-fluid single-project">
                @if($post && $postLangs && $menuArray)
                    @include('backend.blog.form')
                @endif
            </div>
        </div>
    </div>
@endsection

@push('head')
    <script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/ckeditor/ckeditor.js"></script>
@endpush