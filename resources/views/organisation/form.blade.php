@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('organisations.form', $item))
@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Organisation details') }}</div>
        <div class="card-body">
            @if( $item->exists )
                {!! Form::model($item, ['method' => 'put', 'route' => ['organisations.update', $item->id]]) !!}
            @else
                {!! Form::open(['url' => Route('organisations.store')]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::mySelect('type', $item->types) }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
