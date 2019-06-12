@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.form', $item))

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Location details') }}</div>
        <div class="card-body">
            @if( $item->exists )
                {!! Form::model($item, ['method' => 'put', 'files' => true, 'route' => ['locations.update', $item->id]]) !!}
            @else
                {!! Form::open(['url' => Route('locations.store'), 'files' => true]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::mySelect('parent_id', $parents, null, ['label' => __('Parent'), 'placeholder' => __('Select location...')]) }}
            {{ Form::myFile('filename') }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
