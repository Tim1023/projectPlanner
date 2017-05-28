@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Course {{ $model->name }}
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['method' => 'PATCH', 'route' => ['admin.courses.update', $model->id]]) !!}
                @include('courses._form', ['submitButtonText' => 'Update Course'])
            {!! Form::close() !!}
        </div>

    </div>
@endsection

@section('scripts')
    @include('layouts._select2js')
@endsection