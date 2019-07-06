@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.show', $item))
@section('header')
    <h1>{{$item->name}} {{$item->type_label}}</h1>
@endsection
@section('options')
    <a href="{{route('characters.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    <a href="{{route('characters.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection
@section('sidebar')
    @include('character.stat-block', ['character' => $item])
@endsection
@section('content')
    @if ($item->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $item->article->id)}}">{{$item->article->name}}</a></p>
        {!! clean($item->article->content) !!}
    @endif
@endsection