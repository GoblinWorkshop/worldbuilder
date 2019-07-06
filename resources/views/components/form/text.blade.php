<div class="form-group">
    @if ($value === null && isset($attributes['default']))
        {? $value = $attributes['default'] ?}
    @endif
    @if (!isset($attributes['label']) || $attributes['label'] !== false)
        {{ Form::label(isset($attributes['label']) ? $attributes['label'] : $name, null, ['class' => 'control-label']) }}
    @endif
    {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if (isset($attributes['help']))
        <small class="form-text text-muted">{{$attributes['help']}}</small>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>