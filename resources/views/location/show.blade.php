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

    <h1>{{$location->name}}</h1>
    @if ($location->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $location->article->id)}}">{{$location->article->name}}</a></p>
    @endif
    {!!$location->image!!}


@endsection