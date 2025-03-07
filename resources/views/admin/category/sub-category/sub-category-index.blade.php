<x-template>
    <x-slot:title>Admin Semesta Buku - Sub Category {{ $category->name }}</x-slot:title>
    <div class="page-body">
      <div class="container-fluid">
        <div class="page-title">
          <div class="row">
            <div class="col-6">
              <h3>Sub Category {{ $category->name }}</h3>
            </div>
            <div class="col-6">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
                <li class="breadcrumb-item">Menu</li>
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
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
                <h3>Form Create sub Category {{ $category->name }}</h3>
              </div>
              <form action="{{ route('sub-category.store', $category->token_category) }}" method="POST"
                class="needs-validation" novalidate>
                <div class="card-body">
                  @csrf
                  <div class="mb-3">
                    <label for="sub_name" class="form-label">Nama Sub Kategori</label>
                    <input type="text" class="form-control @error('sub_name') is-invalid @enderror" id="sub_name"
                      name="sub_name" value="{{ old('sub_name') }}" required>
                    @error('sub_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer text-end">
                  <button class="btn btn-secondary" type="submit">Save changes</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="card">
              <div class="card-header py-2 border-bottom d-flex justify-content-between align-items-center">
                <h3>List Sub Category {{ $category->name }}</h3>
                <a href="{{ route('category.index') }}" class="btn btn-warning">Kembali</a>
              </div>
              <div class="card-body">
                <div class="dt-ext table-responsive">
                  <table class="display" id="keytable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th> Sub Name</th>
                        <th>Jumlah Buku</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($category->subcategory as $item)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->sub_name }}</td>
                          <td>{{ $item->books->count() }}</td>
                          <td>
                            <ul class="action">
                              <li class="edit"> <a role="button" data-bs-toggle="modal"
                                  data-bs-target="#exampleModal{{ $item->token_subcategory }}"><i
                                    class="icon-pencil-alt"></i></a></li>
                              <li class="delete"><a role="button" data-bs-toggle="modal"
                                  data-bs-target="#deleteModal{{ $item->token_subcategory }}"><i class="icon-trash"></i></a>
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
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th> Sub Name</th>
                        <th>Jumlah Buku</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->

      @foreach ($category->subcategory as $item)
        <div class="modal fade" id="exampleModal{{ $item->token_subcategory }}" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Form Edit {{ $item->name }}</h3>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="{{ route('sub-category.update', $item->token_subcategory) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="sub_name{{ $item->token_subcategory }}" class="form-label">Nama Sub Category</label>
                    <input type="text" class="form-control @error('sub_name') is-invalid @enderror"
                      id="sub_name{{ $item->token_subcategory }}" name="sub_name" value="{{ old('sub_name', $item->sub_name) }}"
                      required>
                    @error('sub_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-secondary" type="submit">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- modal delete --}}
        <div class="modal fade" id="deleteModal{{ $item->token_subcategory }}" tabindex="-1" role="dialog"
          aria-labelledby="deleteModalLabel{{ $item->token_subcategory }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body text-center">
                <div class="text-center">
                  <lord-icon src="https://cdn.lordicon.com/hwjcdycb.json" trigger="loop" delay="1500"
                    state="morph-trash-in" colors="primary:#000000,secondary:#e83a30" style="width:150px;height:150px">
                  </lord-icon>
                </div>
                Are you sure you want to delete the sub category "{{ $item->sub_name }}"?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('sub-category.destroy', $item->token_subcategory) }}" method="POST" class="d-inline">
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
  </x-template>
