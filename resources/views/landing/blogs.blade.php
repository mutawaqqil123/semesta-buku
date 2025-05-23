<x-landing>
  <x-slot:title>Semesta Buku | Buku</x-slot:title>

  <section class="bj_shop_area sec_padding" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="row">
        {{-- <div class="col-lg-3">
                    <div class="shop_sidebar">
                        <div class="widget filter_widget">
                            <h3 class="shop_sidebar_title"><a href="#"><img src="assets/img/shop/filter.svg" alt=""></a>Filter</h3>
                        </div>
                        <div class="widget shop_category_widget">
                            <h4 class="shop_sidebar_title_small"><i class="icon-category-icon"></i>Category</h4>
                            <ul class="list-unstyled shop_category_list">
                                @foreach (App\Models\BlogCategory::get() as $item)
                                    <li><a href="{{ route('landing.blog') }}?key={{ $item->token_category }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> --}}
        <div class="col-lg-12">
          {{-- <form role="search" method="GET" class="pr_search_form input-group mb-4" action="#">
                        <input type="text" name="s" value="" class="form-control search-field" id="search" placeholder="Serach  off book store..">
                        <button type="submit"><i class="ti-search"></i></button>
                    </form> --}}
          <div class="row">
            @forelse ($blogs as $blog)
              <div class="col-xl-3 col-lg-4 col-sm-6 projects_item">
                <div class="best_product_item best_product_item_two shop_product">
                  <div class="img">
                    <a href="#"><img src="{{ asset($blog->thumbnail) }}" alt="book"></a>
                    <div class="pr_ribbon">
                      @php
                        // use Carbon\Carbon;

                        $createdAt = \Carbon\Carbon::parse($blog->created_at)->setTimezone('Asia/Jakarta');
                        $now = \Carbon\Carbon::now('Asia/Jakarta');

                        $diffInMinutes = $createdAt->diffInMinutes($now);
                      @endphp

                      @if ($diffInMinutes < 60)
                        <span class="product-badge">Baru saja</span>
                      @elseif ($diffInMinutes < 1440)
                        <span class="product-badge">{{ floor($diffInMinutes / 60) }} jam lalu</span>
                      @elseif ($diffInMinutes < 4320)
                        <span class="product-badge">{{ floor($diffInMinutes / 1440) }} hari lalu</span>
                      @else
                        <span class="product-badge">{{ $createdAt->format('d M Y') }}</span>
                      @endif



                      {{-- <div class="ratting">
                                                <img src="assets/img/star-1.png" alt="">4.9
                                            </div> --}}
                    </div>
                    {{-- <a href="{{ route('blog.single', $blog->slug) }}" class="bj_theme_btn" >Check
                                        </a> --}}
                  </div>
                  <div class="bj_new_pr_content">
                    <a href="{{ route('blog.single', $blog->slug) }}">
                      <h4 class="bj_new_pr_title">{{ $blog->title }}</h4>
                    </a>
                  </div>
                  <div class="mt-3 text-end">
                    <a href="{{ route('blog.single', $blog->slug) }}" class="btn btn-primary">
                      Learn More
                    </a>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                  No blogs found.
                </div>
              </div>
            @endforelse
            {{-- <div class="col-12 text-center mt-4">
                            <a href="{{ route('landing.blog') }}" class="btn btn-secondary">Reset</a>
                        </div> --}}

          </div>
          <div class="text-center">
            {{ $blogs->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>

</x-landing>
