@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.form', $item))
@section('header')
    <h1>{{$item->name??__('Unnamed character')}}</h1>
@endsection
@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab"
               aria-controls="details" aria-selected="true">
                {{__('Details')}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="relations-tab" data-toggle="tab" href="#relations" role="tab"
               aria-controls="relations" aria-selected="false">
                {{__('Relations')}}
            </a>
        </li>
    </ul>
    <div class="tab-content p-3 bg-dark">
        <div class="tab-pane show active" id="details" role="tabpanel" aria-labelledby="home-tab">

            @if( $item->exists )
                {!! Form::model($item, ['method' => 'put', 'files' => true, 'route' => ['characters.update', $item->id]]) !!}
            @else
                {!! Form::open(['url' => Route('characters.store')]) !!}
            @endif
            {{ Form::myText('name') }}
            {{ Form::mySelect('type', $item->types) }}
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
        </div>
        <div class="tab-pane" id="relations" role="tabpanel" aria-labelledby="profile-tab">
            <p>
                {{ __('Select characters with whom this character has a relation with. This can be father, mother, friend, etc.') }}
            </p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        {{__('Relation')}}
                    </th>
                    <th>
                        {{__('Type')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $index = -1; // sorry
                ?>
                @foreach ($item->relations as $index => $relation)
                    <tr>
                        <td>
                            {{ Form::hidden("relation[$index][id]", $relation->id) }}
                            {{ Form::mySelect("relation[$index][character_2_id]", $characters, $relation->character_2_id, [
                            'placeholder' => __('Select relation...'),
                            'label' => false
                            ])}}
                        </td>
                        <td>
                            {{ Form::mySelect("relation[$index][type]", $relation->types, $relation->type, [
                            'label' => false
                            ]) }}
                        </td>
                    </tr>
                @endforeach
                <?php
                $index++;
                ?>
                <tr>
                    <td>
                        {{ Form::mySelect("relation[$index][character_2_id]",
                            $characters,
                            null, [
                            'placeholder' => __('Select relation...'),
                            'label' => false
                            ])
                        }}
                    </td>
                    <td>
                        {{ Form::mySelect("relation[$index][type]", \App\Relation::$types, null, [
                        'label' => false
                        ]) }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{ Form::mySubmit(__('Save')) }}
    {!! Form::close() !!}
@endsection