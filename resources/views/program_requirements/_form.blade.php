<div class="panel-heading clearfix">
    <div class="form-group col-sm-2">
        {!! Form::label('level', 'Level:') !!}
        {!! Form::select('level', $levels, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('minimum_credits', 'Minimum Credits:') !!}
        {!! Form::select('minimum_credits', $credits, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('maximum_credits', 'Credits:') !!}
        {!! Form::select('maximum_credits', $credits, null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('allowed', 'Allowed:') !!}
        {!! Form::checkbox('allowed', null, null, ['class' => 'checkbox']) !!}
    </div>
    <div class="col-sm-4">
        <div class="btn-toolbar pull-right">
            <button type="submit" class="btn btn-{{ $submitButtonClass }}" role="button">
                <i class="fa fa-plus"></i>&nbsp;{{ $submitButtonText }}
            </button>
            @if(!$newRequirement)
                <a href="{{ route("admin.programs.program_requirements.destroy", [$model->program_id, $model->id]) }}" class="btn btn-danger"
                   data-method="delete"
                   data-token="{{ csrf_token() }}">
                    <i class="fa fa-trash"></i>&nbsp;Delete
                </a>
            @endif
        </div>
    </div>
</div>
