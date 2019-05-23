@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.form', $character))
@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Character details') }}</div>
        <div class="card-body">
            @if( $character->exists )
                {!! Form::model($character, ['method' => 'put', 'files' => true, 'route' => ['characters.update', $character->id]]) !!}
            @else
                {!! Form::open(['url' => Route('characters.store')]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::mySelect('type', $character->types) }}
            {{ Form::myFile('filename') }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
