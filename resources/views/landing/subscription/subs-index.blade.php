<x-landing>
  <x-slot:title>Semesta Buku | Subscription</x-slot:title>

  <section class="product_details_area sec_padding">
    <div class="container">
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center justify-content-center">
        @foreach ($plans as $plan)
            <div class="col">
              <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                  <h4 class="my-0 fw-normal">{{ $plan->name }}</h4>
                </div>
                <div class="card-body">
                  <h1 class="card-title pricing-card-title">@rupiah($plan->price)</h1>
                  <small class="text-body-secondary fw-light">{{ $plan->duration }} Bulan</small>
                  <p>
                    {{ $plan->description }}
                  </p>
                  <a href="{{ route('subscribe.store', $plan->token_plan) }}" class="w-100 btn btn-lg btn-primary">Beli Paket</a>
                </div>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </section>

</x-landing>
