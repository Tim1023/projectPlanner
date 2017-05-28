@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h1>{{ $model->name }}</h1>
            <h4>{{ $model->department->name }}</h4>
            <p>{{ $model->credit_points }}</p>
            <p>{{ $model->description }}</p>
        </div>
    </div>
    <h2>Semesters</h2>
    @foreach($model->program_semesters as $semester)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>{{ $semester->name }}</h3>
            </div>
            <div class="panel-body">
                <ul>
                    @foreach($semester->courses as $course)
                        <li>
                            {{ $course->course_number . ' - ' . $course->name }}
                            <small class="text-muted">{{ $course->level_name . ' - ' . $course->credit_points }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endsection
