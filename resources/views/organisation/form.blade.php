@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('organisations.form', $item))
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
        <a href="{{route('organisations.show', $item->id)}}" class="btn btn-secondary">{{__('Back')}}</a>
    @else
        <a href="{{route('organisations.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    @endif
    <a href="#save" class="btn btn-primary" onclick="$('form#entity-form').submit();">{{__('Save')}}</a>
@endsection
@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Organisation details') }}</div>
        <div class="card-body">
            @if( $item->exists )
                {!! Form::model($item, ['id' => 'entity-form', 'method' => 'put', 'route' => ['organisations.update', $item->id]]) !!}
            @else
                {!! Form::open(['id' => 'entity-form', 'url' => Route('organisations.store'), 'files' => true]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::mySelect('type', $item->types) }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
