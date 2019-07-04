@if($character)
    @include('character.stat-block', ['character' => $character])
@endif