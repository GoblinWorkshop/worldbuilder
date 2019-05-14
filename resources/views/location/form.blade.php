@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.form', $location))

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Location details') }}</div>
        <div class="card-body">
            @if( $location->exists )
                {!! Form::model($location, ['method' => 'put', 'files' => true, 'route' => ['locations.update', $location->id]]) !!}
            @else
                {!! Form::open(['url' => Route('locations.store')]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::mySelect('parent_id', $parents, null, ['placeholder' => __('Select location...')]) }}
            {{ Form::mySelect('article_id', $articles, null, ['placeholder' => __('Select article...')]) }}
            {{ Form::myFile('filename') }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
