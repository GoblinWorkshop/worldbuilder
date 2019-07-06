@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.show', $item))
@section('background', $item->thumbnail(1000, 500, ['returnUrl' => true]))
@section('header')
    <h1>{{$item->name}}</h1>
@endsection
@section('options')
    <a href="{{route('locations.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    <a href="{{route('locations.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection
@section('sidebar')
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
    @if ($item->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $item->article->id)}}">{{$item->article->name}}</a></p>
        <article>
            {!! clean($item->article->content) !!}
        </article>
    @endif
@endsection