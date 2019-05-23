@extends(config('theme.desktop') . '.layouts.main')

@section('blog.posts')
    {!! $post !!}
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset(config('theme.desktop')) }}/css/comment.css"/>
@endpush

@push('js_bottom')
    <script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/comment.js"></script>
    <script type="text/javascript" src="{{ asset(config('theme.desktop')) }}/js/comment-reply.js"></script>
@endpush

@section('layouts.price')
    {!! $price !!}
@endsection