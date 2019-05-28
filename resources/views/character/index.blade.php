@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.index'))
@section('sidebar')
    <a href="{{route('characters.create')}}" class="btn btn-secondary">New</a>
    <a href="{{route('organisations.index')}}" class="btn btn-secondary">Organisations</a><br />
@endsection
@section('content')
    @foreach ($characters as $character)
        <a href="{{route('characters.show', $character->id)}}">{{$character->name}}</a><br />
    @endforeach
@endsection