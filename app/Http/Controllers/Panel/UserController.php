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
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
                if ($role === 'Siswa') {
                    // Only include users that are explicitly Siswa
                    return $query->where(function ($q) {
                        // Check Spatie roles first
                        $q->whereHas('roles', function ($r) {
                            $r->where('name', 'Siswa');
                        })
                        // Fallback to legacy roles_id if no Spatie roles
                        ->orWhere(function ($qq) {
                            $qq->whereDoesntHave('roles')
                               ->where('roles_id', 1);
                        });
                    });
                } else {
                    // Admin & Pengajar tab: only include Admin OR Pengajar
                    return $query->where(function ($q) {
                        // Check Spatie roles first
                        $q->whereHas('roles', function ($r) {
                            $r->whereIn('name', ['Admin', 'Pengajar']);
                        })
                        // Fallback to legacy roles_id if no Spatie roles
                        ->orWhere(function ($qq) {
                            $qq->whereDoesntHave('roles')
                               ->whereIn('roles_id', [2, 3]);
                        });
                    });
                }
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        $load['roles'] = Schema::hasTable('roles') ? Role::get() : collect();
        $load['permissions'] = Schema::hasTable('permissions') ? Permission::get() : collect();
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
        $load['roles'] = Schema::hasTable('roles') ? Role::latest()->get() : collect();
        $load['permissions'] = Schema::hasTable('permissions') ? Permission::latest()->get() : collect();
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
        $load['roles'] = Schema::hasTable('roles') ? Role::latest()->get() : collect();
        $load['permissions'] = Schema::hasTable('permissions') ? Permission::latest()->get() : collect();
        $load['userPermission'] = Schema::hasTable('permissions') ? $user->permissions->pluck('name')->toArray() : [];
        //dd($load);
        return view('pages.panel.user.edit', ($load));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $roleX = Schema::hasTable('roles') ? ($user->roles->pluck('name')->first() ?? '-') : '-';

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
                'telepon' => 'required',
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
                'telepon' => 'required',
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

            $file = 'uploads/avatar/' . $fileName;

            //dd($upload);
            $user->update(['avatar' => $file]);
        }
        // Only allow the currently authenticated admin to change roles/permissions
        if (Auth::user() && Auth::user()->hasRole('Admin')) {
            try {
                // Roles
                $rolesInput = $request->get('role') ?? [];
                $rolesToSync = is_array($rolesInput) ? $rolesInput : [$rolesInput];
                foreach ($rolesToSync as $rName) {
                    if (! empty($rName) && Schema::hasTable('roles') && ! Role::where('name', $rName)->exists()) {
                        try {
                            Role::create(['name' => $rName]);
                            logger()->info('Created missing role: '.$rName);
                        } catch (\Throwable $e) {
                            logger()->warning('Failed to create missing role '.$rName.': '.$e->getMessage());
                        }
                    }
                }
                $user->syncRoles($rolesToSync);

                // Permissions: accept ids or names
                $permsInput = $request->get('permissions') ?? [];
                $perms = is_array($permsInput) ? $permsInput : [$permsInput];
                $permNames = [];
                if (! empty($perms) && Schema::hasTable('permissions')) {
                    if (collect($perms)->every(fn($v) => is_numeric($v))) {
                        $permNames = Permission::whereIn('id', $perms)->pluck('name')->toArray();
                    } else {
                        $permNames = $perms;
                    }
                    $user->syncPermissions($permNames);
                }
            } catch (\Throwable $e) {
                // Fail gracefully if roles/permissions can't be synced (missing roles table/data)
                logger()->error('Failed to sync roles/permissions for user '.$user->id.': '.$e->getMessage());
                return redirect()->back()->with('error', 'Gagal mengatur peran/izin. Periksa konfigurasi role/permission.');
            }
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
                'telepon' => 'required',
                'asal_sekolah' => 'required|string|max:255',
                'jenjang' => 'required|string|in:SD,SMP,SMA',
                'kelas' => 'required|integer|min:1|max:12',
                //'golongan' => 'nullable|string|max:50',
                'tipe_siswa' => 'required|string|in:Cendekia,Umum',
                'nama_orang_tua' => 'required|string',
                'telp_orang_tua' => 'required|numeric',
                'alamat' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'telepon' => 'required',
                'password' => 'required|string|min:8',
            ]);
        }

        try {
            $payload = [
                'name' => $request->name,
                'email' => $request->email,
                'telepon' => $request->telepon,
                // Siswa-specific fields may be absent for Admin/Pengajar; set to null when missing
                'asal_sekolah' => $request->asal_sekolah ?? null,
                'jenjang' => $request->jenjang ?? null,
                //'golongan' => $request->golongan ?? null,
                'kelas' => $request->kelas ?? null,
                'alamat' => $request->alamat ?? null,
                'nama_orang_tua' => $request->nama_orang_tua ?? null,
                'telp_orang_tua' => $request->telp_orang_tua ?? null,
                // Ensure we always set a tipe_siswa so insert doesn't fail on DBs without a default
                'tipe_siswa' => $request->tipe_siswa ?? 'Umum',
                'password' => Hash::make($request->password),
            ];

            $user = User::create($payload);
        } catch (\Throwable $e) {
            logger()->error('Failed to create user: '.$e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan user. Periksa konfigurasi database atau log.');
        }
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

        // Only attempt sync if roles/permissions tables exist
        if (Schema::hasTable('roles')) {
            // Normalize to array
            $rolesToSync = is_array($role) ? $role : [$role];

            try {
                // Ensure roles exist (create missing roles)
                foreach ($rolesToSync as $rName) {
                    if (! Role::where('name', $rName)->exists()) {
                        try {
                            Role::create(['name' => $rName]);
                            logger()->info('Created missing role: '.$rName);
                        } catch (\Throwable $e) {
                            logger()->warning('Failed to create missing role '.$rName.': '.$e->getMessage());
                        }
                    }
                }

                $user->syncRoles($rolesToSync);
            } catch (\Throwable $e) {
                logger()->error('Failed to sync roles for new user '.$user->id.': '.$e->getMessage(), ['roles' => $rolesToSync]);
                return redirect()->route('panel.user.index', 'role=' . $request->rolex)
                    ->with('error', 'User ditambahkan tetapi gagal mengatur role/permission.');
            }
        } else {
            logger()->warning('Roles table missing, skipped sync for user '.$user->id);
        }

        if (Schema::hasTable('permissions')) {
            try {
                $permsInput = $request->get('permissions') ?? [];
                $perms = is_array($permsInput) ? $permsInput : [$permsInput];
                $permNames = [];
                if (! empty($perms)) {
                    if (collect($perms)->every(fn($v) => is_numeric($v))) {
                        $permNames = Permission::whereIn('id', $perms)->pluck('name')->toArray();
                    } else {
                        $permNames = $perms;
                    }
                }
                $user->syncPermissions($permNames);
            } catch (\Throwable $e) {
                logger()->error('Failed to sync permissions for new user '.$user->id.': '.$e->getMessage());
                return redirect()->route('panel.user.index', 'role=' . $request->rolex)
                    ->with('error', 'User ditambahkan tetapi gagal mengatur role/permission.');
            }
        } else {
            logger()->warning('Permissions table missing, skipped permission sync for user '.$user->id);
        }

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

    /**
     * Download template Excel untuk import siswa
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Header kolom
        $headers = [
            'A1' => 'Email',
            'B1' => 'Nama Lengkap',
            'C1' => 'Telepon',
            'D1' => 'Asal Sekolah',
            'E1' => 'Jenjang',
            'F1' => 'Kelas',
            'G1' => 'Alamat',
            'H1' => 'Nama Orangtua',
            'I1' => 'Telepon Orangtua',
            'J1' => 'Tipe Siswa',
            'K1' => 'Password'
        ];
        
        // Set headers
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFE0E0E0');
        }
        
        // Contoh data
        $sheet->setCellValue('A2', 'siswa1@example.com');
        $sheet->setCellValue('B2', 'Nama Siswa 1');
        $sheet->setCellValue('C2', '081234567890');
        $sheet->setCellValue('D2', 'SMA Negeri 1 Jakarta');
        $sheet->setCellValue('E2', 'SMA');
        $sheet->setCellValue('F2', '10');
        $sheet->setCellValue('G2', 'Jl. Contoh No. 123');
        $sheet->setCellValue('H2', 'Nama Orangtua 1');
        $sheet->setCellValue('I2', '081234567891');
        $sheet->setCellValue('J2', 'Cendekia');
        $sheet->setCellValue('K2', 'password123');
        
        // Auto-size kolom
        foreach (range('A', 'K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Buat writer
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        
        // Set nama file
        $fileName = 'template_import_siswa_' . date('Y-m-d_His') . '.xlsx';
        
        // Clear output buffer
        if (ob_get_contents()) {
            ob_end_clean();
        }
        
        // Set headers untuk download
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Import siswa dari file Excel
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240' // max 10MB
        ]);
        
        try {
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();
            
            // Skip header row
            $header = array_shift($rows);
            
            $imported = 0;
            $failed = 0;
            $errors = [];
            
            foreach ($rows as $index => $row) {
                $rowNumber = $index + 2; // +2 karena array dimulai dari 0 dan ada header
                
                // Skip baris kosong
                if (empty(array_filter($row))) {
                    continue;
                }
                
                try {
                    // Validasi data
                    $email = trim($row[0] ?? '');
                    $name = trim($row[1] ?? '');
                    $telepon = trim($row[2] ?? '');
                    $asal_sekolah = trim($row[3] ?? '');
                    $jenjang = trim($row[4] ?? '');
                    $kelas = trim($row[5] ?? '');
                    $alamat = trim($row[6] ?? '');
                    $nama_orang_tua = trim($row[7] ?? '');
                    $telp_orang_tua = trim($row[8] ?? '');
                    $tipe_siswa = trim($row[9] ?? 'Umum');
                    $password = trim($row[10] ?? 'password123');
                    
                    // Validasi required fields
                    if (empty($email) || empty($name) || empty($telepon)) {
                        $errors[] = "Baris {$rowNumber}: Email, Nama, dan Telepon harus diisi";
                        $failed++;
                        continue;
                    }
                    
                    // Validasi email format
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Baris {$rowNumber}: Format email tidak valid ({$email})";
                        $failed++;
                        continue;
                    }
                    
                    // Cek email sudah ada
                    if (User::where('email', $email)->exists()) {
                        $errors[] = "Baris {$rowNumber}: Email sudah terdaftar ({$email})";
                        $failed++;
                        continue;
                    }
                    
                    // Validasi jenjang
                    if (!empty($jenjang) && !in_array($jenjang, ['SD', 'SMP', 'SMA'])) {
                        $errors[] = "Baris {$rowNumber}: Jenjang harus SD, SMP, atau SMA ({$jenjang})";
                        $failed++;
                        continue;
                    }
                    
                    // Validasi tipe siswa
                    if (!in_array($tipe_siswa, ['Cendekia', 'Umum'])) {
                        $tipe_siswa = 'Umum';
                    }
                    
                    // Buat user
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'telepon' => $telepon,
                        'asal_sekolah' => $asal_sekolah,
                        'jenjang' => $jenjang,
                        'kelas' => $kelas,
                        'alamat' => $alamat,
                        'nama_orang_tua' => $nama_orang_tua,
                        'telp_orang_tua' => $telp_orang_tua,
                        'tipe_siswa' => $tipe_siswa,
                        'password' => Hash::make($password),
                    ]);
                    
                    // Assign role Siswa
                    if (Schema::hasTable('roles')) {
                        $siswaRole = Role::firstOrCreate(['name' => 'Siswa']);
                        $user->syncRoles([$siswaRole->name]);
                    }
                    
                    $imported++;
                    
                } catch (\Exception $e) {
                    $errors[] = "Baris {$rowNumber}: " . $e->getMessage();
                    $failed++;
                }
            }
            
            // Buat pesan hasil import
            $message = "Berhasil import {$imported} siswa.";
            if ($failed > 0) {
                $message .= " {$failed} data gagal diimport.";
            }
            
            if (!empty($errors)) {
                $errorMessage = implode('<br>', array_slice($errors, 0, 10)); // Tampilkan max 10 error
                if (count($errors) > 10) {
                    $errorMessage .= '<br>... dan ' . (count($errors) - 10) . ' error lainnya';
                }
                return redirect()->route('panel.user.index', ['role' => 'Siswa'])
                    ->with('warning', $message . '<br><br><strong>Detail Error:</strong><br>' . $errorMessage);
            }
            
            return redirect()->route('panel.user.index', ['role' => 'Siswa'])
                ->with('success', $message);
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengimport file: ' . $e->getMessage());
        }
    }
}
