@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Messages</h1>
            </div>

            <div id="slidingDiv" class="row-fluid single-project">
                @if($messages && $messages->isNotEmpty())
                    <table class="table table-inverse text-center">
                        <thead>
                        <tr>
                            <th>@sort_link('name', 'Name')</th>
                            <th>@sort_link('email', 'Email')</th>
                            <th>Short text</th>
                            <th>@sort_link('created_at', 'Time')</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ str_limit($message->text, config('settings.backend_str_limit_message')) }}</td>
                                <td>{{ $message->created_at }}</td>
                                <td>
                                    {{ Form::open(['url' => route('backend.messages.destroy', ['id'=> $message->id]), 'method'=>'message']) }}
                                    @csrf
                                    @method('delete')
                                    {{ Html::link(route('backend.messages.show', ['id' => $message->id]), 'show', ['class' => 'btn btn-warning']) }}
                                    {{ Form::button('delete', ['class'=> 'btn btn-danger', 'type'=>'submit']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>

        </div>
        <div class="post-div-nav">

            @if($messages->lastPage() > 1)
                <ul class="post-nav">
                    @if($messages->currentPage() !== 1)
                        <li>
                            <a href="{{ $messages->url($messages->currentPage() - 1) }}">
                                <i class="icon-left-open"></i>
                            </a>
                        </li>
                    @endif

                    @for($i = 1; $i <= $messages->lastPage(); $i++)
                        @if($messages->currentPage() == $i)
                            <li><a class="selected disabled">{{ $i }}</a></li>
                        @else
                            <li><a href="{{ $messages->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor

                    @if($messages->currentPage() !== $messages->lastPage())
                        <li>
                            <a href="{{ $messages->url($messages->currentPage() + 1) }}">
                                <i class="icon-right-open"></i>
                            </a>
                        </li>
                    @endif

                </ul>
            @endif
        </div>


    </div>

@endsection


