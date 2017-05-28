@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Department {{ $department->name }}
        </div>
        <div class="panel-body">
            {!! Form::model($department, ['method' => 'PATCH', 'route' => ['admin.departments.update', $department->id]]) !!}
                @include('departments._form', ['submitButtonText' => 'Update Department'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
