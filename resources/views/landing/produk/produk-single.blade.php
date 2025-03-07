<x-landing>
  <x-slot:title>Semesta Buku | Detail {{ $book->title }}</x-slot:title>

  <section class="product_details_area sec_padding" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="row gy-xl-0 gy-3">
        <div class="col-xl-9">
          <div class="bj_book_single me-xl-3">
            <div class="bj_book_img flip">
              <div class=""><img class="img-fluid" src="{{ asset($book->thumbnail) }}" alt="" width="400px">
              </div>
            @if ($book->created_at->gt(now()->subWeek()))
                <div class="pr_ribbon">
                    <span class="product-badge">Baru</span>
                </div>
            @endif
            </div>
            <div class="bj_book_details">
              <h2>{{ $book->title }}</h2>
              <ul class="list-unstyled book_meta">
                <li>Oleh:<a href="author-single.html">{{ $book->author }}</a></li>
                <li>Kategori:<a href="shop-sidebar.html">{{ $book->subcategory->first()->category->name }}</a></li>
              </ul>

              <p>{{ Str::limit($book->description, 100) }}</p>
              <ul class="product_meta list-unstyled">
                <li><span>Penerbit:</span>{{ $book->publisher }}</li>
                <li><span>Tahun Terbit:</span>{{ $book->year }}</li>
                {{-- <li><span>Jumlah Halaman:</span>320 halaman</li> --}}
              </ul>
            </div>
          </div>
          <div class="bj_book_single_tab_area me-xl-3">

            <div class="tab-content bj_book_single_tab_content mt-0">
              <div class="tab-pane fade show active" id="product_description" role="tabpanel"
                aria-labelledby="product_description-tab">
                <div class="product_book_content_details">
                  <div>
                    {{ $book->description }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3">
          @auth
            @if (auth()->user()->subscription->where('status', 'active'))
                <div class="product_sidbar">
                  <div class="price_head">Baca Sekarang: </div>
                  <div class="price_head">
                      <span class="price"></span>
                  </div>

                  <div class="d-flex flex-column gap-3">
                    <a href="{{ route('user.book', $book->token_book) }}" class="bj_theme_btn"> Baca</a>
                  </div>
                </div>
                @else
                <div class="product_sidbar">
                    <div class="price_head">Baca Sekarang: </div>
                    <div class="price_head">
                        <span class="price"></span>
                    </div>

                    <div class="d-flex flex-column gap-3">
                    <a href="{{ route('subscribe.index') }}" class="bj_theme_btn"> Subscribe</a>
                    </div>
                </div>
            @endif
          @endauth
          @guest
            <div class="product_sidbar">
                <div class="price_head">Baca Sekarang: </div>
                <div class="price_head">
                    <span class="price"></span>
                </div>

                <div class="d-flex flex-column gap-3">
                <a href="{{ route('login') }}" class="bj_theme_btn"> Login Untuk Baca</a>
                </div>
            </div>
          @endguest

          <div class="product_details_sidebar">
            <a class="details_header" data-bs-toggle="collapse" href="#product_details_collapse" role="button"
              aria-expanded="false" aria-controls="product_details_collapse">
              <h6 class="mb-0">Detail Produk</h6>
              <i class="fa-solid fa-chevron-up"></i>
            </a>
            <div class="collapse show" id="product_details_collapse">
              <div class="product_details_section_wrap">
                <div class="product_details_section_content mb-3 mt-3">
                  <span class="product_details_section_key">Tahun Terbit :</span>
                  <span class="product_details_section_value">{{ $book->year }}</span>
                </div>
                {{-- <div class="product_details_section_content mb-3">
                  <span class="product_details_section_key">Jumlah Halaman</span>
                  <span class="product_details_section_value">772 halaman</span>
                </div> --}}
                <div class="product_details_section_content mb-3">
                  <span class="product_details_section_key">Penerbit :</span>
                  <div class="product_details_section_value">
                    <span>
                      {{ $book->publisher }}
                    </span>
                  </div>
                </div>
                <div class="product_details_section_content mb-3">
                  <span class="product_details_section_key">Kategori :</span>
                  <div class="product_details_section_value">
                    <a href="https://www.packtpub.com/en-us/data" class="fw-600">
                        {{ $book->subcategory->first()->category->name }}
                    </a>
                  </div>
                </div>
                <div class="product_details_section_content mb-3">
                  <span class="product_details_section_key">Sub Kategori :</span>
                  <div class="product_details_section_value">
                    @foreach ($book->subcategory as $item)
                        <a href="#" class="fw-600">
                          {{ $item->sub_name }},
                        </a>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



  <section class="bj_frequently_bought_area sec_padding pt-0" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="section_title text-center">
        <h2 class="title_two">Sering Dikunjungi</h2>
        <p>Dapatkan Promo Spesial Subscription Diskon 50% Sekarang!</p>
      </div>
      <div class="row gy-xl-0 gy-4">
        @foreach ($this_month as $get)
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="bj_new_pr_item mb-0 wow fadeInUp" data-wow-delay="0.2s">

                <a href="#" class="img"><img src="{{ asset($get->thumbnail) }}" alt="book"></a>
                <div class="bj_new_pr_content">
                  <a href="product-single.html">
                    <h4 class="bj_new_pr_title">{{ $get->title }}</h4>
                  </a>
                  <div class="bj_pr_meta d-flex">
                    <div class="norm_text">{{ $get->author }}</div>
                    {{-- <div class="norm_text">77 halaman</div> --}}
                    <div class="norm_text">{{ $get->year }}</div>
                  </div>
                  <div class="product_varaiation">
                    <div class="book_price mt-2">@rupiah($get->daily_rate)</div>
                  </div>
                  <a href="{{ route('produk.single', $get->token_book) }}" class="bj_theme_btn strock_btn add-to-cart-automated"
                    data-name="Matahari dan Bintang" data-price="125" data-mrp="350"
                    data-img="{{ asset('') }}landing/img/home/book5.jpg">Lihat</a>
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </section>
</x-landing>
