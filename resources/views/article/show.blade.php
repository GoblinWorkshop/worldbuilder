@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.show', $item))
@section('header')
    <h1>{{$item->name}}</h1>
@endsection
@section('sidebar')
    <a href="{{route('articles.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
    @switch($item->type)
        @case('locations')
        @include('location.summary', ['location' => $item->location])
        @break
    @endswitch
@endsection
@section('content')
<article>{!! clean($item->content) !!}</article>
{!!$item->image!!}
@endsection