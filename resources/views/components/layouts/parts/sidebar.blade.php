<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                    </p>
                </a>
            </li>
            <li class="nav-item menu-open">
                <a href="{{ route('arena.list') }}" class="nav-link {{ Route::is('arena.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-map"></i>
                    <p>
                        Arena
                    </p>
                </a>
            </li>
            <li class="nav-item menu-open">
                <a href="{{ route('daerah.list') }}" class="nav-link {{ Route::is('daerah.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-landmark"></i>
                    <p>
                        Daerah
                    </p>
                </a>
            </li>
            <li class="nav-item menu-open">
                <a href="{{ route('jalur.list') }}" class="nav-link {{ Route::is('jalur.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-ship"></i>
                    <p>
                        Jalur
                    </p>
                </a>
            </li>
            <li class="nav-item menu-open">
                <a href="{{ route('lottery.list') }}" class="nav-link {{ Route::is('lottery.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Undian
                    </p>
                </a>
            </li>
            <li class="nav-item menu-open">
                <a href="{{ route('match.list') }}" class="nav-link {{ Route::is('match.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Match
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
