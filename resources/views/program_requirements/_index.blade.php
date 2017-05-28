<h3>Program Conditions</h3>
<p>This are the rules, which are set for this program.<br />
    For example, a student in BCS must have 90 credits in Level 5, 105 credits in Level 6, etc.
    <br /> You can set this condition over here and all plans will have to follow this conditions.
</p>
@include('program_requirements._create', ['programId' => $model->id])

@unless($model->program_requirements->isEmpty())
    <hr>
    <h3>Existing Conditions</h3>
    @foreach ($model->program_requirements as $requirement)
        @include('program_requirements._edit', ['model' => $requirement])
    @endforeach
@endunless

