<div class="sidebar-sticky mt-5">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/') ? 'active' : '' }}" href="#">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/servers') ? 'active' : '' }}" href="{{route('servers.index')}}">
                <span data-feather="server"></span>
                Servers
            </a>
        </li>

    </ul>


</div>
