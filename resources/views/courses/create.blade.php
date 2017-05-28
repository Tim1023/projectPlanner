@extends('layouts.admin')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Course
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'admin.courses.store']) !!}
                @include('courses._form', ['submitButtonText' => 'Add Course'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    @include('layouts._select2js')
@endsection