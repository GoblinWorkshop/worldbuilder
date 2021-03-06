@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.show', $item))
@section('background', $item->thumbnail(1280, 720, ['returnUrl' => true]))
@section('header')
    <h1>{{$item->name}}</h1>
@endsection
@section('options')
    <a href="{{route('articles.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    <a href="{{route('articles.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection
@section('sidebar')
    @switch($item->type)
        @case('locations')
        @include('location.summary', ['location' => $item->location])
        @break
        @case('characters')
        @include('character.summary', ['character' => $item->character])
        @break
    @endswitch
@endsection
@section('content')
<div>{{ $item->created_at }}</div>
<article>{!! clean($item->content) !!}</article>
@endsection
