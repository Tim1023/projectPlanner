<h3>Add Semesters</h3>
@include('program_semesters._create', ['programId' => $model->id])

@unless($model->program_semesters->isEmpty())
    <hr>
    <h3>Edit Semesters</h3>
    @foreach ($model->program_semesters->sortBy('order_number') as $semester)
        @include('program_semesters._edit', ['model' => $semester])
    @endforeach
@endunless

