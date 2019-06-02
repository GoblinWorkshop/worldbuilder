@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.index'))
@section('sidebar')
    <a href="{{url('/articles/create')}}" class="btn btn-secondary">New</a><br />
@endsection
@section('content')
    <div class="row row-eq-height">
    @foreach ($articles as $article)
        <div class="col-6 col-lg-3 col-xl-2 mb-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header">
                    <a href="{{route('articles.show', $article->id)}}">
                        {!! $article->icon_label !!}
                        {{$article->name}}
                    </a>
                </div>
                {!!  $article->thumbnail(200) !!}
                <div class="card-body">
                    <p class="card-text">
                        {{ $article->short_description }}
                    </p>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('articles.edit', $article->id)}}" class="btn btn-secondary">Edit</a>
                    <a href="{{route('articles.show', $article->id)}}" class="btn btn-secondary">View</a>
                </div>
            </div>
        </div>
        <br />
    @endforeach
    </div>
    {{ $articles->links() }}
@endsection
