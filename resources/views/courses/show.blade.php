@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>{{ $model->course_number }} - {{ $model->name }}</h1>
            <h4>{{ $model->department->name }}</h4>
            <p>{{ $model->level_name }} | {{ $model->credit_points }}</p>
            <p>{!!  $model->description !!}</p>

            @unless($model->pre_requisites->isEmpty())
                <h4>Pre-requisites</h4>
                <ul>
                    @foreach($model->pre_requisites as $pre_requisite)
                        <li>
                            <a href="{{ route('admin.courses.show', ['id' => $pre_requisite->id]) }}">
                                {{ $pre_requisite->full_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endunless
            @unless($model->co_requisites->isEmpty())
                <h4>Co-requisites</h4>
                <ul>
                    @foreach($model->co_requisites as $co_requisite)
                        <li>
                            <a href="{{ route('admin.courses.show', ['id' => $co_requisite->id]) }}">
                                {{ $co_requisite->full_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endunless
        </div>
    </div>
@endsection
