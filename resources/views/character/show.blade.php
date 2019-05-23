@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.show', $character))
@section('sidebar')
    <a href="{{route('characters.edit', $character->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection

@section('content')

    <h1>{{$character->name}} {{$character->type_label}}</h1>
    @if ($character->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $character->article->id)}}">{{$character->article->name}}</a></p>
    @endif
    {!!$character->image!!}


@endsection