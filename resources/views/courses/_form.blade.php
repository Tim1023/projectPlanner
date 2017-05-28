<div class="form-group {{  $errors->has('name') ? 'has-error' : '' }} ">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    <span class="help-block">{{ $errors->first('name') }}</span>
</div>
<div class="form-group  {{  $errors->has('description') ? 'has-error' : '' }} ">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    <span class="help-block">{{ $errors->first('description') }}</span>
</div>
<div class="form-group">
    {!! Form::label('course_number', 'Course Number:') !!}
    {!! Form::text('course_number', null, ['class' => 'form-control', 'placeholder' => 'E.g. ISCG1234']) !!}
</div>
<div class="form-group">
    {!! Form::label('credits', 'Credits:') !!}
    {!! Form::select('credits', $credits,null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('multiterm', 'Multiple Terms:') !!}
    {!! Form::checkbox('multiterm', null, null, ['class' => 'checkbox-inline']) !!}
</div>
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::select('level', $levels, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('department_id', 'Department:') !!}
    {!! Form::select('department_id', $departments, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('pre_requisite_list', 'Pre-Requisites') !!}
    {!! Form::select('pre_requisite_list[]', $courseList, null, ['class' => 'form-control select2-multiple', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('co_requisite_list', 'Co-Requisites') !!}
    {!! Form::select('co_requisite_list[]', $courseList, null, ['class' => 'form-control select2-multiple', 'multiple']) !!}
</div>


<div class="form-group">
    {!! Form::label('career_list[]', 'Careers:') !!}
    {!! Form::select('career_list[]', $careerList, null, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control col-md-4']) !!}
</div>
