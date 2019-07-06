@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('organisations.show', $item))
@section('options')
    <a href="{{route('organisations.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    <a href="{{route('organisations.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection

@section('content')
    <h1>{{$item->name}} {{$item->type_label}}</h1>
    @if ($item->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $item->article->id)}}">{{$item->article->name}}</a></p>
        <article>
            {!! clean($item->article->content) !!}
        </article>
    @endif

@endsection