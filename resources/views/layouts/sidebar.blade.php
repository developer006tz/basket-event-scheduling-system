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
            <span class="me-2"><i class="fa-regular fa-futbol"></i></span>
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
                <a href="{{ url($url.'/Tournaments') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
                  <span>Tournaments</span>
                </a>
              </li>

              <li>
                <a href="{{ url($url.'/Teams') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-badge-fill"></i>
                  </span>
                  <span>Teams</span>
                </a>
              </li>
              <li>
                <a href="{{ url($url.'/Fixtures') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-calendar-days"></i>
                  </span>
                  <span>Fixtures</span>
                </a>
              </li>

              <li>
                <a href="{{ url($url.'/Coachers') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Coaches</span>
                </a>
              </li>
              <li>
                <a href="{{ url($url.'/Players') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Players</span>
                </a>
              </li>
              <li>
                <a href="{{ url($url.'/Team/Statistics') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-futbol"></i></span>
                  <span>Team Statistics</span>
                </a>
              </li>
              <li>
                <a href="{{ url($url.'/Player/Statistics') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-futbol"></i></span>
                  <span>Player Statistics</span>
                </a>
              </li>

            </ul>
          </div>
        </li>

        <li class="mt-3">
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            NETBALL
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#netball">
            <span class="me-2"><i class="fa-solid fa-basketball"></i></span>
            <span>Manage Netball</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="netball">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="{{ url('netball/Tournaments') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
                  <span>Tournaments</span>
                </a>
              </li>

              <li>
                <a href="{{ url('netball/Teams') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-badge-fill"></i>
                  </span>
                  <span>Teams</span>
                </a>
              </li>
              <li>
                <a href="{{ url('netball/Fixtures') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-calendar-days"></i>
                  </span>
                  <span>Fixtures</span>
                </a>
              </li>

              <li>
                <a href="{{ url('netball/Coachers') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Coaches</span>
                </a>
              </li>
              <li>
                <a href="{{ url('netball/Players') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Players</span>
                </a>
              </li>
              <li>
                <a href="{{ url('netball/Team/Statistics') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-futbol"></i></span>
                  <span>Team Statistics</span>
                </a>
              </li>
              <li>
                <a href="{{ url('netball/Player/Statistics') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-futbol"></i></span>
                  <span>Player Statistics</span>
                </a>
              </li>

            </ul>
          </div>
        </li>


        <li class="mt-3">
          <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
            BASKETBALL
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#basketball">
            <span class="me-2"><i class="fa-solid fa-person-through-window"></i></span>
            <span>Manage BasketBall</span>
            <span class="ms-auto">
              <span class="right-icon">
                <i class="bi bi-chevron-down"></i>
              </span>
            </span>
          </a>
          <div class="collapse" id="basketball">
            <ul class="navbar-nav ps-3">
              <li>
                <a href="{{ url('basketball/Tournaments') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-lines-fill"></i></span>
                  <span>Tournaments</span>
                </a>
              </li>

              <li>
                <a href="{{ url('basketball/Teams') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person-badge-fill"></i>
                  </span>
                  <span>Teams</span>
                </a>
              </li>
              <li>
                <a href="{{ url('basketball/Fixtures') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-calendar-days"></i>
                  </span>
                  <span>Fixtures</span>
                </a>
              </li>

              <li>
                <a href="{{ url('basketball/Coachers') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Coaches</span>
                </a>
              </li>
              <li>
                <a href="{{ url('basketball/Players') }}" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-people"></i></span>
                  <span>Players</span>
                </a>
              </li>
              <li>
                <a href="{{ url('basketball/Team/Statistics') }}" class="nav-link px-3">
                  <span class="me-2"><i class="fa-solid fa-futbol"></i></span>
                  <span>Team Statistics</span>
                </a>
              </li>
              <li>
                <a href="{{ url('basketball/Player/Statistics') }}" class="nav-link px-3">
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