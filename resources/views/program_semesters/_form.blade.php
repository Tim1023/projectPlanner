<div class="panel-heading clearfix">
    <div class="col-sm-7 form-group {{  $errors->has('name') ? 'has-error' : '' }} ">
        {!! Form::label('name', 'Semester Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
        <span class="help-block">{{ $errors->first('name') }}</span>
    </div>
    <div class="col-sm-3 form-group {{  $errors->has('semester_id') ? 'has-error' : '' }} ">
        {!! Form::label('semester_id', 'Semester Type') !!}
        {!! Form::select('semester_id', $semesterList, null, ['class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('name') }}</span>
    </div>
    <div class="col-sm-2 form-group  {{  $errors->has('order_number') ? 'has-error' : '' }} ">
        {!! Form::label('order_number', 'Order Number') !!}
        {!! Form::number('order_number', null, ['class' => 'form-control', 'placeholder' => 'Order Number']) !!}
        <span class="help-block">{{ $errors->first('order_number') }}</span>
    </div>
    <div class="col-sm-12">
        <div class="btn-toolbar">
            {!! Form::submit($submitButtonText, ['class' => 'btn btn-'.$submitButtonClass]) !!}
            @if(!$newSemester)
                <a href="{{ route("admin.programs.program_semesters.destroy", [$model->program_id, $model->id]) }}" class="btn btn-danger"
                   data-method="delete"
                   data-token="{{ csrf_token() }}">
                    <i class="fa fa-trash"></i>&nbsp;Delete
                </a>
            @endif
        </div>
    </div>
</div>
@if(!$newSemester)
    @include('program_semester_courses._index', ['model' => $model])
@endif
