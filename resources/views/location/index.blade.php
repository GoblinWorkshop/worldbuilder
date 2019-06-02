@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('locations.index'))
@section('sidebar')
    <a href="{{route('locations.create')}}" class="btn btn-secondary">New</a><br />
@endsection
@section('content')
    <div class="row row-eq-height">
        @foreach ($locations as $location)
            <div class="col-6 col-lg-3 col-xl-2 mb-3">
                <div class="card text-white bg-dark mb-3" style="height:100%;">
                    <div class="card-header">
                        <a href="{{route('locations.show', $location->id)}}">
                            {{$location->name}}
                        </a>
                    </div>
                    {!!  $location->thumbnail(200) !!}
                    <div class="card-footer text-muted">
                        <a href="{{route('locations.show', $location->id)}}" class="btn btn-secondary">Edit</a>
                        <a href="{{route('locations.edit', $location->id)}}" class="btn btn-secondary">View</a>
                    </div>
                </div>
            </div>
            <br />
        @endforeach
    </div>
    {{ $locations->links() }}
@endsection
