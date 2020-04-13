<div class="stat-block">
    @if (!empty($character->filename))
    <div class="stat-block-figure">
        <a href="{{route('characters.show', $character->id)}}">
        {!!  $character->thumbnail(null, 300, []) !!}
        </a>
    </div>
    @endif
    <div class="stat-block-content">
        <div class="stat-block-heading">
            <h1>{{$character->name}}</h1>
            <small>{{$character->subheading_label}}</small>
        </div>
        <svg height="5" width="100%" class="tapered-rule">
            <polyline points="0,0 300,2.5 0,5"></polyline>
        </svg>
        <div class="stat-block-red">
            @if (!empty($character->armor_class))
                <strong>Armor Class</strong> {{$character->armor_class}}<br/>
            @endif
            @if (!empty($character->hit_points))
                <strong>Hit Points</strong> {{$character->hit_points}}<br/>
            @endif
            <strong>Speed</strong>
            {{$character->speed_labels}}
        </div>
        <svg height="5" width="100%" class="tapered-rule">
            <polyline points="0,0 300,2.5 0,5"></polyline>
        </svg>
        <div class="stat-block-abilities">
            <div class="ability ability-str">
                <strong>STR</strong><br/>
                {{$character->ability_str_label}}
            </div>
            <div class="ability ability-dex">
                <strong>DEX</strong><br/>
                {{$character->ability_dex_label}}
            </div>
            <div class="ability ability-con">
                <strong>CON</strong><br/>
                {{$character->ability_con_label}}
            </div>
            <div class="ability ability-int">
                <strong>INT</strong><br/>
                {{$character->ability_int_label}}
            </div>
            <div class="ability ability-wis">
                <strong>WIS</strong><br/>
                {{$character->ability_wis_label}}
            </div>
            <div class="ability ability-cha">
                <strong>CHA</strong><br/>
                {{$character->ability_cha_label}}
            </div>
        </div>
        <svg height="5" width="100%" class="tapered-rule">
            <polyline points="0,0 300,2.5 0,5"></polyline>
        </svg>
        <div class="stat-block-red">
            @if (!empty($character->saving_throws))
                <strong>{{__('Saving Throws')}}</strong> {{$character->saving_throws}}<br/>
            @endif
            @if (!empty($character->skills))
                <strong>{{__('Skills')}}</strong> {{$character->skills}}<br/>
            @endif
            @if (!empty($character->damage_vulnerabilities))
                <strong>{{__('Damage Vulnerabilities')}}</strong> {{$character->damage_vulnerabilities}}<br/>
            @endif
            @if (!empty($character->damage_resistances))
                <strong>{{__('Damage Resistances')}}</strong> {{$character->damage_resistances}}<br/>
            @endif
            @if (!empty($character->damage_immunities))
                <strong>{{__('Damage Immunities')}}</strong> {{$character->damage_immunities}}<br/>
            @endif
            @if (!empty($character->condition_immunities))
                <strong>{{__('Condition Immunities')}}</strong> {{$character->condition_immunities}}<br/>
            @endif
            @if (!empty($character->senses))
                <strong>{{__('Senses')}}</strong> {{$character->senses}}<br/>
            @endif
            <strong>{{__('Languages')}}</strong> {{$character->languages??"-"}}<br/>
            @if (!empty($character->xp))
                <strong>{{__('Challenge')}}</strong> {{$character->challenge_label}}<br/>
            @endif
        </div>
        <svg height="5" width="100%" class="tapered-rule">
            <polyline points="0,0 300,2.5 0,5"></polyline>
        </svg>
        @if (!empty($character->special_traits))
            <div class="stat-block-black">
                {!! clean($character->special_traits) !!}
            </div>
        @endif
        @if (!empty($character->actions))
            <h2>{{__('Actions')}}</h2>
            <div class="stat-block-black">
                {!! clean($character->actions) !!}
            </div>
        @endif
        @if (!empty($character->reactions))
            <h2>{{__('Reactions')}}</h2>
            <div class="stat-block-black">
                {!! clean($character->reactions) !!}
            </div>
        @endif
        @if (!empty($character->legendary_actions))
            <h2>{{__('Legendary Actions')}}</h2>
            <div class="stat-block-black">
                {!! clean($character->legendary_actions) !!}
            </div>
        @endif
    </div>
</div>