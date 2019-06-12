@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.form', $item))
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