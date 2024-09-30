<nav class="navbar navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse fs-4" id="navbarNav">
            <ul class="navbar-nav ms-2 d-flex">
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'cards' ? 'active' : ''}}" aria-current="page"
                        href="{{route('info.cards')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'info.index' ? 'active' : ''}}"
                        href={{route('info.index',[0])}}>Infos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteName() == 'info.details' ? 'active' : ''}}"
                        href={{route('aboutMe')}}>About me</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>