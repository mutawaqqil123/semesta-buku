<x-template>
    <x-slot:title>Admin Semesta Buku - Plan</x-slot:title>
    <div class="page-body">
      <div class="container-fluid">
        <div class="page-title">
          <div class="row">
            <div class="col-6">
              <h3>Plan</h3>
            </div>
            <div class="col-6">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
                <li class="breadcrumb-item">Menu</li>
                <li class="breadcrumb-item active">Plan</li>
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
                <h3>Form Create Plan</h3>
              </div>
              <form action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data"
                class="needs-validation" novalidate>
                <div class="card-body">
                  @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                      name="name" value="{{ old('name') }}" required>
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="price" class="form-label">harga</label>
                    <input type="number" inputmode="numeric" class="form-control @error('price') is-invalid @enderror" id="price"
                      name="price" value="{{ old('price') }}" required>
                    @error('price')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="duration" class="form-label">Durasi dalam bulan</label>
                    <input type="number" inputmode="numeric" class="form-control @error('duration') is-invalid @enderror" id="duration"
                      name="duration" value="{{ old('duration') }}" required>
                    @error('duration')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                      name="description" value="" required>{{ old('description') }}</textarea>
                    @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer text-end">
                  <a href="" class="btn btn-danger">Reset</a>
                  <button class="btn btn-secondary" type="submit">Save changes</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="card">
              <div class="card-header py-3 border-bottom d-flex justify-content-between">
                <h3>List Plan</h3>
                <h4>Total: {{ $plans->count() }}</h4>
              </div>
              <div class="card-body">
                <div class="dt-ext table-responsive">
                  <table class="display" id="keytable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($plans as $plan)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $plan->name }}</td>
                          <td>@rupiah($plan->price)</td>
                          <td>{{ $plan->duration." Bulan" }}</td>
                          <td>{{ $plan->subscription->where('status', 'active')->count() }}</td>
                          <td>
                            <ul class="action">
                              <li class="edit"> <a role="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal{{ $plan->token_plan }}"><i
                                    class="icon-pencil-alt"></i></a></li>
                              <li class="delete"><a role="button" data-bs-toggle="modal"
                                  data-bs-target="#deleteModal{{ $plan->token_plan }}"><i class="icon-trash"></i></a>
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

      @foreach ($plans as $plan)
        <div class="modal fade" id="exampleModal{{ $plan->token_plan }}" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Form Edit {{ $plan->name }}</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('plan.update', $plan->token_plan) }}" method="POST"
                enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{ old('name', $plan->name) }}" required>
                        @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="price" class="form-label">harga</label>
                        <input type="number" inputmode="numeric" class="form-control @error('price') is-invalid @enderror" id="price"
                          name="price" value="{{ old('price', $plan->price) }}" required>
                        @error('price')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="duration" class="form-label">Durasi dalam bulan</label>
                        <input type="number" inputmode="numeric" class="form-control @error('duration') is-invalid @enderror" id="duration"
                          name="duration" value="{{ old('duration', $plan->duration) }}" required>
                        @error('duration')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                          name="description" value="" required>{{ old('description', $plan->description) }}</textarea>
                        @error('description')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                </div>
                <div class="modal-footer">
                  <a href="" class="btn btn-danger me-auto">Reset</a>
                  <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-secondary" type="submit">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- modal delete --}}
        <div class="modal fade" id="deleteModal{{ $plan->token_plan }}" tabindex="-1" role="dialog"
          aria-labelledby="deleteModalLabel{{ $plan->token_plan }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body text-center">
                <div class="text-center">
                  <lord-icon src="https://cdn.lordicon.com/hwjcdycb.json" trigger="loop" delay="1500"
                    state="morph-trash-in" colors="primary:#000000,secondary:#e83a30" style="width:150px;height:150px">
                  </lord-icon>
                </div>
                Are you sure you want to delete the category "{{ $plan->name }}"?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('plan.destroy', $plan->token_plan) }}" method="POST" class="d-inline">
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
