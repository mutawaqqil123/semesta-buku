<header class="header_area header_relative">
  <nav class="navbar navbar-expand-lg menu_one" id="header">
    <div class="container">
      <a class="navbar-brand" href="/"><x-application-logo></x-application-logo></a>
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="menu_toggle">
          <span class="hamburger">
            <span></span>
            <span></span>
            <span></span>
          </span>
          <span class="hamburger-cross">
            <span></span>
            <span></span>
          </span>
        </span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav menu w_menu ms-auto me-auto">
          {{-- <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <a class="nav-link" href="/" aria-haspopup="true" aria-expanded="false">
              HOME
            </a>
          </li> --}}
          <li class="nav-item {{ request()->routeIs('produk') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('produk') }}" aria-haspopup="true" aria-expanded="false">
              BUKU
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('subscribe.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('subscribe.index') }}" aria-haspopup="true" aria-expanded="false">
              Subscribe
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('faq') }}" aria-haspopup="true" aria-expanded="false">
              FAQ
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('kontak') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kontak') }}" aria-haspopup="true" aria-expanded="false">
              Kontak
            </a>
          </li>
        </ul>
        @guest
          <a class="bj_theme_btn strock_btn hidden-sm hidden-xs" href="{{ route('login') }}"><i
              class="fa-regular fa-user"></i>Login</a>
          {{-- <a class="bj_theme_btn p-3 ms-3" href="{{ route('register') }}"><i class="fa-regular fa-user"></i>Register</a> --}}
        @endguest
        @auth
          <div class="dropdown">
            <a class="nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('') }}{{ auth()->user()->profile->avatar ?? 'assets/images/dashboard/profile.png' }}"
                alt="{{ Auth::user()->name }}" class="rounded-circle me-1" width="40" height="40">
              <div class="ms-2" style="color: black;">
                <div class="d-flex align-items-center">
                  <div>{{ Auth::user()->name }} </div>
                  <i class="fa-solid fa-chevron-down me-2"></i>
                </div>
                @ispremium
              </div>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </div>
        @endauth
      </div>
    </div>
  </nav>
</header>
