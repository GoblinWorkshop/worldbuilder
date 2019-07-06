@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('characters.form', $item))
@section('header')
    <h1>{{$item->name??__('Unnamed character')}}</h1>
@endsection
@section('options')
    @if( $item->exists )
    <a href="{{route('characters.show', $item->id)}}" class="btn btn-secondary">{{__('Back')}}</a>
    @else
        <a href="{{route('characters.index')}}" class="btn btn-secondary">{{__('Back')}}</a>
    @endif
    <a href="#save" class="btn btn-primary" onclick="$('form#entity-form').submit();">{{__('Save')}}</a>
@endsection
@section('content')
    @if( $item->exists )
        {!! Form::model($item, ['id' => 'entity-form', 'method' => 'put', 'files' => true, 'route' => ['characters.update', $item->id]]) !!}
    @else
        {!! Form::open(['id' => 'entity-form', 'url' => Route('characters.store'), 'files' => true]) !!}
    @endif
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
        <li class="nav-item">
            <a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab"
               aria-controls="stats" aria-selected="false">
                {{__('Stats')}}
            </a>
        </li>
    </ul>
    <div class="tab-content p-3 bg-dark mb-3">
        <div class="tab-pane show active" id="details" role="tabpanel" aria-labelledby="details-tab">

            {{ Form::myText('name') }}
            {{ Form::mySelect('type', $item->types, null, [
            'label' => __('Type'),
            'placeholder' => __('Select type...')
            ]) }}
            {{ Form::mySelect('race_id', $races, null, [
            'label' => __('Race'),
            'placeholder' => __('Select race...')
            ]) }}
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
        <div class="tab-pane" id="relations" role="tabpanel" aria-labelledby="relation-tab">
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
        <div class="tab-pane" id="stats" role="tabpanel" aria-labelledby="stats-tab">
            <p>
                {{ __('Most of these stats will be displayed in the Characters stat block.') }}
            </p>
            {{ Form::mySelect('size', $item->sizes, null, [
            'label' => __('Size'),
            'placeholder' => __('Select size...')
            ]) }}
            {{ Form::mySelect('alignment', $item->alignments, null, [
            'label' => __('Alignment'),
            'placeholder' => __('Select alignment...')
            ]) }}
            {{ Form::myText('armor_class') }}
            {{ Form::myText('hit_points') }}
            <div class="row">
                <div class="col">
                    {{ Form::myText('speed', $item->speed, [
                    'default' => 0
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('speed_burrow', $item->speed_burrow, [
                    'default' => 0
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('speed_climb', $item->speed_climb, [
                    'default' => 0
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('speed_fly', $item->speed_fly, [
                    'default' => 0
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('speed_swim', $item->speed_swim, [
                    'default' => 0
                    ]) }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{ Form::myText('ability_str', $item->ability_str, [
                    'default' => 10,
                    'label' => __('STR')
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('ability_dex', $item->ability_dex, [
                    'default' => 10,
                    'label' => __('DEX')
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('ability_con', $item->ability_con, [
                    'default' => 10,
                    'label' => __('CON')
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('ability_int', $item->ability_int, [
                    'default' => 10,
                    'label' => __('INT')
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('ability_wis', $item->ability_wis, [
                    'default' => 10,
                    'label' => __('WIS')
                    ]) }}
                </div>
                <div class="col">
                    {{ Form::myText('ability_cha', $item->ability_cha, [
                    'default' => 10,
                    'label' => __('CHA')
                    ]) }}
                </div>
            </div>
            {{ Form::myText('saving_throws', null, [
            'placeholder' => __('Str +2, Dex +1')
            ]) }}
            {{ Form::myText('skills', null, [
            'placeholder' => __('Deception +6, Intimidation +4')
            ]) }}
            {{ Form::myText('damage_vulnerabilities', null, [
            'placeholder' => __('fire, poison')
            ]) }}
            {{ Form::myText('damage_resistances', null, [
            'placeholder' => __('bludgeoning, piercing, and slashing from nonmagical attacks')
            ]) }}
            {{ Form::myText('damage_immunities', null, [
            'placeholder' => __('fire, poison')
            ]) }}
            {{ Form::myText('condition_immunities', null, [
            'placeholder' => __('prone, poisoned')
            ]) }}
            {{ Form::myText('senses', null, [
            'placeholder' => __('passive Perception 10, blindsight 60ft., darkvision 120ft')
            ]) }}
            {{ Form::myText('languages', null, [
            'placeholder' => __('Common, Draconic')
            ]) }}
            {{ Form::mySelect('xp', $item->challenges, null, [
            'label' => __('Challenge'),
            'placeholder' => __('Select challange...')
            ]) }}
            {{ Form::myTextarea('special_traits', null, ['editor' => 'simple']) }}
            {{ Form::myTextarea('actions', null, ['editor' => 'simple']) }}
            {{ Form::myTextarea('reactions', null, ['editor' => 'simple']) }}
            {{ Form::myTextarea('legendary_actions', null, ['editor' => 'simple']) }}

        </div>
    </div>
    {{ Form::mySubmit(__('Save')) }}
    {!! Form::close() !!}
@endsection