<!-- offcanvas -->
<div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
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
        <li class="my-4">
          <hr class="dropdown-divider bg-light" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            FOOTBALL
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#layouts">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Manage Football</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="layouts">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="{{ url('football/Tournaments') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
                  <span>Tournaments</span>
                </a>
              </li>

              <li>
                <a href="{{ url('football/Teams') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-badge-fill"></i>
                  </span>
                  <span>Teams</span>
                </a>
              </li>
              <li>
                <a href="{{ url('football/Fixtures') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-calendar-days"></i>
                  </span>
                  <span>Fixtures</span>
                </a>
              </li>

              <li>
                <a href="{{ url('football/Coachers') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Coaches</span>
                </a>
              </li>
              <li>
                <a href="{{ url('football/Players') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Players</span>
                </a>
              </li>
              <li>
                <a href="{{ url('football/Team/Statistics') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-futbol"></i></span>
                  <span>Team Statistics</span>
                </a>
              </li>
              <li>
                <a href="{{ url('football/Player/Statistics') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-futbol"></i></span>
                  <span>Player Statistics</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                SETTINGS
              </div>
            </li>
            <li>
              <a href="{{ url('courses') }}" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Mocu Courses</span>
              </a>
            </li>
            <li>
              <a href="{{ url('admins') }}" class="nav-link px-3">
                <span class="me-2"><i class="fa fa-user"></i></span>
                <span>Admin users</span>
              </a>
            </li>
       
      </ul>
    </nav>
  </div>
</div>
<!-- offcanvas -->