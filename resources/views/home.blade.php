@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>Dashboard</h1>

            @can('admin-access')
                <a href="{{ url('admin') }}">Admin Dashboard</a>
            @endcan

        </div>
    </div>
@endsection
