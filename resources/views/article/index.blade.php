@extends('layouts.app')
@section('sidebar')
    <a href="{{url('/articles/create')}}" class="btn btn-secondary">New</a><br />
@endsection
@section('content')
    @foreach ($articles as $article)
        <a href="{{route('articles.show', $article->id)}}">{{$article->name}}</a><br />
    @endforeach
@endsection
