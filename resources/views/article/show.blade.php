@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.show', $item))
@section('header')
    <h1>{{$item->name}}</h1>
@endsection
@section('sidebar')
    <a href="{{route('articles.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection
@section('content')
@html($item->content)
{!!$item->image!!}
@endsection