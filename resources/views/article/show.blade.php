@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.show', $article))
@section('sidebar')
    <a href="{{route('articles.edit', $article->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
    @endsection

@section('content')

{{$article->name}}
{!!$article->image!!}


    @endsection