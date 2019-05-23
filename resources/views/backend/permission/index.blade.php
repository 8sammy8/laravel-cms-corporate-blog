@extends('backend.layouts.main')

@section('content')
    <div class="section secondary-section ">
        <div class="triangle"></div>
        <div class="container">
            <div class=" title">
                <h1>Permissions</h1>
            </div>
{{--{{ dd($roles) }}--}}
            <div class="row-fluid single-project">
                {!! Form::open([
                'url' => route('backend.permissions.store'),
                'class' => 'form-horizontal',
                'method' => 'post'
                ]) !!}
                <table class="table table-inverse text-center">
                    <thead>
                    <tr>
                        <th>Permissions</th>
                        @if($roles && $roles->isNotEmpty())
                            @foreach($roles as $role)
                                <th>{{ $role->name }}</th>
                            @endforeach
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @if($permissions->isNotEmpty())
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                @if($roles && $roles->isNotEmpty())
                                    @foreach($roles as $role)
                                        <td>
                                            <input {{ $role->hasPermission($permission->name) ? 'checked' : '' }} name="role_{{ $role->id }}[]" type="checkbox" value="{{ $permission->id }}"/>
                                        </td>
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>

                {!! Form::button('Update', ['class'=> 'btn btn-danger', 'type'=>'submit']) !!}

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection

