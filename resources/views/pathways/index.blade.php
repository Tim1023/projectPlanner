@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a class="btn btn-primary" href="{{ route("admin.pathways.create") }}">
                <i class="fa fa-plus"></i>&nbsp;New Pathway
            </a>
        </div>
        <div class="panel-body">
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th class="col-xs-5">Name</th>
                        <th class="col-xs-3">Program</th>
                        <th class="col-xs-3 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($model as $item)
                    <tr>
                        <td class="col-xs-1">{{ $item->id }}</td>
                        <td class="col-xs-5">
                            {{ $item->name }}
                        </td>
                        <td class="col-xs-3">{{ $item->program->name }}</td>
                        <td class="col-xs-3">
                            <div class="btn-group pull-right">
                                <a href="{{ route("admin.pathways.show", $item->id) }}" class="btn btn-default">
                                    <i class="fa fa-eye"></i>&nbsp;View
                                </a>
                                <a href="{{ route("admin.pathways.edit", $item->id) }}" class="btn btn-default">
                                    <i class="fa fa-pencil"></i>&nbsp;Edit
                                </a>
                                <a href="{{ route("admin.pathways.destroy", $item->id) }}" class="btn btn-default"
                                    data-method="delete"
                                    data-token="{{ csrf_token() }}">
                                    <i class="fa fa-trash"></i>&nbsp;Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
