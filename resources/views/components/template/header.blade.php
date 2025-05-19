<div class="page-header">
  <div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
      <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
              placeholder="Search Koho .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i
              class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light"
            src="{{ asset('') }}assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark"
            src="{{ asset('') }}assets/images/logo/logo-dark.png" alt=""></a></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
        <h4 id="current-time"></h4>
        <script>
          function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            document.getElementById('current-time').textContent = timeString;
          }
          setInterval(updateTime, 1000);
          updateTime();
        </script>
    </div>
    <div class="nav-right col-6 pull-right right-header p-0">
      <ul class="nav-menus">

        <li>
          <div class="mode"><i data-feather="moon"></i></div>
        </li>

        {{-- <li class="onhover-dropdown">
          <div class="notification-box"><i data-feather="bell"></i><span class="badge rounded-pill badge-primary">4
            </span></div>
          <ul class="notification-dropdown onhover-show-div">
            <li><i data-feather="bell"> </i>
              <h3 class="mb-0">Notifications</h3>
            </li>
            <li><a href="email_read.html">
                <p><i class="fa fa-circle-o me-3 font-primary"> </i>Delivery processing <span class="pull-right">10
                    min.</span></p>
              </a></li>
            <li><a href="email_read.html">
                <p><i class="fa fa-circle-o me-3 font-success"></i>Order Complete<span class="pull-right">1 hr</span>
                </p>
              </a></li>
            <li><a href="email_read.html">
                <p><i class="fa fa-circle-o me-3 font-info"></i>Tickets Generated<span class="pull-right">3 hr</span>
                </p>
              </a></li>
            <li><a href="email_read.html">
                <p><i class="fa fa-circle-o me-3 font-danger"></i>Delivery Complete<span class="pull-right">6
                    hr</span></p>
              </a></li>
            <li><a class="btn btn-primary" href="email_read.html">Check all notification</a></li>
          </ul>
        </li> --}}

        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
              data-feather="maximize"></i></a></li>
        <li class="profile-nav onhover-dropdown p-0 me-0">
          <div class="d-flex profile-media"><img class="b-r-50"
              src="{{ asset('') }}{{ auth()->user()->profile->avatar ?? 'assets/images/dashboard/profile.png' }}" alt="">
            <div class="flex-grow-1"><span>{{ auth()->user()->name }}</span>
              <p class="mb-0 font-roboto">{{ ucfirst(auth()->user()->getRoleNames()->first()) }} <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li><a href="{{ route('profile.edit') }}"><i data-feather="user"></i><span>Profile </span></a></li>
            <li><a href="{{ route('password.edit') }}"><i data-feather="lock"></i><span>Ubah Password </span></a></li>
            <li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a href="javascript::void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i data-feather="log-in"> </i><span>Log out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
        <div class="ProfileCard u-cf">
        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
        <div class="ProfileCard-details">
        <div class="ProfileCard-realName">name</div>
        </div>
        </div>
      </script>
    <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
  </div>
</div>
