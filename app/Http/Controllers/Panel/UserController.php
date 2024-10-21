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

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->rule ?? 'Siswa';

        $load['users'] = User::when($request->keyword, function ($query) use ($request) {
            return $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('email', 'like', "%{$request->keyword}%")
                ->orWhere('telepon', 'like', "%{$request->keyword}%")
                ->orWhere('asal_sekolah', 'like', "%{$request->keyword}%");
        })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->where('jenjang', $request->jenjang);
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->where('kelas', $request->kelas);
            })
            ->when($role, function ($query) use ($role) {
                return $query->whereHas(
                    'roles',
                    function ($q) use ($role) {
                        if ($role == 'Siswa') {
                            $q->where('id', 1);
                        } else {
                            $q->where('id', '!=', 1);
                        }
                    }
                );
            })
            ->paginate(10);

        $load['roles'] = Role::get();
        $load['permissions'] = Permission::get();
        $load['keyword'] = $request->keyword;
        $load['filter_role'] = $request->role;
        $load['filter_jenjang'] = $request->jenjang;
        $load['filter_kelas'] = $request->kelas;
        $load['roleX'] = $role;

        return view('pages.panel.user.index', ($load));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $user->id,
            'telepon' => 'required|numeric',
            'asal_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|in:SD,SMP,SMA',
            'kelas' => 'required|integer|min:1|max:12',
            'nama_orang_tua' => 'required|string',
            'telp_orang_tua' => 'required|numeric',
            'alamat' => 'required|string|max:255',

        ]);

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

            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'uploaded/images/avatar';
            $upload = $file->move($tujuan_upload, $nama_file);
            //dd($upload);
            $user->update(['avatar' => $tujuan_upload . '/' . $nama_file]);
        }
        if ($user->hasRole(['Admin'])) {
            $user->syncRoles($request->get('role'));
            $user->syncPermissions($request->get('permissions'));
        }


        return redirect(route('panel.user.index'))
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


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telepon' => 'required|numeric',
            'asal_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|in:SD,SMP,SMA',
            'kelas' => 'required|integer|min:1|max:12',
            'nama_orang_tua' => 'required|string',
            'telp_orang_tua' => 'required|numeric',
            'alamat' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'asal_sekolah' => $request->asal_sekolah,
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'nama_orang_tua' => $request->nama_orang_tua,
            'telp_orang_tua' => $request->telp_orang_tua,
            'password' => Hash::make($request->password),

        ]);
        //dd($user->id);
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'uploaded/images/avatar';
            $upload = $file->move($tujuan_upload, $nama_file);
            //dd($upload);
            $user->update(['avatar' => $tujuan_upload . '/' . $nama_file]);
        }
        //die;

        $role = $request->get('role') ?? 'Siswa';
        $user->syncRoles($role);
        $user->syncPermissions($request->get('permissions'));

        return redirect()->route('panel.user.index')
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

        return redirect()->route('panel.user.index')
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
