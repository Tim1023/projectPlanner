<div class="clearfix pathway-semesters">
        {!! Form::open([
                    'method' => 'POST',
                    'route' => ['admin.pathways.pathway_semesters.store', $pathwayId]
                ]) !!}
        <div class="panel">
                @include('pathway_semesters._form', ['submitButtonText' => 'Add Semester', 'submitButtonClass' => 'success', 'newSemester' => true])
        </div>
        {!! Form::close() !!}
</div>
