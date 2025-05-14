<x-template>
  <x-slot:title>Admin Semesta Buku - Blog Create</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Blog Create</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item">Blog</li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data"
              class="needs-validation">
              @csrf
              <input type="hidden" name="token_blog" value="{{ Str::random(16) }}">

              <div class="card-header py-3 border-bottom d-flex justify-content-between align-items-center">
                <h3>Form Create Blog</h3>
                <div class="btn-group">
                  <a href="" class="btn btn-danger">Reset</a>
                  <a href="{{ route('blogs.index') }}" class="btn btn-warning">Kembali</a>
                  <button type="submit" class="btn btn-primary">+ Submit</button>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <!-- Kiri -->
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label for="title" class="form-label">Judul</label>
                      <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                      <label for="blog_category_id" class="form-label">Kategori</label>
                      <select name="blog_category_id" id="blog_category_id" class="form-select" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <!-- Kanan -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="thumbnail" class="form-label">Thumbnail</label>
                      <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*"
                        onchange="previewThumbnail(event)" required>
                      <img id="thumbnail-preview" src="#" alt="Preview" class="img-fluid mt-2 d-none"
                        style="max-height: 200px;">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="mb-3">
                        <label for="content">Konten</label>
                        <textarea name="content" id="content" cols="30" rows="10"></textarea>
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
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
  <script>
    function previewThumbnail(event) {
      const input = event.target;
      const preview = document.getElementById('thumbnail-preview');

      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</x-template>
