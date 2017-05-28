<h3>Add Semesters</h3>
@include('pathway_semesters._create', ['pathwayId' => $model->id])

@unless($model->pathway_semesters->isEmpty())
    <hr>
    <h3>Edit Semesters</h3>
    @foreach ($model->pathway_semesters->sortBy('order_number') as $semester)
        @include('pathway_semesters._edit', ['model' => $semester])
    @endforeach
@endunless

