<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/dashboard" class="nav-link">Dashboard</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth
        <!-- Display Username -->
        <li class="nav-item">
            <a class="nav-link" href="#">{{ "Hello, " . Auth::user()->name }}</a>
        </li>

        <!-- Logout Button -->
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link btn btn-outline-danger" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </li>
        @endauth
    </ul>
</nav>
<!-- /.navbar -->
