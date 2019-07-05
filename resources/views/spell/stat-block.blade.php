<div class="spell-block">
    <div class="spell-block-content">
        <div class="spell-block-heading">
            <h1>{{$spell->name}}</h1>
            <div class="spell-bg-red">
                {{$spell->level}}
            </div>
        </div>
        <div class="spell-block-stats">
            <div class="stat">
                <h2>{{__('Casting Time')}}</h2>
                {{$spell->casting_time}}
            </div>
            <div class="stat">
                <h2>{{__('Range')}}</h2>
                {{$spell->range}}
            </div>
            <div class="stat">
                <h2>{{__('Components')}}</h2>
                {{$spell->components->raw}}
            </div>
            <div class="stat">
                <h2>{{__('Duration')}}</h2>
                {{$spell->duration}}
            </div>
        </div>
        <div class="spell-block-description">{{$spell->description}}</div>
    </div>
</div>