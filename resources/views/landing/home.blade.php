<x-landing>
  <x-slot:title>Semesta Buku | Home</x-slot:title>
  <!-- area banner  -->
  <section class="bj_banner_area_two banner_animation_03" data-bg-color="#E4EFE7">
    <img class="shape_bg wow fadeInUp" data-wow-delay="0.9s" src="{{ asset('') }}landing/img/home-two/zigzag2.png"
      alt="">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="bj_banner_content_two">
            <h2 class="banner_title wow fadeInUp" data-wow-delay="0.3s">Toko Buku Lokal Belanja Online
            </h2>
            <p class="wow fadeInUp" data-wow-delay="0.4s">Dari literatur terapan hingga sumber daya pendidikan, kami
              memiliki banyak buku teks untuk ditawarkan kepada Anda.
            </p>
            <div class="d-flex flex-wrap">
              {{-- <a href="#" class="bj_theme_btn wow fadeInLeft" data-wow-delay="0.6s">Subscribe</a> --}}
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="bj_banner_img_two text-center">
            <img class="img_one wow fadeInUp" data-wow-delay="0.4s"
              src="{{ asset('') }}landing/img/home-two/banner_book1.png" alt="">
            <img class="img_two wow fadeInUp" data-wow-delay="0.6s"
              src="{{ asset('') }}landing/img/home-two/banner_book2.png" alt="">
            <img class="img_three" src="{{ asset('') }}landing/img/home-two/zigzag.png" alt="">
            <div data-parallax='{"y": -50}' class="shape_one"></div>
            <div class="shape_two" data-parallax='{"y": 20}'></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- area banner  -->


  <!-- area buku terbaik  -->
  <section class="bj_best_book_area">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="section_title wow fadeInLeft">
            <h2 class="title">Buku Bulan Ini</h2>
          </div>
        </div>
        <div class="col-md-3 text-md-end">
          <a href="{{ route('produk') }}" class="bj_theme_btn_two style_two wow fadeInRight" data-wow-delay="0.2s">Lihat Semua <i
              class="arrow_right"></i></a>
        </div>
      </div>
      <div class="row">
        @foreach ($this_month->take(2) as $item)
          <div class="col-lg-6">
            <div class="bj_best_book_item wow fadeInUp" data-wow-delay="0.3s">
              <div class="bj_book_img">
                <img src="{{ asset($item->thumbnail) }}" alt="" height="500px">
              </div>
              <div class="text">
                <a href="{{ route('produk.single', $item->token_book) }}">
                  <h4 class="bj_new_pr_title">{{ $item->title }}</h4>
                </a>
                <div class="bj_pr_meta d-flex align-items-center justify-content-between">
                  <div class="writer_name">Oleh: <a href="author-single.html">{{ $item->author }} </a> </div>
                </div>
                <ul class="list-unstyled">
                  <li><img src="{{ asset('') }}landing/img/home-two/arrow.png" alt="">Pertama kali
                    diterbitkan pada {{ $item->year }}</li>
                  <li><img src="{{ asset('') }}landing/img/home-two/arrow.png" alt="">Hak cipta oleh
                    penulis</li>
                </ul>
                <a href="{{ route('produk.single', $item->token_book) }}" class="bj_theme_btn">Lihat Produk</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- area buku terbaik  -->

  <!-- area kategori buku  -->
  <section class="bj_book_category_area sec_padding_three" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="bj_category_inner d-flex justify-content-center">
        <a href="#" class="bj_book_category_item text-center wow fadeInUp" data-wow-delay="0.2s">
          <div class="icon">
            <i class="icon-uncategorized"></i>
          </div>
          <h6>Tidak Dikategorikan</h6>
        </a>
        @foreach (App\Models\Category::get() as $item)
          <a href="#" class="bj_book_category_item text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="icon">
              {{-- <i class="icon-biography"></i> --}}
              <img src="{{ asset($item->icon) }}" alt="" width="50px">
            </div>
            <h6>{{ $item->name }}</h6>
          </a>
        @endforeach
      </div>
    </div>
  </section>
  <!-- area kategori buku  -->

  <!-- area produk terlaris  -->
  <section class="best_selling_pr_area_two" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="section_title wow fadeInUp" data-wow-delay="0.2s">
        <h2 class="title">Pilihan Orang</h2>
      </div>
      <div class="best_pr_tab_inner d-flex justify-content-between">
        <ul class="nav nav-pills best_pr_tab_two d-flex justify-content-center" id="pills-tab" role="tablist">
          <li role="presentation" class="nav-item">
            <a class="nav-link px-0 active" id="pills-best-tab" data-bs-toggle="pill" data-bs-target="#pills-best"
              role="tab" aria-selected="true">
              Buku Terlaris</a>
          </li>
          <li role="presentation" class="nav-item">
            <a class="nav-link px-0" id="pills-featured-tab" data-bs-toggle="pill" data-bs-target="#pills-featured"
              role="tab" aria-selected="false">Buku Pilihan</a>
          </li>
        </ul>
        <a href="{{ route('produk') }}" class="bj_theme_btn_two style_two">Lihat Semua <i
            class="arrow_right"></i></a>
      </div>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade explore-menu show active" id="pills-best" role="tabpanel"
          aria-labelledby="pills-best-tab">
          <div class="row">
            <!-- Item Produk 1 -->
            @foreach ($this_month->take(4) as $item)
              <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="best_product_item best_product_item_two">
                  <div class="img">
                    <a href="#"><img src="{{ asset($item->thumbnail) }}" alt="buku"></a>
                    {{-- <button type="button" class="bj_theme_btn add-to-cart-automated"
                        data-name="{{ $item->title }}"
                        data-img="{{ asset($item->thumbnail) }}" data-price="{{ $item->daily_rate }}">
                        <i class="icon_cart_alt"></i>Tambahkan ke Keranjang
                      </button> --}}
                  </div>
                  <div class="bj_new_pr_content">
                    <a href="{{ route('produk.single', $item->token_book) }}">
                      <h4 class="bj_new_pr_title">{{ $item->title }}</h4>
                    </a>
                    <div class="writer_name">Oleh - <a href="#">{{ $item->author }} </a></div>
                    <div class="bj_pr_meta d-flex">
                    </div>
                  </div>
                </div>
              </div>
              @include('components.landing.quick-view-modal')
            @endforeach
          </div>

        </div>
        <div class="tab-pane fade explore-menu" id="pills-featured" role="tabpanel"
          aria-labelledby="pills-featured-tab">
          <div class="row">
            <!-- Item Produk 1 -->
            @foreach ($release->take(4) as $item)
              <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="best_product_item best_product_item_two">
                  <div class="img">
                    <a href="#"><img src="{{ asset($item->thumbnail) }}" alt="buku"></a>
                    <div class="hover_item">
                      <span data-bs-toggle="tooltip" data-bs-placement="right" title="Quickview"><button
                          class="quick_button" data-bs-toggle="modal" data-bs-target="#productQuickView"><i
                            class="arrow_move"></i></button></span>
                    </div>
                    {{-- <button type="button" class="bj_theme_btn add-to-cart-automated"
                        data-name="{{ $item->title }}"
                        data-img="{{ asset($item->thumbnail) }}" data-price="{{ $item->daily_rate }}">
                        <i class="icon_cart_alt"></i>Tambahkan ke Keranjang
                      </button> --}}
                  </div>
                  <div class="bj_new_pr_content">
                    <a href="{{ route('produk.single', $item->token_book) }}">
                      <h4 class="bj_new_pr_title">{{ $item->title }}</h4>
                    </a>
                    <div class="writer_name">Oleh - <a href="#">{{ $item->author }} </a></div>
                    <div class="bj_pr_meta d-flex">
                      <div class="book_price">@rupiah($item->daily_rate)</div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

        </div>

      </div>
    </div>
  </section>
</x-landing>
