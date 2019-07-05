<div class="form-group">
    @if (!isset($attributes['label']) || $attributes['label'] !== false)
        {{ Form::label(isset($attributes['label']) ? $attributes['label'] : $name, null, ['class' => 'control-label']) }}
    @endif
    {{ Form::password($name, array_merge(['class' => 'form-control'], $attributes)) }}
    @if (isset($attributes['help']))
        <small class="form-text text-muted">{{$attributes['help']}}</small>
    @endif
</div>