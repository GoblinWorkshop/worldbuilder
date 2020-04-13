@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.show', $item))
@section('background', $item->thumbnail(1280, 720, ['returnUrl' => true]))
@section('header')
    <h1>{{$item->name}}</h1>
@endsection
@section('options')
    <a href="{{route('locations.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    <a href="{{route('locations.edit', $item->id)}}" class="btn btn-secondary">{{__('Edit')}}</a>
@endsection
@section('sidebar')
    @foreach ($item->children as $child)
        @if ($loop->first)
            <h3>
                {{__('Locations found in this region')}}
            </h3>
        @endif
        <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                <a href="{{route('locations.show', $child->id)}}">
                    {!!  $child->thumbnail(200, 200, [
                        'class' => 'card-img'
                        ]) !!}
                </a>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><a href="{{route('locations.show', $child->id)}}">{{$child->name}}</a></h5>
                  <p class="card-text">{!! $child->article->short_description !!}</p>
                </div>
              </div>
            </div>
        </div>
    @endforeach
@endsection
@section('content')
    @if ($item->article)
        <p>{{__('Article')}}: <a href="{{route('articles.show', $item->article->id)}}">{{$item->article->name}}</a></p>
        <article>
            {!! clean($item->article->content) !!}
        </article>

        {!! $item->thumbnail(1280, null, ['class' => 'img img-fluid']) !!}
    @endif
    <div class="row row-eq-height">
        @foreach ($item->characters as $character)
            <div class="col-md-6 col-lg-3 col-xl-2 mb-3">
                @include('character.stat-block', ['character' => $character])
            </div>
            <br />
        @endforeach
    </div>
@endsection
