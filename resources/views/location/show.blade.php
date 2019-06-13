@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.show', $item))
@section('header')
    <h1>{{$item->name}}</h1>
@endsection
@section('sidebar')
    <a href="{{route('locations.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
    @foreach ($item->children as $child)
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
    <h1>{{$item->name}}</h1>
    @if ($item->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $item->article->id)}}">{{$item->article->name}}</a></p>
    @endif
    {!!$item->image!!}
@endsection