<x-template>
  <x-slot:title>Admin Semesta Buku - Edit Buku {{ $book->title }}</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Edit Buku</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item">Buku</li>
              <li class="breadcrumb-item active">Edit Buku {{ $book->title }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <form action="{{ route('book.update', $book->token_book) }}" method="POST" class="needs-validation"
              novalidate enctype="multipart/form-data">
              @csrf
              @method('PATCH')
              <div class="card-header py-3 border-bottom d-flex justify-content-between align-items-center">
                <h3>Form Edit Buku {{ $book->title }}</h3>
                <div class="btn-group">
                    <a href="" class="btn btn-danger">- Reset</a>
                  <a href="{{ route('book.index') }}" class="btn btn-warning">< Kembali</a>
                  <button type="submit" class="btn btn-primary">^ Update</button>
                </div>
              </div>
              <div class="card-body">
                <div class="form theme-form row">
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Nama Buku</label>
                          <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            required placeholder="Semesta Buku" value="{{ old('title', $book->title) }}">
                          @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Penulis</label>
                          <input class="form-control @error('author') is-invalid @enderror" type="text"
                            name="author" required placeholder="Author" value="{{ old('author', $book->author) }}">
                          @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Penerbit</label>
                          <input class="form-control @error('publisher') is-invalid @enderror" type="text"
                            name="publisher" required placeholder="Semesta Infomedia"
                            value="{{ old('publisher', $book->publisher) }}">
                          @error('publisher')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label>Tahun Terbit</label>
                          <input type="number" class="form-control @error('year') is-invalid @enderror" name="year"
                            min="1000" max="2100" required inputmode="numeric" placeholder="2000"
                            value="{{ old('year', $book->year) }}">
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
                            <option value="available"
                              {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Publish</option>
                            <option value="unavailable"
                              {{ old('status', $book->status) == 'unavailable' ? 'selected' : '' }}>Tidak Publish
                            </option>
                          </select>
                          @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label for="" class="form-check-label">
                            <input type="checkbox" name="premium" id="" class="form-check-input" value="premium" {{ old('premium', $book->access_type) === 'premium' ? 'checked' : '' }}> Premium ?
                          </label>
                          @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label>Kategori / Genre</label>
                          <select class="form-select js-example-basic-multiple @error('category') is-invalid @enderror"
                            name="category[]" required multiple="multiple">
                            @foreach ($categories as $item)
                              <optgroup label="{{ $item->name }}">
                                @foreach ($item->subcategory as $sub)
                                  <option value="{{ $sub->id }}"
                                    {{ collect(old('category', $book->subcategory->pluck('id')->toArray()))->contains($sub->id) ? 'selected' : '' }}>
                                    {{ $sub->sub_name }}</option>
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
                          <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea4"
                            rows="3" name="description">{{ old('description', $book->description) }}</textarea>
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
                          <input class="form-control @error('cover') is-invalid @enderror" type="file" name="cover"
                            id="cover" accept="image/*" style="display: none;">
                          <div id="cover-preview" class="border p-3 text-center" style="cursor: pointer;">
                            <p>Drag & Drop or Click to Upload Cover Image</p>
                            <img id="cover-image" src="{{ asset($book->thumbnail) }}" alt="Cover Image Preview"
                              style="max-width: 100%; height: auto;">
                          </div>
                          @error('cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label for="validationCustom01" class="form-label">Upload File Buku</label>
                          <input class="form-control @error('file') is-invalid @enderror" type="file"
                            name="file">
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
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
                <h3>File saat ini</h3>
            </div>
            <div class="card-body">
                <div id="pdf-viewer" class="text-center"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const url = "{{ route('view.book', basename($book->file_url)) }}";

    const pdfjsLib = window['pdfjsLib'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

    const loadingTask = pdfjsLib.getDocument(url);
    loadingTask.promise.then(pdf => {
        pdf.getPage(1).then(page => {
            const scale = 1.5;
            const viewport = page.getViewport({ scale });

            const canvas = document.createElement('canvas');
            document.getElementById('pdf-viewer').appendChild(canvas);

            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = { canvasContext: context, viewport: viewport };
            page.render(renderContext);
        });
    });
  </script>

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

    document.addEventListener('contextmenu', function(event) {
      event.preventDefault();
      const menu = document.createElement('div');
      menu.style.position = 'absolute';
      menu.style.top = `${event.clientY}px`;
      menu.style.left = `${event.clientX}px`;
      menu.style.backgroundColor = '#fff';
      menu.style.border = '1px solid #ccc';
      menu.style.padding = '10px';
      menu.style.zIndex = 1000;
      menu.innerHTML = '<a href="{{ route('dashboard') }}">Kembali ke Home</a>';
      document.body.appendChild(menu);

      document.addEventListener('click', function() {
        menu.remove();
      }, {
        once: true
      });
    });

  </script>
</x-template>
