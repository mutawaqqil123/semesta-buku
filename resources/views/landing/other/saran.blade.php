<x-landing>
  <x-slot:title>Semesta Buku | Kotak Saran</x-slot:title>

  <section class="bj_shop_area sec_padding" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card rounded text-center">
            <div class="card-header pt-3">
              <h3 class="card-title">Beri Pertanyaan, Kritik atau Saran</h3>
              @session('success')
                <div class="alert alert-success fw-bold" style="font-size: 1rem;">
                  {{ session('success') }}
                  Berhasil Menambah
                </div>
              @endsession
            </div>
            <div class="card-body">
              <form action="{{ route('rating.post') }}" method="POST" class="row justify-content-center">
                @csrf
                <div class="col-md-8">
                  <div class="form-group mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <div class="d-flex justify-content-center">
                      @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}"
                          class="d-none">
                        <label for="rating-{{ $i }}" class="mx-1">
                          <i class="fa fa-star" style="cursor: pointer;" onclick="setRating({{ $i }})"></i>
                        </label>
                      @endfor
                    </div>
                  </div>
                  <div class="form-group mb-3">
                    <label for="text" class="form-label">Pertanyaan, Kritik atau Saran</label>
                    <textarea required name="text" id="" cols="30" rows="10" class="form-control rounded-md"></textarea>
                  </div>
                  <div class="form-group">
                    <a class="btn btn-danger" href="">Reset</a>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                  </div>
                </div>
              </form>

              <script>
                function setRating(rating) {
                  for (let i = 1; i <= 5; i++) {
                    const star = document.getElementById(`rating-${i}`);
                    const label = document.querySelector(`label[for="rating-${i}"] i`);
                    if (i <= rating) {
                      label.classList.add('text-warning');
                      star.checked = true;
                    } else {
                      label.classList.remove('text-warning');
                    }
                  }
                }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-landing>
