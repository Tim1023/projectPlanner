<div class="clearfix program-requirements">
{!! Form::open([
            'method' => 'POST',
            'route' => ['admin.programs.program_requirements.store', $programId]
        ]) !!}
        <div class="panel">
                @include('program_requirements._form', ['submitButtonText' => 'Add Condition', 'submitButtonClass' => 'success', 'newRequirement' => true])
        </div>
{!! Form::close() !!}
</div>