@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.show', $item))
@section('sidebar')
    <a href="{{route('characters.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection
@section('content')
    <h1>{{$item->name}} {{$item->type_label}}</h1>
    @if ($item->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $item->article->id)}}">{{$item->article->name}}</a></p>
    @endif
    @include('character.stat-block', ['character' => $item])
@endsection