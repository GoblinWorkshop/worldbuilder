@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.form', $item))

@if( $item->exists )
@section('sidebar')
    @switch($item->type)
        @case('locations')
        @include('location.summary', ['location' => $item->location])
        @break
        @case('characters')
        @include('character.summary', ['character' => $item->character])
        @break
    @endswitch
@endsection
@endif
@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Article details') }}</div>
        <div class="card-body">
            @if( $item->exists )
                {!! Form::model($item, ['method' => 'put', 'files' => true, 'route' => ['articles.update', $item->id]]) !!}
            @else
                {!! Form::open(['url' => Route('articles.store'), 'files' => true]) !!}
            @endif
            {{ Form::myText('name') }}
                {{ Form::myFile('filename', [
                'label' => __('Image'),
                'help' => __('Will be displayed as header or in the article list.')
                ]) }}
            {{ Form::myTextarea('content', null, [
            'editor' => 'rich',
            'help' => __('You can use shortcuts like @CharacterName, #LocationName, +CharacterName or !SpellName to insert dynamic content and link to the specific entities.')
            ]) }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection