<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="{{route('articles.index')}}">
        {{ config('app.name', 'Goblin Workshop') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-main"
            aria-controls="nav-main" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav-main">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="{{route('articles.index')}}" class="nav-link">Articles</a>
            </li>
            <li class="nav-item">
                <a href="{{route('locations.index')}}" class="nav-link">Locations</a>
            </li>
            <li class="nav-item">
                <a href="{{route('characters.index')}}" class="nav-link">Characters</a>
            </li>
            <li class="nav-item">
                <a href="https://github.com/GoblinWorkshop/worldbuilder" class="nav-link" target="_blank"><i
                            class="fab fa-github"></i></a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>