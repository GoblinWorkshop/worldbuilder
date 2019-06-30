@if($character)
    <div class="card bg-dark text-light">
        {!!  $character->thumbnail(400, null, [
        'class' => 'card-img-top'
        ]) !!}
        <div class="card-body">
            <h5 class="card-title">{{ $character->name }}</h5>
            <a href="{{route('characters.show', $character->id)}}" class="btn btn-secondary">{{__('View')}}</a>
            @include('character.stat-block', ['character' => $character])
        </div>
    </div>
@endif