<x-template>
  <x-slot:title>Admin Semesta Buku - Plan</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Kritik Saran</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item active">Kritik & Saran</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="">
          <div class="card">
            <div class="card-header py-3 border-bottom d-flex justify-content-between">
              <h3>Kritik & Saran</h3>
              <h4>Total: {{ $rates->count() }}</h4>
            </div>
            <div class="card-body">
              <div class="dt-ext table-responsive">
                <table class="display" id="keytable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Rating</th>
                      <th>text</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($rates as $rate)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rate->user->name }}</td>
                        <td>
                          @for ($i = 1; $i <= 5; $i++)
                            <i class="fa fa-star{{ $i <= $rate->rating ? '' : '-o' }}" aria-hidden="true"></i>
                          @endfor
                        </td>
                        <td>{!! $rate->text !!}</td>
                        <td>
                          <ul class="action">

                            <li class="delete"><a role="button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $rate->token_rating }}"><i class="icon-trash"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>

                      <!-- Modal Body -->
                      <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                      <div class="modal fade" id="deleteModal{{ $rate->token_rating }}" tabindex="-1"
                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId"
                        aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalTitleId">
                                Hapus Kritik Saran dari {{ $rate->user->name }}
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center text-danger">
                                Data yang dihapus tidak dapat dikembalikan lagi
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                              </button>
                              {{-- <form action="{{  }}" method="POST">
                                @csrf
                                @method('DELETE') --}}
                                <a href="{{ route('rate.remove', $rate->token_rating) }}" class="btn btn-primary">Hapus</a>
                              {{-- </form> --}}

                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Optional: Place to the bottom of scripts -->
                      <script>
                        const myModal = new bootstrap.Modal(
                          document.getElementById("modalId"),
                          options,
                        );
                      </script>

                    @empty
                      <tr>
                        <td colspan="5" class="text-center">Data not found</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->



  </div>
  <script>
    document.getElementById('drop-area-create').addEventListener('click', function(event) {
      if (event.target.tagName !== 'INPUT') {
        document.getElementById('icon-create').click();
      }
    });

    document.getElementById('icon-create').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('preview-create').src = e.target.result;
          document.getElementById('preview-create').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('drop-area-create').addEventListener('dragover', function(event) {
      event.preventDefault();
      event.stopPropagation();
      this.classList.add('dragging');
    });

    document.getElementById('drop-area-create').addEventListener('dragleave', function(event) {
      event.preventDefault();
      event.stopPropagation();
      this.classList.remove('dragging');
    });

    document.getElementById('drop-area-create').addEventListener('drop', function(event) {
      event.preventDefault();
      event.stopPropagation();
      this.classList.remove('dragging');
      const file = event.dataTransfer.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('preview-create').src = e.target.result;
          document.getElementById('preview-create').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
        document.getElementById('icon-create').files = event.dataTransfer.files;
      }
    });

    document.querySelectorAll('[id^="drop-area"]').forEach(dropArea => {
      if (dropArea.id === 'drop-area-create') return;
      const token = dropArea.id.replace('drop-area', '');
      const iconInput = document.getElementById(`icon${token}`);
      const preview = document.getElementById(`preview${token}`);

      dropArea.addEventListener('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
          iconInput.click();
        }
      });

      iconInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
          };
          reader.readAsDataURL(file);
        }
      });

      dropArea.addEventListener('dragover', function(event) {
        event.preventDefault();
        event.stopPropagation();
        this.classList.add('dragging');
      });

      dropArea.addEventListener('dragleave', function(event) {
        event.preventDefault();
        event.stopPropagation();
        this.classList.remove('dragging');
      });

      dropArea.addEventListener('drop', function(event) {
        event.preventDefault();
        event.stopPropagation();
        this.classList.remove('dragging');
        const file = event.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
          };
          reader.readAsDataURL(file);
          iconInput.files = event.dataTransfer.files;
        }
      });
    });
  </script>
</x-template>
