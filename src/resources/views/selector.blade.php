<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Apps
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        @foreach (Selector::apps() as $app)
            <a class="dropdown-item" href="#">{{ $app->name }}</a>
        @endforeach
    </div>
</li>