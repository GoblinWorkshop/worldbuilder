@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.form', $character))
@section('content')
    <div class="card text-white bg-dark">
        <div class="card-header">{{ __('Character details') }}</div>
        <div class="card-body">
            @if( $character->exists )
                {!! Form::model($character, ['method' => 'put', 'files' => true, 'route' => ['characters.update', $character->id]]) !!}
            @else
                {!! Form::open(['url' => Route('characters.store')]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::mySelect('type', $character->types) }}
            {{ Form::mySelect('organisations[]', $organisations, null, [
            'label' => __('Organisations'),
                'multiple' => 'multiple',
                'data-select' => 'select2'
                ]) }}
            {{ Form::myFile('filename') }}
            {{ Form::mySelect('location_id', $locations, null, [
            'label' => __('Current location'),
            'placeholder' => __('Select location...')
            ]) }}

            {{ Form::mySelect('locations[]', $locations, null, [
            'label' => __('Locations'),
                'multiple' => 'multiple',
                'data-select' => 'select2',
                'help' => __('Location that this character visits or has a relation with.')
                ]) }}
            @if( $character->exists )
                <h3>{{ __('Relations') }}</h3>
                <p>
                    {{ __('Select characters with whom this character has a relation with. This can be father, mother, friend, etc.') }}
                </p>
                <?php
                $index = -1; // sorry
                ?>
                @foreach ($character->relations as $index => $relation)
                    {{ Form::hidden("relation[$index][id]", $relation->id) }}
                    {{ Form::mySelect("relation[$index][character_2_id]", $characters, $relation->character_2_id, [
                    'placeholder' => __('Select relation...'),
                    'label' => __('Relation')
                    ])}}
                    {{ Form::mySelect("relation[$index][type]", $relation->types, $relation->type, [
                    'label' => __('Type')
                    ]) }}
                    <hr/>
                @endforeach
                <?php
                $index++;
                ?>
                {{ Form::mySelect("relation[$index][character_2_id]",
                    $characters,
                    null, [
                    'placeholder' => __('Select relation...'),
                    'label' => __('Relation')
                    ])
                }}
                {{ Form::mySelect("relation[$index][type]", \App\Relation::$types, null, [
                'label' => __('Type')
                ]) }}
            @endif
            {{ Form::mySubmit(__('Save')) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection