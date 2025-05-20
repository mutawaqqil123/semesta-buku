<x-template>
  <x-slot:title>Admin Semesta Buku - Blog Category</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Blog Category</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item">Blog</li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-header py-3 border-bottom">
              <h3>Form Create Blog Category</h3>
            </div>
            <form action="{{ route('blog_kategori.store') }}" method="POST"
              class="needs-validation">
              <div class="card-body">
                @csrf
                <div class="">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name') }}" required>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="card-footer text-end">
                <a class="btn btn-danger" href="">Reset</a>
                <button class="btn btn-warning" type="submit">Save</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="card">
            <div class="card-header d-flex justify-content-between py-3 border-bottom">
              <h3>List Category</h3>
              <h4>Total: {{ $categories->count() }}</h4>
            </div>
            <div class="card-body">
              <div class="dt-ext table-responsive">
                <table class="display" id="keytable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Jumlah Berita</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($categories as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ $item->name }}</td>
                        <td>{{ $item->blogs->count() }}</td>
                        <td>
                          <ul class="action">
                            <li class="edit"> <a role="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $item->token_category }}"><i
                                  class="icon-pencil-alt"></i></a></li>
                            <li class="delete"><a role="button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $item->token_category }}"><i class="icon-trash"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>
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

    @foreach ($categories as $item)
      <div class="modal fade" id="exampleModal{{ $item->token_category }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Form Edit {{ $item->name }}</h3>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('blog_kategori.update', $item->token_category) }}" method="POST"
              enctype="multipart/form-data" class="needs-validation" novalidate>
              @csrf
              @method('PATCH')
              <div class="modal-body">
                <div class="mb-3">
                  <label for="name{{ $item->token_category }}" class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name{{ $item->token_category }}" name="name" value="{{ old('name', $item->name) }}"
                    required>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="modal-footer">
                <a href="" class="btn btn-danger me-auto">Reset</a>
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-secondary" type="submit">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      {{-- modal delete --}}
      <div class="modal fade" id="deleteModal{{ $item->token_category }}" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel{{ $item->token_category }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center">
              <div class="text-center">
                <lord-icon src="https://cdn.lordicon.com/hwjcdycb.json" trigger="loop" delay="1500"
                  state="morph-trash-in" colors="primary:#000000,secondary:#e83a30" style="width:150px;height:150px">
                </lord-icon>
              </div>
              Are you sure you want to delete the category "{{ $item->name }}"?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form action="{{ route('blog_kategori.destroy', $item->token_category) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach

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
