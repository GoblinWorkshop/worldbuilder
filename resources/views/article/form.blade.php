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
    <h3>{{__('Editor tips')}}</h3>
    <p>{{__('Use the following code to insert specific content such as locations and characters.')}}</p>
    <ul>
        <li>{{__(':code will insert a link to the character page.', ['code' => '@CharacterName'])}}</li>
        <li>{{__(':code will insert a link to the location page.', ['code' => '#LocationName'])}}</li>
        <li>{{__(':code will insert a dynamic stat block of the character.', ['code' => '+CharacterName'])}}</li>
    </ul>
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
            {{ Form::myTextarea('content', null, ['editor' => 'rich']) }}
            {{ Form::myFile('filename') }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection