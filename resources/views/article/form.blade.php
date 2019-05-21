@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('articles.form', $article))

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Article details') }}</div>
        <div class="card-body">
            @if( $article->exists )
                {!! Form::model($article, ['method' => 'put', 'files' => true, 'route' => ['articles.update', $article->id]]) !!}
            @else
                {!! Form::open(['url' => Route('articles.store')]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::myTextarea('content', null, ['editor' => 'rich']) }}
            {{ Form::myFile('filename') }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
