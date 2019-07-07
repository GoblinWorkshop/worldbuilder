@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.index'))
@section('header')
    <h1>{{__('Locations')}}</h1>
    <p class="text-muted">
        {{ __('Locations can be anything from rooms to houses and from cities to continents. Each location can be stored hierarchically allowing you to zoom in or out as far as you like.') }}
    </p>
@endsection
@section('options')
    <a href="{{route('locations.create')}}" class="btn btn-secondary">New</a><br />
@endsection
@section('content')
    <div class="row row-eq-height">
        @foreach ($items as $item)
            <div class="col-md-6 col-lg-3 col-xl-2 mb-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        <a href="{{route('locations.show', $item->id)}}">
                            {{$item->name}}
                        </a>
                    </div>
                    {!!  $item->thumbnail(500, 500, [
                    'class' => 'card-img'
                    ]) !!}
                    <div class="card-footer text-muted">
                        <a href="{{route('locations.edit', $item->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{route('locations.show', $item->id)}}" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <br />
        @endforeach
    </div>
    {{ $items->links() }}
@endsection