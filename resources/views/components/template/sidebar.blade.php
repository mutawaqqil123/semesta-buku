<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light"
          src="{{ asset('Logo-Semesta-Buku.webp') }}" style="max-width: 80px;" alt=""><img class="img-fluid for-dark"
          src="{{ asset('Logo-Semesta-Buku.webp') }}" style="max-width: 80px;" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-left"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid for-light"
          src="{{ asset('Logo-Semesta-Buku.webp') }}" style="max-width: 80px;" alt=""><img class="img-fluid for-dark"
          src="{{ asset('Logo-Semesta-Buku.webp') }}" style="max-width: 80px;" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="index.html"><img class="img-fluid for-light"
                src="{{ asset('Logo-Semesta-Buku.webp') }}" style="max-width: 80px;" alt=""><img class="img-fluid for-dark"
                src="{{ asset('Logo-Semesta-Buku.webp') }}" style="max-width: 80px;" alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
            </div>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h4 class="lan-1">General </h4>
            </div>
          </li>
          <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('dashboard') ? 'bg-primary' : '' }}" href="{{ route('dashboard') }}"><i
                data-feather="home"> </i><span>Dasboard</span></a></li>
          <li class="sidebar-main-title">
            <div>
              <h4 class="">Data Master </h4>
            </div>
          </li>

          <li class="sidebar-list"><a class="sidebar-link sidebar-title link-nav {{ request()->routeIs(['category.index', 'sub-category.index']) ? 'bg-primary' : '' }}"
              href="{{ route('category.index') }}"><i data-feather="git-pull-request"> </i><span>Kategori</span></a>
          </li>
          <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs(['book.index', 'book.create', 'book.edit']) ? 'bg-primary' : '' }}" href="{{ route('book.index') }}"><i
                data-feather="monitor"> </i><span>Data Buku</span></a></li>

          <li class="sidebar-list"> <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs(['plan.index', 'plan.create', 'plan.edit']) ? 'bg-primary' : '' }}" href="{{ route('plan.index') }}"><i
                data-feather="shopping-bag"> </i><span>Plan</span></a></li>

        </ul>
        <div class="sidebar-img-section">
          <div class="sidebar-img-content pt-2">
            <h4>Semesta Buku <br> Semesta Infomedia Indonesia</h4>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-primary">Log Out</button>
            </form>
          </div>
        </div>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
