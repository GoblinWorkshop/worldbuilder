@extends('layouts.site')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col my-auto">
                <h1 class="display-4">Goblin Workshop</h1>
                <p class="lead">Welcome by the Goblin Workshop, an online platform for <em class="text-primary">creating
                        epic tabletop experiences</em>. Both online via our web-based application and offline at your
                    gaming table!
                </p>
                <hr class="my-4 border-secondary">
                <p>Create a free account and start using the platform.</p>
                <a href="/register" class="btn btn-primary btn-lg" role="button">Create account</a>
                <a href="/login" class="btn btn-secondary btn-lg">Login</a>
            </div>
            <div class="col-6 my-auto">
                <img src="/img/site/green-eyed-dragon-iguana.jpg" class="img-fluid" alt=""/>
            </div>
        </div>
    </div>
@endsection