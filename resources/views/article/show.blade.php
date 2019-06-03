@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.show', $item))
@section('sidebar')
    <a href="{{route('articles.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection
@section('content')
{{$item->name}}
{!!$item->content!!}
{!!$item->image!!}
@endsection