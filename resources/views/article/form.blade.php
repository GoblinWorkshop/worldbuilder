@extends('layouts.app')

@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Article details') }}</div>
        <div class="card-body">
            @if( isset($article) )
                {!! Form::model($article, ['method' => 'put', 'files' => true, 'route' => ['articles.update', $article->id]]) !!}
            @else
                {!! Form::open(['url' => Route('articles.store')]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::myFile('filename') }}
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
