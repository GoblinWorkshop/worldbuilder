@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.index'))
@section('header')
    <h1>{{__('Articles')}}</h1>
    <p class="text-muted">{{__('Articles are the content for each entity (e.g. location, character, organisation e.t.c.). To make a generic article click on "new". To create an article about an entity use the menu on the top and create it from there. Articles will be added automatically when you create a new entity.')}}</p>
@endsection
@section('options')
    <a href="{{url('/articles/create')}}" class="btn btn-secondary">New</a>
@endsection
@section('content')
    <div class="row row-eq-height">
    @foreach ($items as $item)
        <div class="col-md-6 col-lg-3 col-xl-2 mb-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    <a href="{{route('articles.show', $item->id)}}">
                        {!! $item->icon_label !!}
                        {{$item->name}}
                    </a>
                </div>
                {!!  $item->thumbnail(200, 200) !!}
                <div class="card-body">
                    <p class="card-text">
                        {{ $item->short_description }}
                    </p>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('articles.edit', $item->id)}}" class="btn btn-secondary">Edit</a>
                    <a href="{{route('articles.show', $item->id)}}" class="btn btn-secondary">View</a>
                </div>
            </div>
        </div>
        <br />
    @endforeach
    </div>
    {{ $items->links() }}
@endsection
