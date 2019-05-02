@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.show', $location))
@section('sidebar')
    <a href="{{route('locations.edit', $location->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
    @endsection

@section('content')

{{$location->name}}
{!!$location->image!!}


    @endsection