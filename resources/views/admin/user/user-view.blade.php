<x-template>
  <x-slot:title>Admin Semesta Buku - User Management</x-slot:title>
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>User Management</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
              <li class="breadcrumb-item">Menu</li>
              <li class="breadcrumb-item active">User Management</li>
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
              <h3>Form Create User</h3>
            </div>
            <form action="{{ route('usr.store') }}" method="POST" class="needs-validation"
              enctype="multipart/form-data">
              <div class="card-body">
                @csrf
                <!-- Avatar -->
                <div class="mb-3">
                  <label for="avatar" class="form-label">Foto Profil</label>
                  <input class="form-control" type="file" id="avatar" name="avatar" accept="image/*"
                    onchange="previewAvatar(event)">
                  <div class="mt-2">
                    <img id="avatar-preview" src="#" alt="Preview" style="max-height: 150px; display: none;"
                      class="img-thumbnail">
                  </div>
                </div>

                <!-- Role -->
                <div class="mb-3" style="display: none">
                  <label for="role" class="form-label">Role</label>
                  <select class="form-select" id="role" name="role" required>
                    <option selected disabled>Pilih Role</option>
                    {{-- <option value="admin" {{ old('role') || request('key') == 'super_admin' ? 'selected' : '' }}>Super Admin</option> --}}
                    <option value="admin" {{ old('role') == 'admin' || request('key') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' || request('key') == 'user' ? 'selected' : '' }}>User</option>
                  </select>
                  @error('role')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Name -->
                <div class="mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    required autofocus>
                  @error('name')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3">
                  <label for="phone" class="form-label">Nomor Telepon</label>
                  <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                    required>
                  @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="telepon" class="form-label">Nomor WA</label>
                  <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}"
                    required>
                  @error('telepon')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Status -->
                <div class="mb-3">
                  <label for="status" class="form-label">Status</label>
                  <select class="form-select" id="status" name="status" required>
                    <option selected disabled>Pilih Status</option>
                    <option value="siswa" {{ old('status') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="mahasiswa" {{ old('status') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="umum" {{ old('status') == 'umum' ? 'selected' : '' }}>Umum</option>
                  </select>
                  @error('status')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Jenjang Pendidikan -->
                <div class="mb-3">
                  <label for="education_level" class="form-label">Jenjang Pendidikan</label>
                  <select class="form-select" id="education_level" name="education_level" required
                    onchange="toggleCustomEducation(this)">
                    <option selected disabled>Pilih Jenjang Pendidikan</option>
                    <option value="SLTP" {{ old('education_level') == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                    <option value="SLTA" {{ old('education_level') == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                    <option value="PT" {{ old('education_level') == 'PT' ? 'selected' : '' }}>PT</option>
                    <option value="other" {{ old('education_level') == 'other' ? 'selected' : '' }}>Lainnya</option>
                  </select>
                  @error('education_level')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Custom Jenjang Pendidikan -->
                <div class="mb-3" id="custom_education_level_container" style="display: none;">
                  <label for="custom_education_level" class="form-label">Masukkan Jenjang Pendidikan</label>
                  <input type="text" class="form-control" id="custom_education_level"
                    name="custom_education_level" value="{{ old('custom_education_level') }}">
                  @error('custom_education_level')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                      <i data-feather="eye"> </i>
                    </button>
                  </div>
                  @error('password')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation"
                      name="password_confirmation" required>
                    <button class="btn btn-outline-secondary" type="button"
                      onclick="togglePassword('password_confirmation')">
                      <i data-feather="eye"> </i>
                    </button>
                  </div>
                  @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
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
              <h3>List User</h3>
              <h4>Total: {{ $users->count() }}</h4>
            </div>
            <div class="card-body">
              <div class="dt-ext table-responsive">
                <table class="display" id="keytable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $item)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                          <p>{{ $item->roles->pluck('name')->join(', ') }}</p>
                          <small>
                            @if ($item->roles->pluck('name')->contains('user'))
                              @if ($item->subscription->where('status', 'active')->count() > 0)
                                <span class="badge bg-success">Premium</span>
                              @else
                                <span class="badge bg-secondary">Free</span>
                              @endif
                            @endif
                          </small>
                        </td>
                        <td>
                          <ul class="action">
                            <li class="edit"> <a role="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $item->id }}"><i class="icon-pencil-alt"></i></a>
                            </li>
                            <li class="delete"><a role="button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $item->id }}"><i class="icon-trash"></i></a>
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

    {{-- @foreach ($users as $item) --}}
    {{-- @dd($item) --}}
    @foreach ($users as $item)
      <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ route('usr.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            class="needs-validation" novalidate>
            @csrf
            @method('PATCH')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">Edit User: {{ $item->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <!-- Avatar Preview -->
                <div class="mb-3 text-center">
                  @if (!empty($item->profile->avatar) && file_exists(public_path($item->profile->avatar)))
                    <img src="{{ asset($item->profile->avatar) }}" alt="Avatar" class="img-thumbnail"
                      style="max-height:150px;">
                  @else
                    <img src="https://via.placeholder.com/150" alt="Avatar" class="img-thumbnail"
                      style="max-height:150px;">
                  @endif
                </div>


                <!-- Avatar Upload -->
                <div class="mb-3">
                  <label for="avatar_edit_{{ $item->id }}" class="form-label">Foto Profil</label>
                  <input class="form-control" type="file" id="avatar_edit_{{ $item->id }}" name="avatar"
                    accept="image/*" onchange="previewAvatarEdit(event, {{ $item->id }})">
                  <div class="mt-2">
                    <img id="avatar-edit-preview-{{ $item->id }}" src="#" alt="Preview"
                      style="max-height: 150px; display: none;" class="img-thumbnail">
                  </div>
                </div>

                <!-- Role -->
                <div class="mb-3" style="display: none">
                  <label for="role_edit_{{ $item->id }}" class="form-label">Role</label>
                  <select class="form-select" id="role_edit_{{ $item->id }}" name="role" required>
                    <option disabled>Pilih Role</option>
                    {{-- <option value="super_admin"
                      {{ $item->roles->pluck('name')->contains('super_admin') ? 'selected' : '' }}>Super Admin</option> --}}
                    <option value="admin" {{ $item->roles->pluck('name')->contains('admin') ? 'selected' : '' }}>
                      Admin</option>
                    <option value="user" {{ $item->roles->pluck('name')->contains('user') ? 'selected' : '' }}>User
                    </option>
                  </select>
                </div>

                <!-- Name -->
                <div class="mb-3">
                  <label for="name_edit_{{ $item->id }}" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="name_edit_{{ $item->id }}" name="name"
                    value="{{ $item->name }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label for="email_edit_{{ $item->id }}" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email_edit_{{ $item->id }}" name="email"
                    value="{{ $item->email }}" required>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                  <label for="phone_edit_{{ $item->id }}" class="form-label">Nomor Telepon</label>
                  <input type="text" class="form-control" id="phone_edit_{{ $item->id }}" name="phone"
                    value="{{ $item->profile->phone }}" required>
                </div>
                <div class="mb-3">
                  <label for="phone_edit_{{ $item->id }}" class="form-label">Nomor WA</label>
                  <input type="text" class="form-control" id="phone_edit_{{ $item->id }}" name="telepon"
                    value="{{ $item->profile->telepon }}" required>
                </div>

                <!-- Status -->
                <div class="mb-3">
                  <label for="status_edit_{{ $item->id }}" class="form-label">Status</label>
                  <select class="form-select" id="status_edit_{{ $item->id }}" name="status" required>
                    <option disabled>Pilih Status</option>
                    <option value="siswa" {{ $item->status == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    <option value="mahasiswa" {{ $item->status == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="umum" {{ $item->status == 'umum' ? 'selected' : '' }}>Umum</option>
                  </select>
                </div>

                <!-- Education Level -->
                <div class="mb-3">
                  <label for="education_level_edit_{{ $item->id }}" class="form-label">Jenjang Pendidikan</label>
                  <select class="form-select" id="education_level_edit_{{ $item->id }}" name="education_level"
                    required onchange="toggleCustomEducationEdit(this, {{ $item->id }})">
                    <option disabled>Pilih Jenjang Pendidikan</option>
                    <option value="SLTP" {{ $item->education_level == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                    <option value="SLTA" {{ $item->education_level == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                    <option value="PT" {{ $item->education_level == 'PT' ? 'selected' : '' }}>PT</option>
                    <option value="other" {{ $item->education_level == 'other' ? 'selected' : '' }}>Lainnya</option>
                  </select>
                </div>

                <!-- Custom Education -->
                <div class="mb-3" id="custom_education_level_container_edit_{{ $item->id }}"
                  style="display: {{ $item->education_level == 'other' ? 'block' : 'none' }}">
                  <label for="custom_education_level_edit_{{ $item->id }}" class="form-label">Masukkan Jenjang
                    Pendidikan</label>
                  <input type="text" class="form-control" id="custom_education_level_edit_{{ $item->id }}"
                    name="custom_education_level" value="{{ $item->custom_education_level }}">
                </div>

                <!-- Password (optional) -->
                <div class="mb-3">
                  <label for="password_edit_{{ $item->id }}" class="form-label">Password (Kosongkan jika tidak
                    ingin diubah)</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password_edit_{{ $item->id }}"
                      name="password" autocomplete="new-password">
                    <button class="btn btn-outline-secondary" type="button"
                      onclick="togglePassword('password_edit_{{ $item->id }}')">
                      <i data-feather="eye"> </i>
                    </button>
                  </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                  <label for="password_confirmation_edit_{{ $item->id }}" class="form-label">Konfirmasi
                    Password</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation_edit_{{ $item->id }}"
                      name="password_confirmation" autocomplete="new-password">
                    <button class="btn btn-outline-secondary" type="button"
                      onclick="togglePassword('password_confirmation_edit_{{ $item->id }}')">
                      <i data-feather="eye"> </i>
                    </button>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>



      <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
        {{-- @dd($item->id) --}} aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center">
              <div class="text-center">
                <lord-icon src="https://cdn.lordicon.com/hwjcdycb.json" trigger="loop" delay="1500"
                  state="morph-trash-in" colors="primary:#000000,secondary:#e83a30" style="width:150px;height:150px">
                </lord-icon>
              </div>
              Are you sure you want to delete the Users "{{ $item->name }}"?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form action="{{ route('usr.destroy', $item->id) }}" method="POST" class="d-inline">
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
  <script>
    function toggleCustomEducation(select) {
      const otherInput = document.getElementById('custom_education_level_container');
      if (select.value === 'other') {
        otherInput.style.display = 'block';
      } else {
        otherInput.style.display = 'none';
      }
    }

    function togglePassword(id) {
      const input = document.getElementById(id);
    //   const eye = document.getElementById(id)
      if (input.type === "password") {
        input.type = "text";
      } else {
        input.type = "password";
      }
    }

    function previewAvatar(event) {
      const preview = document.getElementById('avatar-preview');
      const file = event.target.files[0];
      if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
      } else {
        preview.src = '';
        preview.style.display = 'none';
      }
    }

    // Auto-show custom education level if already selected (e.g. on validation error)
    document.addEventListener('DOMContentLoaded', function() {
      const select = document.getElementById('education_level');
      if (select.value === 'other') {
        toggleCustomEducation(select);
      }
    });
  </script>

  <script>
    // Preview Avatar Create
    function previewAvatar(event) {
      const input = event.target;
      const preview = document.getElementById('avatar-preview');
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
      } else {
        preview.style.display = 'none';
      }
    }

    // Preview Avatar Edit, terima id user supaya beda setiap modal
    function previewAvatarEdit(event, id) {
      const input = event.target;
      const preview = document.getElementById('avatar-edit-preview-' + id);
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
      } else {
        preview.style.display = 'none';
      }
    }

    // Toggle password visibility, terima id input password
    function togglePassword(id) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
      } else {
        input.type = "password";
      }
    }

    // Toggle custom education create form
    function toggleCustomEducation(select) {
      const container = document.getElementById('custom_education_level_container');
      if (select.value === 'other') {
        container.style.display = 'block';
      } else {
        container.style.display = 'none';
      }
    }

    // Toggle custom education edit form by user id
    function toggleCustomEducationEdit(select, id) {
      const container = document.getElementById('custom_education_level_container_edit_' + id);
      if (select.value === 'other') {
        container.style.display = 'block';
      } else {
        container.style.display = 'none';
      }
    }
  </script>

</x-template>
