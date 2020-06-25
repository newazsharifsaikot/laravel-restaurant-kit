<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="{{route('admin.dashboard')}}">Dashboard</a>
        </div>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('logout') }}" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                        <p class=" d-md-block">
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>