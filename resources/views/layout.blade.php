<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset("assets/vendors/mdi/css/materialdesignicons.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendors/ti-icons/css/themify-icons.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendors/css/vendor.bundle.base.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendors/font-awesome/css/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendors/jvectormap/jquery-jvectormap.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendors/flag-icon-css/css/flag-icons.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendors/owl-carousel-2/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendors/owl-carousel-2/owl.theme.default.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">
  </head>
  <body>
    <div class="container-scroller">
      <!-- Sidebar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset("assets/images/logo.svg") }}" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{ asset("assets/images/logo-mini.svg") }}" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{ asset("assets/images/dashboard/avatar.png") }}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{ Auth::guard('admin')->user()->name }}</h5>
                  <span>online</span>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
              
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.categories.index') }}">
              <span class="menu-icon">
                <i class="fa fa-tags"></i>
              </span>
              <span class="menu-title">Categories</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.places.index') }}">
              <span class="menu-icon">
                <i class="fa fa-building-o"></i>
              </span>
              <span class="menu-title">Places</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- end sidebar -->
      <div class="container-fluid page-body-wrapper">
        <!-- navbar -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset("../../../assets/images/logo-mini.svg") }}" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-cog text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="{{ asset("../../../assets/images/dashboard/avatar.png") }}" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::guard('admin')->user()->name }}</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                  </a>
                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
                  </form>
                 </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- end navbar -->

        <!-- main-panel -->
        <div class="main-panel ">
          <div class="content-wrapper">       
            {{-- content here   --}}
            <main id="main" class="main">
              @yield('main')
            </main>
          </div>
          <!-- footer -->
            <footer class="footer">
            <div class="container text-center">
              <div class="copyright">
              &copy; {{ date('Y') }} All rights reserved to <strong></strong> <a href="https://fourthpyramidagcy.com/">Fourth Pyramid Agency</a>
              </div>
            </div>
            </footer>
        </div>
        <!-- main-panel ends -->
      </div>
    </div>
    <!-- plugins:js -->
    <script src="{{ asset("assets/vendors/js/vendor.bundle.base.js") }}"></script>
    <script src="{{ asset("assets/vendors/chart.js/chart.umd.js") }}"></script>
    <script src="{{ asset("assets/vendors/progressbar.js/progressbar.min.js") }}"></script>
    <script src="{{ asset("assets/vendors/jvectormap/jquery-jvectormap.min.js") }}"></script>
    <script src="{{ asset("assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js") }}"></script>
    <script src="{{ asset("assets/vendors/owl-carousel-2/owl.carousel.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.cookie.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/js/off-canvas.js") }}"></script>
    <script src="{{ asset("assets/js/misc.js") }}"></script>
    <script src="{{ asset("assets/js/settings.js") }}"></script>
    <script src="{{ asset("assets/js/todolist.js") }}"></script>
    <script src="{{ asset("assets/js/proBanner.js") }}"></script>
    <script src="{{ asset("assets/js/dashboard.js") }}"></script>
    <script src="{{ asset("https://cdn.jsdelivr.net/npm/apexcharts") }}"></script>

    <!-- End custom js for this page -->
  </body>
</html>