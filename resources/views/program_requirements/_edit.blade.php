<div class="clearfix program-requirements">
{!! Form::model($model,
        [   'method' => 'PATCH',
            'route' => ['admin.programs.program_requirements.update', $model->program_id, $model->id]
        ]) !!}
        <div class="panel">
                @include('program_requirements._form', ['submitButtonText' => 'Update Condition',
        'submitButtonClass' => 'primary',
        'newRequirement' => false])
        </div>
        <hr>
{!! Form::close() !!}
</div>