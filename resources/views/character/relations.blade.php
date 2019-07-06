@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.relations'))
@push('scripts')
    <script src="/js/relations.js"></script>
@endpush
@section('header')
    <h1>{{__('Relations')}}</h1>
    <p class="text-muted">
        {{ __('All relations between your characters visualized.') }}
    </p>
@endsection
@section('options')
    <a href="{{route('characters.index')}}" class="btn btn-secondary">Back</a>
@endsection
@section('sidebar')
    <h1>{{__('Legend')}}</h1>
    <ul>
        <li style="color: #999999;"><u>{{__('Acquaintance')}}</u></li>
        <li style="color: #376420;"><u>{{__('Friend')}}</u></li>
        <li style="color: #99448a;"><u>{{__('Lover')}}</u></li>
        <li style="color: #642020;"><u>{{__('Enemy')}}</u></li>
        <li style="color: #204d64;"><u>{{__('Family')}}</u></li>
        <li style="color: #ff9900;"><u>{{__('Other')}}</u></li>
    </ul>
@endsection
@section('content')
    @foreach ($characters as $character)
        {!! $character->thumbnail(100,100, [
        'class' => 'd-none',
        'id' => 'thumbnail-'. $character->id
        ]) !!}
    @endforeach
    <div id="relations"></div>
    <script>
        window.onload = function() {
            Relation.init({
                    element: document.getElementById('relations'),
                    characters: {!! $characters->toJson() !!},
                    relations: {!! json_encode($relations) !!},
                }
            );
        }
    </script>
@endsection