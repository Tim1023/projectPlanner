<div class="clearfix pathway-semesters">
        {!! Form::model($model,
                [   'method' => 'PATCH',
                    'route' => ['admin.pathways.pathway_semesters.update', $model->pathway_id, $model->id]
                ]) !!}
        <div class="panel">
                @include('pathway_semesters._form', ['submitButtonText' => 'Update Semester',
        'submitButtonClass' => 'primary',
        'newSemester' => false])
        </div>
        <hr>
        {!! Form::close() !!}
</div>