@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.show', $location))
@section('sidebar')
    <a href="{{route('locations.edit', $location->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
    @foreach ($location->children as $child)
        @if ($loop->first)
            <p>
                {{__('Locations found in this region')}}<br/>
        @endif
            <a href="{{route('locations.show', $child->id)}}">{{$child->name}}</a><br/>
        @if ($loop->last)
            </p>
        @endif
    @endforeach
@endsection

@section('content')

    {{$location->name}}
    {!!$location->image!!}


@endsection