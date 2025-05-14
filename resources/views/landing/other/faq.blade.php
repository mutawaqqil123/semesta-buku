<x-landing>
  <x-slot:title>Semesta Buku | FAQ</x-slot:title>

  <section class="bj_shop_area sec_padding" data-bg-color="#f5f5f5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="text-center mb-4">Frequently Asked Questions (FAQ)</h1>
          <div class="accordion" id="faqAccordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Bagaimana cara mengakses buku?
                  </button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                <div class="card-body">
                  Anda dapat mengakses buku setelah melakukan subscribe pada layanan kami.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Bagaimana cara mencari buku yang saya inginkan?
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                <div class="card-body">
                  Anda dapat menggunakan fitur pencarian di halaman utama untuk mencari buku berdasarkan judul, penulis, atau kategori.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Apakah saya bisa membaca buku secara offline?
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                <div class="card-body">
                  Saat ini, Anda hanya bisa membaca buku secara online melalui platform kami.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Bagaimana cara memberikan ulasan untuk buku yang sudah saya baca?
                  </button>
                </h2>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                <div class="card-body">
                  Anda dapat memberikan ulasan untuk buku yang sudah Anda baca dengan mengunjungi halaman buku tersebut dan mengisi formulir ulasan.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Apakah ada fitur untuk menyimpan buku favorit?
                  </button>
                </h2>
              </div>
              <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
                <div class="card-body">
                  Ya, Anda dapat menyimpan buku favorit Anda dengan menambahkannya ke daftar favorit di akun Anda.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card rounded text-center">
                <div class="card-header pt-3">
                    <h3 class="card-title">Beri Pertanyaan, Kritik atau Saran</h3>
                    @session ('success')
                        <div class="alert alert-success fw-bold" style="font-size: 1rem;">
                            {{ session('success') }}
                            {{-- berhasil anjay --}}
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
                                        <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" class="d-none">
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var faqAccordion = document.getElementById('faqAccordion');
      faqAccordion.addEventListener('click', function (e) {
        if (e.target && e.target.matches('button.btn-link')) {
          var targetCollapse = document.querySelector(e.target.getAttribute('data-target'));
          var isExpanded = targetCollapse.classList.contains('show');
          var allCollapses = faqAccordion.querySelectorAll('.collapse');
          allCollapses.forEach(function (collapse) {
            collapse.classList.remove('show');
          });
          if (!isExpanded) {
            targetCollapse.classList.add('show');
          }
        }
      });
    });
  </script>
</x-landing>
