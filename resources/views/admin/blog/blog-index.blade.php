<x-template>
  <x-slot:title>Admin Semesta Buku - Berita</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Berita</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item active">Berita</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header py-3 border-bottom d-flex justify-content-between align-items-center">
              <h3>List Berita</h3>
              <h4>Total: {{ $blogs->count() }}</h4>
              <a href="{{ route('blogs.create') }}" class="btn btn-primary">+ Tambah Berita</a>
            </div>
            <div class="card-body">
              <div class="dt-ext table-responsive">
                <table class="display" id="keytable">
                  <thead>
                    <td>#</td>
                    <td>Nama</td>
                    <td>Penulis</td>
                    <td>Tanggal Publikasi</td>
                    {{-- <td>Kategori</td> --}}
                    <td>Action</td>
                  </thead>
                  <tbody>
                    @foreach ($blogs as $blog)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}"
                              style="width: 50px; height: auto; margin-right: 10px;">
                            <div>
                              <h4><strong>{{ $blog->title }}</strong></h4>
                              {{ $blog->publisher }}
                            </div>
                          </div>
                        </td>
                        <td>{{ $blog->writer->name }}</td>
                        <td class="text-center">{{ $blog->created_at->format('d m Y') }}</td>
                        {{-- <td class="text-center">{{ $blog->category->name }}</td> --}}
                        <td>
                          <ul class="action">
                            <li class="edit"> <a href="{{ route('blogs.edit', $blog->token_blog) }}"><i
                                  class="icon-pencil-alt"></i></a></li>
                            <li class="delete"><a role="button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $blog->token_blog }}"><i class="icon-trash"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            @foreach ($blogs as $item)
            <div class="modal fade" id="deleteModal{{ $item->token_blog }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $item->token_blog }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-body text-center">
                      <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/hwjcdycb.json" trigger="loop" delay="1500"
                          state="morph-trash-in" colors="primary:#000000,secondary:#e83a30" style="width:150px;height:150px">
                        </lord-icon>
                      </div>
                      Are you sure you want to delete the "{{ $item->title }}"?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <form action="{{ route('blogs.destroy', $item->token_blog) }}" method="POST" class="d-inline">
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
        </div>
      </div>
    </div>

    </div>
</x-template>
