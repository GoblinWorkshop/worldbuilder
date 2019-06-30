@if($location)
    <div class="card bg-dark text-light">
        {!!  $location->thumbnail(400, null, [
        'class' => 'card-img-top'
        ]) !!}
        <div class="card-body">
            <h5 class="card-title">{{ $location->name }}</h5>
            <a href="{{route('locations.show', $location->id)}}" class="btn btn-secondary">{{__('View')}}</a>
        </div>
    </div>
@endif