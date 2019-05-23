@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('organisations.index'))
@section('sidebar')
    <a href="{{route('organisations.create')}}" class="btn btn-secondary">New</a>
    <a href="{{route('characters.index')}}" class="btn btn-secondary">Characters</a><br />
@endsection
@section('content')
    @foreach ($items as $item)
        <a href="{{route('organisations.show', $item->id)}}">{{$item->name}}</a><br />
    @endforeach
@endsection
