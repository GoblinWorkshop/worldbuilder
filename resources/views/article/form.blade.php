@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.form', $item))
@section('background', $item->thumbnail(1000, 500, ['returnUrl' => true]))
@section('header')
    @if( $item->exists )
        <h1>{{__('Edit :0', [$item->name])}}</h1>
    @else
        <h1>{{__('New article')}}</h1>
    @endif
@endsection
@section('options')
    @if( $item->exists )
        {!! Form::open(['id' => 'delete-form', 'class' => 'd-inline', 'onsubmit' => 'return confirm(\''.  __("Delete item?") .'\');', 'url' => Route('articles.destroy', $item->id)]) !!}
        @method('DELETE')
        {{ Form::mySubmit(__('Delete'), [
        'class' => 'btn btn-text text-danger'
        ]) }}
        {!! Form::close() !!}
        <a href="{{route('articles.show', $item->id)}}" class="btn btn-secondary">{{__('Back')}}</a>
    @else
        <a href="{{route('articles.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    @endif
    <a href="#save" class="btn btn-primary" onclick="$('form#entity-form').submit();">{{__('Save')}}</a>
@endsection
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
    @if( $item->exists )
        {!! Form::model($item, ['id' => 'entity-form', 'method' => 'put', 'files' => true, 'route' => ['articles.update', $item->id]]) !!}
    @else
        {!! Form::open(['id' => 'entity-form', 'url' => Route('articles.store'), 'files' => true]) !!}
    @endif
    <div class="card text-white bg-dark mb-3">
        <div class="card-header">{{ __('Article details') }}</div>
        <div class="card-body">
            {{ Form::myText('name') }}
            {{ Form::myFile('filename', [
            'label' => __('Image'),
            'help' => __('Will be displayed as header or in the article list.')
            ]) }}
            {{ Form::myTextarea('content', null, [
            'editor' => 'rich',
            'help' => __('You can use shortcuts like @CharacterName, #LocationName, +CharacterName or !SpellName to insert dynamic content and link to the specific entities.')
            ]) }}
        </div>
    </div>
    {{ Form::mySubmit(__('Save')) }}
    {!! Form::close() !!}
@endsection
