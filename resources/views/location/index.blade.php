@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.index'))
@section('sidebar')
    <a href="{{route('locations.create')}}" class="btn btn-secondary">New</a><br />
@endsection
@section('content')
    @foreach ($locations as $location)
        <a href="{{route('locations.show', $location->id)}}">{{$location->name}}</a><br />
    @endforeach
@endsection
