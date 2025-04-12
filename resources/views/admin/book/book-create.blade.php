<x-template>
  <x-slot:title>Admin Semesta Buku - Tambah Buku</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Tambah Buku</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item">Buku</li>
              <li class="breadcrumb-item active">Tambah Buku</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <form action="{{ route('book.store') }}" method="POST" class="needs-validation" novalidate
              enctype="multipart/form-data">
              @csrf
              <div class="card-header py-3 border-bottom d-flex justify-content-between align-items-center">
                <h3>Form Tambah Buku</h3>
                <div class="btn-group">
                  <a href="{{ route('book.index') }}" class="btn btn-warning">Kembali</a>
                  <button type="submit" class="btn btn-primary">+ Submit</button>
                </div>
              </div>
              <div class="card-body">
                <div class="form theme-form row">
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Nama Buku</label>
                          <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" required placeholder="Semesta Buku" value="{{ old('title') }}">
                          @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Penulis</label>
                          <input class="form-control @error('author') is-invalid @enderror" type="text" name="author" required placeholder="Author" value="{{ old('author') }}">
                          @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Penerbit</label>
                          <input class="form-control @error('publisher') is-invalid @enderror" type="text" name="publisher" required placeholder="Semesta Infomedia" value="{{ old('publisher') }}">
                          @error('publisher')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Tahun Terbit</label>
                          <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" min="1000" max="2100" required inputmode="numeric" placeholder="2000" value="{{ old('year') }}">
                          @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label>Status Publish</label>
                          <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Publish</option>
                            <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Tidak Publish</option>
                          </select>
                          @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label for="" class="form-check-label">
                            <input type="checkbox" name="premium" id="" class="form-check-input" value="1" {{ old('premium') ? 'checked' : '' }}> Premium ?
                          </label>
                          @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label>Kategori / Genre</label>
                          <select class="form-select js-example-basic-multiple @error('category') is-invalid @enderror" name="category[]" required
                            multiple="multiple">
                            @foreach ($categories as $item)
                              <optgroup label="{{ $item->name }}">
                                @foreach ($item->subcategory as $sub)
                                  <option value="{{ $sub->id }}" {{ (collect(old('category'))->contains($sub->id)) ? 'selected' : '' }}>{{ $sub->sub_name }}</option>
                                @endforeach
                              </optgroup>
                            @endforeach
                          </select>
                          @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label>Deskripsi / Sinopsis</label>
                          <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea4" rows="3" name="description">{{ old('description') }}</textarea>
                          @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label for="cover" class="form-label">Upload Cover Buku</label>
                          <input class="form-control @error('cover') is-invalid @enderror" type="file" name="cover" id="cover" accept="image/*" style="display: none;" required>
                          <div id="cover-preview" class="border p-3 text-center" style="cursor: pointer;">
                            <p>Drag & Drop or Click to Upload Cover Image</p>
                            <img id="cover-image" src="#" alt="Cover Image Preview" style="display: none; max-width: 100%; height: auto;">
                          </div>
                          @error('cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label for="validationCustom01" class="form-label">Upload File Buku</label>
                          <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" required>
                          @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('cover-preview').addEventListener('click', function() {
      document.getElementById('cover').click();
    });

    document.getElementById('cover').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('cover-image').src = e.target.result;
          document.getElementById('cover-image').style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('cover-preview').addEventListener('dragover', function(event) {
      event.preventDefault();
      event.stopPropagation();
      this.classList.add('dragging');
    });

    document.getElementById('cover-preview').addEventListener('dragleave', function(event) {
      event.preventDefault();
      event.stopPropagation();
      this.classList.remove('dragging');
    });

    document.getElementById('cover-preview').addEventListener('drop', function(event) {
      event.preventDefault();
      event.stopPropagation();
      this.classList.remove('dragging');
      const file = event.dataTransfer.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('cover-image').src = e.target.result;
          document.getElementById('cover-image').style.display = 'block';
        };
        reader.readAsDataURL(file);
        document.getElementById('cover').files = event.dataTransfer.files;
      }
    });
  </script>
</x-template>
