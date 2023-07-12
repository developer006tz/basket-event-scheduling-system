<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        {{-- <img src="https://vemto.app/favicon.png" alt="Vemto Logo" class="brand-image bg-white img-circle"> --}}
        <span class="brand-text font-weight-light">BASKET EVENT SCHEDULING</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                            @can('view-any', App\Models\Teams::class)
                            <li class="nav-item">
                                <a href="{{ route('all-teams.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Teams</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Coaches::class)
                            <li class="nav-item">
                                <a href="{{ route('all-coaches.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Coaches</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Players::class)
                            <li class="nav-item">
                                <a href="{{ route('all-players.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Players</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Games::class)
                            <li class="nav-item">
                                <a href="{{ route('all-games.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Games</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Practices::class)
                            <li class="nav-item">
                                <a href="{{ route('all-practices.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Practices</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\EventTypes::class)
                            <li class="nav-item">
                                <a href="{{ route('all-event-types.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Event Types</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Notifications::class)
                            <li class="nav-item">
                                <a href="{{ route('all-notifications.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Notifications</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\EventStatistics::class)
                            <li class="nav-item">
                                <a href="{{ route('all-event-statistics.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Event Statistics</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\User::class)
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @endcan

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-key"></i>
                        <p>
                            Access Management
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endauth


                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>zz