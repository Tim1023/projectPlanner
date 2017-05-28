@extends('layouts.admin')

@section('sidebar')
    @include('admin._sidebar', ['active' => 'departments'])
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Department
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'admin.departments.store']) !!}
                @include('departments._form', ['submitButtonText' => 'Add Department'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
