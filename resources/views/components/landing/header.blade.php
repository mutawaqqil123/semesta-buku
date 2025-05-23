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
              Harga Paket
            </a>
          </li>

          {{-- <li
            class="nav-item dropdown submenu {{ request()->routeIs(['landing.blog', 'blog.single']) ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" href="{{ route('landing.blog') }}" role="button"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Blog
            </a>
            <ul class="dropdown-menu">
              @foreach (\App\Models\BlogCategory::get() as $item)
                <li class="nav-item {{ request()->query('key') == $item->token_category ? 'active' : '' }}">
                  <a href="{{ route('landing.blog') }}?key={{ $item->token_category }}"
                    class="nav-link">{{ $item->name }}</a>
                </li>
              @endforeach
            </ul>
          </li> --}}

          <li class="nav-item {{ request()->routeIs('faq') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('faq') }}" aria-haspopup="true" aria-expanded="false">
              FAQ
            </a>
          </li>

          <li class="nav-item {{ request()->routeIs('kontak') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kontak') }}" aria-haspopup="true" aria-expanded="false">
              Sosmed
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('saran') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('saran') }}" aria-haspopup="true" aria-expanded="false">
              Kritik & Saran
            </a>
          </li>
        </ul>

        <div class="alter_nav">
          <ul class="navbar-nav search_cart menu">
            {{-- <li class="nav-item search"><a class="nav-link search-btn" href="javascript:void(0);"><i
                  class="ti-search"></i></a>
              <form action="#" method="get" class="menu-search-form">
                <div class="input-group">
                  <input type="search" class="form-control" placeholder="Search here..">
                  <button type="submit"><i class="ti-arrow-right"></i></button>
                </div>
              </form>
            </li> --}}
            <li class="nav-item shpping-cart dropdown submenu">
            {{-- @php
                $newBlogCount = \App\Models\Blog::where('created_at', '>=', now()->subHours(12))->count();
            @endphp --}}
            <a class="cart-btn nav-link dropdown-toggle" href="{{ route('landing.blog') }}" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="ti-announcement"></i>
                {{-- @if($newBlogCount > 0)
                    <span class="num">{{ $newBlogCount }}</span>
                @else
                    <span class="num">0</span>
                @endif --}}
            </a>
              {{-- <div class="dropdown-menu">
                <ul class=" list-unstyled">
                  @foreach (\App\Models\Blog::latest()->get() as $item)
                    <li class="cart-single-item clearfix">
                      <div class="cart-img">
                        <img src="{{ asset($item->thumbnail) }}" alt="styler">
                      </div>
                      <div class="cart-content text-left">
                        <p class="cart-title"><a href="{{ route('blog.single', $item->slug) }}">{{ $item->title }}</a>
                        </p>
                        <p>{{ $item->writer->name }}</p>
                      </div>
                    </li>
                  @endforeach
                </ul>
                <div class="cart_f">
                  <div class="cart-pricing">
                  </div>
                  <div class="cart-button text-center">
                    <a href="{{ route('landing.blog') }}" class=" btn btn-cart get_btn pink" style="width: 100%">Lihat Semua</a>
                  </div>
                </div>
              </div> --}}
            </li>
          </ul>
        </div>
        @guest
          <a class="bj_theme_btn strock_btn hidden-sm hidden-xs" href="{{ route('login') }}"><i
              class="fa-regular fa-user"></i>Login</a>
          {{-- <a class="bj_theme_btn p-3 ms-3" href="{{ route('register') }}"><i class="fa-regular fa-user"></i>Register</a> --}}
        @endguest
        @auth
          <div class="dropdown">
            <a class="nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <img
                src="{{ asset('') }}{{ auth()->user()->profile->avatar ?? 'assets/images/dashboard/profile.png' }}"
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
              <li><a class="dropdown-item" href="{{ route('password.edit') }}">Ubah Password</a></li>
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
