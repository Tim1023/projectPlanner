@extends('layouts.admin')

@section('pageTitle')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Program
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'admin.programs.store']) !!}
                @include('programs._form', ['submitButtonText' => 'Add Program'])
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('scripts')
    @include('layouts._select2js')
@endsection