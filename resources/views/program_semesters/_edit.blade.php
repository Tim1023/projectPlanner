<div class="clearfix program-semesters">
{!! Form::model($model,
        [   'method' => 'PATCH',
            'route' => ['admin.programs.program_semesters.update', $model->program_id, $model->id]
        ]) !!}
        <div class="panel">
                @include('program_semesters._form', ['submitButtonText' => 'Update Semester',
        'submitButtonClass' => 'primary',
        'newSemester' => false])
        </div>
        <hr>
{!! Form::close() !!}
</div>