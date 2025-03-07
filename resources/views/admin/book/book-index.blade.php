<x-template>
  <x-slot:title>Admin Semesta Buku - Buku</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Buku</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item active">Buku</li>
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
              <h3>List Buku</h3>
              <a href="{{ route('book.create') }}" class="btn btn-primary">+ Tambah Buku</a>
            </div>
            <div class="card-body">
              <div class="dt-ext table-responsive">
                <table class="display" id="keytable">
                  <thead>
                    <td>#</td>
                    <td>Nama</td>
                    <td>Author</td>
                    <td>Tahun Publikasi</td>
                    <td>Publish</td>
                    <td>Action</td>
                  </thead>
                  <tbody>
                    @foreach ($books as $book)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <img src="{{ $book->thumbnail }}" alt="{{ $book->title }}"
                              style="width: 50px; height: auto; margin-right: 10px;">
                            <div>
                              <h4><strong>{{ $book->title }}</strong></h4>
                              {{ $book->publisher }}
                            </div>
                          </div>
                        </td>
                        <td>{{ $book->author }}</td>
                        <td class="text-center">{{ $book->year }}</td>
                        <td class="text-center">
                          <div class="flex-grow-1 icon-state">
                            <form method="GET" action="{{ route('book.publish', $book->token_book) }}">
                              <label class="switch">
                                <input type="checkbox" name="publisher" {{ $book->status == 'available' ? 'checked' : '' }}
                                  onchange="this.form.submit();">
                                <span class="switch-state bg-primary"></span>
                              </label>
                            </form>
                          </div>
                        </td>
                        <td>
                          <ul class="action">
                            <li class="edit"> <a href="{{ route('book.edit', $book->token_book) }}"><i
                                  class="icon-pencil-alt"></i></a></li>
                            <li class="delete"><a role="button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $book->token_book }}"><i class="icon-trash"></i></a>
                            </li>
                          </ul>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            @foreach ($books as $item)
            <div class="modal fade" id="deleteModal{{ $item->token_book }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $item->token_book }}" aria-hidden="true">
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
                      <form action="{{ route('book.destroy', $item->token_book) }}" method="POST" class="d-inline">
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
