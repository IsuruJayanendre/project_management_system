
<style>
    body {
        overflow-x: hidden;
    }
    .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #343a40;
        padding-top: 20px;
    }
    .sidebar a {
        padding: 10px 15px;
        text-decoration: none;
        font-size: 16px;
        color: #ddd;
        display: block;
    }
    .sidebar a:hover {
        background-color: #495057;
        color: #fff;
    }
    .content {
        margin-left: 250px;
        padding: 20px;
    }
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
<div class="container-fluid">
    <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
    <div class="ml-auto">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Manage Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
</nav>
