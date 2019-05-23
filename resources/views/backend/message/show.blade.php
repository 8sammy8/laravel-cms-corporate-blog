@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Show message</h1>
            </div>
            <div class="row-fluid single-project">
                @if($message)
                    <ul>
                        <li>
                            {{ Form::label('path', 'Name', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $message->name }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('sort', 'Email', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $message->email }}</h5>
                            </div>

                        <li>
                            {{ Form::label('sort', 'Text', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $message->text }}</h5>
                            </div>
                        </li>

                        <li>
                            {{ Form::label('sort', 'Time', ['class' => 'control-label']) }}
                            <div class="input-prepend">
                                <h5>{{ $message->created_at }}</h5>
                            </div>
                        </li>


                    </ul>
                    <div class="span6">
                        {{ Form::open(['url' => route('backend.messages.destroy', ['id'=> $message->id]), 'method'=>'post']) }}
                        @csrf
                        @method('delete')
                        {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                        {{ Form::close() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection