<nav class="navbar fixed-top navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/public">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/public/contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/public/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/public/galery">Gallery</a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/public/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/public/register">Register</a>
                    </li>
                @else
                    @if(Auth::user()->status === 'employee')
                        <li class="nav-item">
                            <a class="nav-link" href="/public/profile">My Profile</a>
                        </li>
                    @endif

                    @if(Auth::user()->status == 'employer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employer.users') }}">All Employees</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


