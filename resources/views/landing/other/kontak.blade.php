<x-landing>
  <x-slot:title>Semesta Buku | Sosial Media</x-slot:title>

  <section class="bj_shop_area sec_padding" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="text-center mb-4">Sosial Media</h1>
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Alamat</h5>
              <p class="card-text">Jl. Semesta No. 123, Jakarta</p>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Email</h5>
              <p class="card-text">- support@semestabuku.com</p>
              <a href="mailto:aqillazvegas655@gmail.com">
                <p class="card-text">- aqillazvegas655@gmail.com</p>
              </a>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Telepon</h5>
              <p class="card-text">- (021) 123-4567</p>
              {{-- <p class="card-text">- 087 887 811 344</p> --}}
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">WhatsApp</h5>
              <p class="card-text mb-0">
                - <a href="https://wa.me/6282141919033" target="_blank" class="text-success text-decoration-none">
                    <i class="fab fa-whatsapp"></i> Admin: 0821 4191 9033
                  </a>
              </p>
              <p class="card-text mb-0">
                - <a href="https://wa.me/6287887811344" target="_blank" class="text-success text-decoration-none">
                    <i class="fab fa-whatsapp"></i> Aqill: 087 887 811 344
                  </a>
              </p>
              {{-- <p class="card-text">- 087 887 811 344</p> --}}
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Jam Operasional</h5>
              <p class="card-text">Senin - Jumat, 09.00 - 17.00 WIB</p>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body text-center">
              <h5 class="card-title">Ikuti Kami</h5>
              <div class="d-flex justify-content-center">
                <a href="https://www.instagram.com/a_qiiillll?igsh=ZDNxMnhnbTQ4YjVq" target="_blank" class="me-3">
                  <i class="fab fa-instagram fa-2x text-danger"></i>
                </a>
                <a href="https://www.facebook.com/share/15qksvqKj8/" target="_blank" class="me-3">
                  <i class="fab fa-facebook fa-2x text-primary"></i>
                </a>
                <a href="http://t.me/Mutawaqqil01" target="_blank">
                  <i class="fab fa-telegram fa-2x text-info"></i>
                </a>
              </div>
            </div>
          </div>
          {{-- <div class="card rounded text-center">
            <div class="card-header pt-3">
              <h3 class="card-title">Beri Pertanyaan, Kritik atau Saran</h3>
              @session('success')
                <div class="alert alert-success fw-bold" style="font-size: 1rem;">
                  {{ session('success') }}
                  Berhasil Membuat
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
          </div> --}}
        </div>
      </div>
    </div>
  </section>
</x-landing>
