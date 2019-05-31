@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.index'))
@section('sidebar')
    <a href="{{url('/articles/create')}}" class="btn btn-secondary">New</a><br />
@endsection
@section('content')
    <div class="row">
    @foreach ($articles as $article)
        <div class="col-6 col-lg-3 col-xl-2">
            <div class="card text-white bg-dark mb-3">
                {!!  $article->thumbnail(200) !!}
                <div class="card-header"><a href="{{route('articles.show', $article->id)}}">{{$article->name}}</a></div>
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{route('articles.show', $article->id)}}" class="btn btn-secondary">Edit</a>
                    <a href="{{route('articles.edit', $article->id)}}" class="btn btn-secondary">View</a>
                </div>
                <div class="card-footer text-muted">
                    {{$article->type_label}}
                </div>
            </div>
        </div>
        <br />
    @endforeach
    </div>
    {{ $articles->links() }}
@endsection
