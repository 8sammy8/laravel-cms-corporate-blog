@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Menus</h1>
            </div>

            <div class="row-fluid single-project">
                @if($menu && $menu->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>Parent</th>
                            <th>Title</th>
                            <th>Path</th>
                            <th>Sort</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('backend.menu.child', ['items' => $menu->where('parent_id', null)->sortBy('sort'), 'parent' => ''])
                        </tbody>
                    </table>
                @endif
            </div>
            {!! Html::link(route('backend.menus.create'), 'Add menu', ['class'=> 'btn btn-primary']) !!}
        </div>

    </div>

@endsection

