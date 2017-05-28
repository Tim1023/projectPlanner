@extends('layouts.admin')

@section('content')
    <h1>Edit Pathway {{ $model->name }}</h1>
    {!! Form::model($model, ['method' => 'PATCH', 'route' => ['admin.pathways.update', $model->id]]) !!}
    <fieldset>
        @include('pathways._form', ['submitButtonText' => 'Update Pathway'])
    </fieldset>
    {!! Form::close() !!}

    <hr>
    @include('pathway_semesters._index', ['model' => $model, 'program_id' => $model->program_id])

@endsection


@section('scripts')
    @include('layouts._select2js')
@endsection