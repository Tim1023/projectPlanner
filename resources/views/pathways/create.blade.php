@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Pathway
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'admin.pathways.store']) !!}
                @include('pathways._form', ['submitButtonText' => 'Add Pathway'])
            {!! Form::close() !!}
        </div>
    </div>

@endsection


@section('scripts')
    @include('layouts._select2js')
@endsection