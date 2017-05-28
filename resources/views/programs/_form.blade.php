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
<div class="form-group  {{  $errors->has('credits') ? 'has-error' : '' }} ">
    {!! Form::label('credits', 'Credit Points:') !!}
    {!! Form::number('credits', null, ['class' => 'form-control']) !!}
    <span class="help-block">{{ $errors->first('credits') }}</span>
</div>
<div class="form-group">
    {!! Form::label('department_id', 'Department:') !!}
    {!! Form::select('department_id', $departments, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('career_list[]', 'Careers:') !!}
    {!! Form::select('career_list[]', $careerList, null, ['class' => 'form-control select2-multiple', 'multiple' => 'multiple']) !!}
</div>
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
