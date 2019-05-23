@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Prices</h1>
            </div>

            <div class="row-fluid single-project">
                @if($prices && $prices->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Sort</th>
                            <th>Filter</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prices as $price)
                            <tr>
                                <td>{{ Html::link(route('backend.prices.edit', ['id' => $price->id]), $price->priceLang->title) }}</td>
                                <td>{{ $price->price }}</td>
                                <td>{{ $price->sort }}</td>
                                <td>{{ $price->filterLang->title }}</td>
                                <td>
                                    {{ Form::open(['url' => route('backend.prices.destroy', ['id'=> $price->id]), 'method'=>'post']) }}
                                    @csrf
                                    @method('delete')
                                    {{ Html::link(route('backend.prices.show', ['id' => $price->id]), 'show', ['class' => 'btn btn-warning']) }}
                                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            {!! Html::link(route('backend.prices.create'), 'Add price', ['class'=> 'btn btn-primary']) !!}
        </div>

    </div>

@endsection

