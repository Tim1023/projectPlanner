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
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
