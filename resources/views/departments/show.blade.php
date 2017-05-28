@extends('layouts.admin')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>{{ $department->name }}</h1>
            <p>{{ $department->description }}</p>
        </div>
    </div>
@endsection
