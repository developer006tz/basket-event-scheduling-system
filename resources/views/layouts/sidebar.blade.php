   <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                HOME
              </div>
            </li>
            <li>
              <a href="{{route('home')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                ADMINISTRATION
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Manage Users</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts">
                <ul class="navbar-nav ps-3">
                  @can('view-any', App\Models\Teams::class)
                  <li>
                  <a href="{{ route('all-teams.index') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
                  <span>Teams</span>
                  </a>
                  </li>
                @endcan
                  @can('view-any', App\Models\Players::class)
                  <li>
                    <a href="{{ route('all-players.index') }}" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-person-lines-fill"></i></span>
                      <span>PLayers</span>
                    </a>
                  </li>
                  @endcan
                  @can('view-any', App\Models\Coaches::class)
                  <li>
                    <a href="{{ route('all-coaches.index') }}" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-person-badge-fill"></i>
                      </span>
                      <span>Coaches</span>
                    </a>
                  </li>
                  @endcan
                  @can('view-any', App\Models\User::class)
                  <li>
                    <a href="{{ route('users.index') }}" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-people"></i></span>
                      <span>All users</span>
                    </a>
                  </li>
                  @endcan
                </ul>
              </div>
            </li>
            @can('view-any', App\Models\Notifications::class)
            <li>
              <a href="{{ route('all-notifications.index') }}" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-bell-fill"></i></span>
                <span>Notifications</span>
              </a>
            </li>
            @endcan
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                BASKET LEAGUE
              </div>
            </li>
             @can('view-any', App\Models\Games::class)
            <li>
              <a href="{{ route('all-games.index') }}" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Games</span>
              </a>
            </li>
            @endcan
            @can('view-any', App\Models\Practices::class)
            <li>
              <a href="{{ route('all-practices.index') }}" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-chevron-bar-contract"></i></span>
                <span>Practises</span>
              </a>
            </li>
            @endcan


            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#layouts5"
              >
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Events</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="layouts5">
                <ul class="navbar-nav ps-3">
                  @can('view-any', App\Models\EventTypes::class)
                  <li>
                    <a href="{{ route('all-event-types.index') }}" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-calendar-week"></i></span>
                      <span>Events</span>
                    </a>
                  </li>
                  @endcan
                  @can('view-any', App\Models\EventStatistics::class)
                  <li>
                    <a href="{{ route('all-event-statistics.index') }}" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-bar-chart-fill"></i>
                      </span>
                      <span>Event Statistics</span>
                    </a>
                  </li>
                  @endcan
                  
                </ul>
              </div>
            </li>
             @if (
  Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
  Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class)
)

            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                ACCESS MANAGEMENT
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#rolesAndPermission"
              >
                <span class="me-2"><i class="bi bi-house-lock"></i></span>
                <span>Roles & Permissions</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="rolesAndPermission">
                <ul class="navbar-nav ps-3">
                   @can('view-any', Spatie\Permission\Models\Role::class)
                  <li>
                    <a href="{{ route('roles.index') }}" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-key-fill"></i></span>
                      <span>Roles</span>
                    </a>
                  </li>
                  @endcan
                   @can('view-any', Spatie\Permission\Models\Permission::class)
                  <li>
                    <a href="{{ route('permissions.index') }}" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-lock"></i></i>
                      </span>
                      <span>Permissions</span>
                    </a>
                  </li>
                  @endcan
                </ul>
              </div>
            </li>
            @endif
            <li>


          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->