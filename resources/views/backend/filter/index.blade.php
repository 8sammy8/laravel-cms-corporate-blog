@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Filters</h1>
            </div>

            <div class="row-fluid single-project">
                @if($filters && $filters->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Sort</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($filters as $filter)
                            <tr>
                                <td>{{ Html::link(route('backend.filters.edit', ['id' => $filter->id]), $filter->filterLang->title) }}</td>
                                <td>{{ $filter->sort }}</td>
                                <td>{{ $filter->price }}</td>
                                <td>
                                    {{ Form::open(['url' => route('backend.filters.destroy', ['id'=> $filter->id]), 'method'=>'post']) }}
                                    @csrf
                                    @method('delete')
                                    {{ Html::link(route('backend.filters.show', ['id' => $filter->id]), 'show', ['class' => 'btn btn-warning']) }}
                                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            {!! Html::link(route('backend.filters.create'), 'Add filter', ['class'=> 'btn btn-primary']) !!}
        </div>

    </div>

@endsection

