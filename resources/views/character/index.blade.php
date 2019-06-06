@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.index'))
@section('sidebar')
    <a href="{{route('characters.create')}}" class="btn btn-secondary">New</a>
    <a href="{{route('organisations.index')}}" class="btn btn-secondary">Organisations</a><br />
    <a href="{{route('characters.relations')}}" class="btn btn-secondary">Relations</a><br />
@endsection
@section('header')
    <h1>{{__('Characters')}}</h1>
    <p class="text-muted">
        {{ __('All characters in your game are located here. Each character might have multiple relations with other characters.') }}
    </p>
@endsection
@section('content')
    <div class="row row-eq-height">
        @foreach ($items as $item)
            <div class="col-6 col-lg-3 col-xl-2 mb-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        <a href="{{route('characters.show', $item->id)}}">
                            {{$item->name}}
                        </a>
                    </div>
                    {!!  $item->thumbnail(200) !!}
                    <div class="card-footer text-muted">
                        <a href="{{route('characters.edit', $item->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{route('characters.show', $item->id)}}" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <br />
        @endforeach
    </div>
    {{ $items->links() }}
@endsection