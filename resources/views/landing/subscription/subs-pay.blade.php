<x-landing>
  <x-slot:title>Semesta Buku | Subscription Pay</x-slot:title>

  <section class="product_details_area sec_padding">
    <div class="container">
      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center justify-content-center">
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h4>Anda Memilih</h4>
              <h4 class="my-0 fw-normal">{{ $transaction->subscription->plan->name }}</h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">@rupiah($transaction->amount)</h1>
              <small class="text-body-secondary fw-light">{{ $transaction->subscription->start_date }} Bulan</small>
              <p>Berakhir : {{ $transaction->subscription->end_date }}</p>
              <button  id="pay-button"
                class="w-100 btn btn-lg btn-primary">Bayar Sekarang</button>
                <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $transaction->midtrans_transaction_id }}', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            window.location.href = "{{ route('success', $transaction->token_trans) }}";
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
</x-landing>
