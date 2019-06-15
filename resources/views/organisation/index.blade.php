@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('organisations.index'))
@section('sidebar')
    <a href="{{route('organisations.create')}}" class="btn btn-secondary">New</a>
    <a href="{{route('characters.index')}}" class="btn btn-secondary">Characters</a><br />
@endsection
@section('content')
    <div class="row row-eq-height">
        @foreach ($items as $item)
            <div class="col-md-6 col-lg-3 col-xl-2 mb-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        <a href="{{route('organisations.show', $item->id)}}">
                            {{$item->name}}
                        </a>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{route('organisations.edit', $item->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{route('organisations.show', $item->id)}}" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <br />
        @endforeach
    </div>
    {{ $items->links() }}
@endsection
