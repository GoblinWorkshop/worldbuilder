<div class="form-group">
    @if (!isset($attributes['label']) || $attributes['label'] !== false)
    {{ Form::label(isset($attributes['label']) ? $attributes['label'] : $name, null, ['class' => 'control-label']) }}
    @endif
    {{ Form::file($name, $attributes) }}
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>