@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Sliders</h1>
            </div>

            <div class="row-fluid single-project">
                @if($sliders && $sliders->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>First title</th>
                            <th>Path</th>
                            <th>Sort</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{ Html::link(route('backend.sliders.edit', ['id' => $slider->id]), $slider->sliderLang->first_title) }}</td>
                                <td>{{ $slider->path }}</td>
                                <td>{{ $slider->sort }}</td>
                                <td>
                                    {{ Form::open(['url' => route('backend.sliders.destroy', ['id'=> $slider->id]), 'method'=>'post']) }}
                                    @csrf
                                    @method('delete')
                                    {{ Html::link(route('backend.sliders.show', ['id' => $slider->id]), 'show', ['class' => 'btn btn-warning']) }}
                                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            {!! Html::link(route('backend.sliders.create'), 'Add slider', ['class'=> 'btn btn-primary']) !!}
        </div>

    </div>

@endsection

