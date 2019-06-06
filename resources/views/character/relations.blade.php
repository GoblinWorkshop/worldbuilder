@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.relations'))
@push('scripts')
    <script src="/js/relations.js"></script>
@endpush
@section('sidebar')
    <a href="{{route('characters.create')}}" class="btn btn-secondary">New</a>
    <a href="{{route('organisations.index')}}" class="btn btn-secondary">Organisations</a><br />
    <a href="{{route('characters.relations')}}" class="btn btn-secondary">Relations</a><br />
@endsection
@section('header')
    <h1>{{__('Relations')}}</h1>
    <p class="text-muted">
        {{ __('All relations between your characters visualized.') }}
    </p>
@endsection
@section('content')
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