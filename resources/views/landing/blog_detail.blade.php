<x-landing>
  <x-slot:title>Semesta Buku | Buku</x-slot:title>

  <section class="bj_shop_area sec_padding" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="row">
        <div class="details-content round-box wow fadeIn">
            <div class="detail-header">
                <h4>{{ $blog->title }}</h4>
            </div>
          <img class="rounded-5 mb-30 img-fluid" src="{{ asset($blog->thumbnail) }}" alt="Images">
          {!! $blog->content !!}
        </div>
      </div>
    </div>
  </section>

</x-landing>
