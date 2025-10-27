<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->role ?? 'Siswa';

        $load['users'] = User::when($request->keyword, function ($query) use ($request) {
            // Group keyword conditions so they won't bypass role-based filtering
            return $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->keyword}%")
                    ->orWhere('email', 'like', "%{$request->keyword}%")
                    ->orWhere('telepon', 'like', "%{$request->keyword}%")
                    ->orWhere('asal_sekolah', 'like', "%{$request->keyword}%");
            });
        })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->where('jenjang', $request->jenjang);
            })
            ->when($request->golongan, function ($query) use ($request) {
                return $query->where('golongan', $request->golongan);
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->where('kelas', $request->kelas);
            })
            ->when($request->tipe_siswa, function ($query) use ($request) {
                return $query->where('tipe_siswa', $request->tipe_siswa);
            })
            ->when($role, function ($query) use ($role) {
                return $query->where(function ($q) use ($role) {
                    if ($role === 'Siswa') {
                        // Only include users that are explicitly Siswa
                        $q->where(function ($qq) {
                            $qq->whereHas('roles', function ($r) {
                                $r->where('name', 'Siswa');
                            })->orWhereIn('roles_id', [1]);;
                        });
                    } else {
                        // Admin & Pengajar tab: only include Admin OR Pengajar (legacy ids 2 or 3)
                        $q->where(function ($qq) {
                            $qq->whereHas('roles', function ($r) {
                                $r->whereIn('name', ['Admin', 'Pengajar']);
                            })->orWhereIn('roles_id', [2, 3]);
                        });
                    }
                });
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        $load['roles'] = Role::get();
        $load['permissions'] = Permission::get();
        $load['keyword'] = $request->keyword;
        $load['filter_role'] = $request->role;
        $load['filter_jenjang'] = $request->jenjang;
        $load['filter_kelas'] = $request->kelas;
        $load['filter_golongan'] = $request->golongan;
        $load['roleX'] = $role;

        return view('pages.panel.user.index', ($load));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $load['title'] = "Tambah User";
        $load['sub_title'] = "";
        $load['roles'] = Role::latest()->get();
        $load['permissions'] = Permission::latest()->get();
        $load['roleX'] = $request->roleX ?? 'Siswa';

        return view('pages.panel.user.create', $load);
    }

    public function edit($id, Request $request)
    {
        $load['title'] = "Edit User";
        $load['sub_title'] = "";

        $user = User::find($id);

        $load['roleX'] = $request->roleX;
        $load['user'] = $user;
        $load['userRole'] = $user->roles->pluck('name')->toArray();
        $load['roles'] = Role::latest()->get();
        $load['permissions'] = Permission::latest()->get();
        $load['userPermission'] = $user->permissions->pluck('name')->toArray();
        //dd($load);
        return view('pages.panel.user.edit', ($load));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $roleX = $user->roles->pluck('name')->first() ?? '-';

        // Ambil semua nilai tryout milik user ini
        $nilaiTryout = \App\Models\TryoutNilai::where('user_id', $user->id)->get();

        // Hitung rata-rata nilai (jika ingin ditampilkan)
        $rataRataNilai = $nilaiTryout->avg('nilai') ?? 0;

        return view('pages.panel.user.detail', compact('user', 'roleX', 'nilaiTryout', 'rataRataNilai'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {

        if ($request->rolex == 'Siswa') {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|unique:users,email,' . $user->id,
                'telepon' => 'required|numeric',
                'asal_sekolah' => 'required|string|max:255',
                'jenjang' => 'required|string|in:SD,SMP,SMA',
                'kelas' => 'required|integer|min:1|max:12',
                //'golongan' => 'nullable|string|max:50',
                'nama_orang_tua' => 'required|string',
                'telp_orang_tua' => 'required|numeric',
                'alamat' => 'required|string|max:255',
                'tipe_siswa' => 'required|string|in:Cendekia,Umum',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|unique:users,email,' . $user->id,
                'telepon' => 'required|numeric',
            ]);
        }

        $validated = $validator->validated();

        if ($request->password) {
            $request->validate([
                'password' => 'min:8'
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        //dd($validated);
        
        $user->update($validated); 


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/avatar';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->storeAs($directory, $fileName);

            $file = $directory . '/' . $fileName;

            //dd($upload);
            $user->update(['avatar' => $file]);
        }
        // Only allow the currently authenticated admin to change roles/permissions
        if (Auth::user() && Auth::user()->hasRole('Admin')) {
            $user->syncRoles($request->get('role'));
            $user->syncPermissions($request->get('permissions'));
        }


        return redirect()->route('panel.user.index', 'role=' . $request->rolex)
            ->withSuccess(('User berhasil diupdate.'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if ($request->rolex == 'Siswa') {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telepon' => 'required|numeric',
                'asal_sekolah' => 'required|string|max:255',
                'jenjang' => 'required|string|in:SD,SMP,SMA',
                'kelas' => 'required|integer|min:1|max:12',
                //'golongan' => 'nullable|string|max:50',
                'tipe_siswa' => 'required|string|in:Cemdekia,Umum',
                'nama_orang_tua' => 'required|string',
                'telp_orang_tua' => 'required|numeric',
                'alamat' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telepon' => 'required|numeric',
                'password' => 'required|string|min:8',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'asal_sekolah' => $request->asal_sekolah,
            'jenjang' => $request->jenjang,
            //'golongan' => $request->golongan ?? null,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telp_orang_tua' => $request->telp_orang_tua,
            'tipe_siswa' => $request->tipe_siswa,
            'password' => Hash::make($request->password),

        ]);
        //dd($user->id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/avatar';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->storeAs($directory, $fileName);

            $file = $directory . '/' . $fileName;
            //dd($upload);
            $user->update(['avatar' => $file]);
        }
        //die;

        $role = $request->get('role') ?? 'Siswa';
        $user->syncRoles($role);
        $user->syncPermissions($request->get('permissions'));

        return redirect()->route('panel.user.index', 'role=' . $request->rolex)
            ->withSuccess(('User Berhasil ditambahkan.'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()
            ->withSuccess(('User Berhasil dihapus.'));
    }

    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('Siswa')) {
                Auth::logout();
                return redirect('/')->with('error', 'Anda tidak memiliki akses.');
            }
            return redirect()->route('panel.dashboard')->with('info', 'Anda sudah logged in.');
        }

        return view('pages.panel.login');
    }

    public function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Authentication passed...
            return redirect()->intended(route('panel.dashboard'))->with('success', 'Login berhasil!');
        }

        // If the login attempt was unsuccessful
        return redirect()->back()->with('error', 'Login gagal periksa kembali username dan password.')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('panel.login'))->with('success', 'anda berhasil logout.');
    }
}
