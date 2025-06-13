<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('key');
        return view('admin.user.user-view', [
            'users' => $role
                ? User::role($role)->with(['profile', 'subscription'])->get()
                : User::with(['profile', 'subscription'])->get(),
            'role' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'telepon' => 'required|string|max:20',
            'whatsapp' => 'required|string|max:20',
            'status' => 'required|in:siswa,mahasiswa,umum',
            'education_level' => 'required|string',
            'custom_education_level' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required',
        ],
        [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'whatsapp.required' => 'Nomor whatsapp wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
            'education_level.required' => 'Jenjang pendidikan wajib dipilih.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar hanya boleh jpg, jpeg, atau png.',
            'avatar.max' => 'Ukuran avatar maksimal 2MB.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib dipilih.',
        ]);

        // Cek apakah pilihannya 'other', kalau iya ambil dari custom
        $finalEducationLevel = $validated['education_level'] === 'other' ? $validated['custom_education_level'] : $validated['education_level'];

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Handle upload avatar
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move('user', $avatarName);
            $avatarPath = 'user/' . $avatarName;
        }

        $user->assignRole($validated['role']);

        // Simpan ke profile
        $user->profile()->create([
            'phone' => $validated['phone'],
            'telepon' => $validated['telepon'],
            'whatsapp' => $validated['whatsapp'],
            'status' => $validated['status'],
            'jenjang' => $finalEducationLevel,
            'avatar' => $avatarPath,
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    public function show(User $user) {}

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $messages = [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'whatsapp.required' => 'Nomor whatsapp wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
            'education_level.required' => 'Jenjang pendidikan wajib dipilih.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar hanya boleh jpg, jpeg, atau png.',
            'avatar.max' => 'Ukuran avatar maksimal 2MB.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'role.required' => 'Role wajib dipilih.',
        ];

        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|string|max:20',
                'telepon' => 'required|string|max:20',
                'whatsapp' => 'required|string|max:20',
                'status' => 'required|in:siswa,mahasiswa,umum',
                'education_level' => 'required|string',
                'custom_education_level' => 'nullable|string',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'password' => 'nullable|string|confirmed|min:8',
                'role' => 'required',
            ],
            $messages,
        );

        $finalEducationLevel = $validated['education_level'] === 'other' ? $validated['custom_education_level'] : $validated['education_level'];

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
        ]);

        $avatarPath = $user->profile->avatar;

        if ($request->hasFile('avatar')) {
            if ($avatarPath && File::exists($avatarPath)) {
                File::delete($avatarPath);
            }

            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move('user', $avatarName);
            $avatarPath = 'user/' . $avatarName;
        }

        $user->syncRoles([$validated['role']]);

        $user->profile()->update([
            'phone' => $validated['phone'],
            'telepon' => $validated['telepon'],
            'whatsapp' => $validated['whatsapp'],
            'status' => $validated['status'],
            'jenjang' => $finalEducationLevel,
            'avatar' => $avatarPath,
        ]);

        return redirect()->back()->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->blog && $user->blog->count() > 0) {
            return redirect()->back()->with('error', 'User tidak dapat dihapus karena masih memiliki blog yang ditulisnya');
        }

        // Cek dulu kalo profile ada dan avatarnya ada di folder
        if ($user->profile && file_exists($user->profile->avatar)) {
            unlink($user->profile->avatar);
        }

        $user->delete();

        return redirect()->back()->with('success', 'User Berhasil Dihapus');
    }
}
