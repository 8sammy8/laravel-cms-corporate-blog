@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Portfolios</h1>
            </div>

            <div class="row-fluid single-project">
                @if($portfolios && $portfolios->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Customer</th>
                            <th>Site</th>
                            <th>Sort</th>
                            <th>Filter</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($portfolios as $portfolio)
                            <tr>
                                <td>{{ Html::link(route('backend.portfolios.edit', ['id' => $portfolio->id]), $portfolio->title) }}</td>
                                <td>{{ $portfolio->customer }}</td>
                                <td>{{ $portfolio->site }}</td>
                                <td>{{ $portfolio->sort }}</td>
                                <td>{{ $portfolio->filterLang->title }}</td>
                                <td>
                                    {{ Form::open(['url' => route('backend.portfolios.destroy', ['id'=> $portfolio->id]), 'method'=>'post']) }}
                                    @csrf
                                    @method('delete')
                                    {{ Html::link(route('backend.portfolios.show', ['id' => $portfolio->id]), 'show', ['class' => 'btn btn-warning']) }}
                                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            {!! Html::link(route('backend.portfolios.create'), 'Add portfolio', ['class'=> 'btn btn-primary']) !!}
        </div>

    </div>

@endsection

