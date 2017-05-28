@extends('layouts.admin')

@section('content')
    <h1>Edit Program {{ $model->name }}</h1>
    {!! Form::model($model, ['method' => 'PATCH', 'route' => ['admin.programs.update', $model->id]]) !!}
        <fieldset>
            @include('programs._form', ['submitButtonText' => 'Update Program'])
        </fieldset>
    {!! Form::close() !!}

    <hr>
    @include('program_semesters._index', ['model' => $model])

    <hr>
    @include('program_requirements._index', ['model' => $model])

@endsection

@section('scripts')
    @include('layouts._select2js')
@endsection