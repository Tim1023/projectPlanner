@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Career {{ $model->name }}
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['method' => 'PATCH', 'route' => ['admin.careers.update', $model->id]]) !!}
                @include('careers._form', ['submitButtonText' => 'Update Career'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
