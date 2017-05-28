@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Career
        </div>
        <div class="panel-body">
            {!! Form::open(['url' => 'admin.careers.store']) !!}
                @include('careers._form', ['submitButtonText' => 'Add Career'])
            {!! Form::close() !!}
        </div>
    </div>
@endsection
