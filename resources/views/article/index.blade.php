@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.index'))
@section('sidebar')
    <a href="{{url('/articles/create')}}" class="btn btn-secondary">New</a><br />
@endsection
@section('content')
    @foreach ($articles as $article)
        <a href="{{route('articles.show', $article->id)}}">{{$article->name}}</a>
        {{$article->type_label}}
        <br />
    @endforeach
@endsection
