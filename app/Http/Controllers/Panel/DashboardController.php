<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Tryout;
use App\Models\User;
use App\Models\AsalSekolah;
use App\Models\TryoutMateri;
use App\Models\KelasCendekia;
use App\Models\JadwalCendekia; // Kita perlukan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Cek jika user adalah Pengajar (roles_id == 3)
        if ($user->roles_id == 3) {
            return $this->dashboardPengajar($user);
        }

        // 2. Cek jika user adalah Admin (roles_id == 2)
        if ($user->roles_id == 2) {
            return $this->dashboardAdmin();
        }

        // 3. Fallback
        return redirect('/')->with('error', 'Anda tidak memiliki akses.');
    }

    /**
     * Data untuk Dashboard Admin (Kode lama Anda)
     */
    private function dashboardAdmin()
    {
            // Ambil semua user dengan roles_id = 1 (Siswa) dan status Aktif
            $user = User::where('roles_id', 1)->where('status', 'Aktif')->get();

            // Hitung jumlah sekolah dari tabel master `asal_sekolah`
            $jumlahSekolah = AsalSekolah::count();

            // Susun urutan sekolah berdasarkan jumlah siswa (berdasarkan users.asal_sekolah)
            $susunUrutanSekolah = [];
            foreach ($user->groupBy('asal_sekolah') as $key => $value) {
                if (!$key) continue; // lewati entry kosong
                $susunUrutanSekolah[] = [
                    'nama' => $key,
                    'jumlah' => count($value)
                ];
            }
            usort($susunUrutanSekolah, function ($a, $b) {
                return $b['jumlah'] - $a['jumlah'];
            });
            
            $topFive = array_slice($susunUrutanSekolah, 0, 5);
            $load['top_sekolah'] = $topFive;
            $load['jumlah_siswa'] = $user->count();
            $load['jumlah_sekolah'] = $jumlahSekolah;
    
            $dataJenjang = [];
            $dataKelas = [];
            foreach ($user->groupBy('jenjang') as $key => $value) {
                $dataJenjang[] = [
                    'name' => $key, 'drilldown' => $key, 'y' => count($value),
                ];
                $dataKelas[$key]['id'] = $key;
                $dataKelas[$key]['name'] = $key;
                foreach ($value->groupBy('kelas') as $kKelas => $vKelas) {
                    $dataKelas[$key]['data'][] =  [
                        'name' => "Kelas " . $kKelas, 'y' => count($vKelas),
                    ];
                }
            }
    
            $load['data_jenjang'] = json_encode($dataJenjang);
            $load['data_kelas'] = json_encode(array_values($dataKelas));
            $load['jumlah_tryout'] = Tryout::where('tryout_status', 'Aktif')->count();
            $load['jumlah_materi'] = Materi::count();
            $load['is_admin'] = true; // Penanda untuk view
    
            return view('pages.panel.dashboard', $load);
        }
    
    private function dashboardPengajar($pengajar)
    {
        // 1. Ambil ID kelas yang diampu pengajar
            $kelasIds = JadwalCendekia::where('guru_id', $pengajar->id)
                            ->distinct()
                            ->pluck('kelas_cendekia_id');
    
            // 2. Jumlah Siswa (dari kelas yang diampu)
            $jumlah_siswa = DB::table('kelas_siswa_cendekia')
                ->whereIn('kelas_cendekia_id', $kelasIds)
                ->distinct('siswa_id')
                ->count();
    
            // 3. Tryout Aktif (yang melibatkan materi dari pengajar ini)
            $jumlah_tryout = TryoutMateri::where('pengajar_id', $pengajar->id)
                ->join('tryout', 'tryout_materi.tryout_id', '=', 'tryout.tryout_id')
                ->where('tryout.tryout_status', 'Aktif')
                ->distinct('tryout.tryout_id')
                ->count();
    
            // 4. (BARU) Mata Pelajaran yang Diampu (Poin 3)
            $jumlah_mapel_diampu = JadwalCendekia::where('guru_id', $pengajar->id)
                                    ->distinct('ref_materi_id')
                                    ->count();
            
            // 5. (BARU) Daftar Jadwal yang Diampu (Poin 4)
            $jadwal_diampu = JadwalCendekia::with(['kelas', 'mataPelajaran'])
                                ->where('guru_id', $pengajar->id)
                                ->orderBy('jadwal_cendekia_hari') // Anda bisa urutkan
                                ->get();
    
            // 6. Grafik Jenjang (dari siswa yang diampu)
            $grafikJenjang = DB::table('kelas_siswa_cendekia')
                ->join('kelas_cendekia', 'kelas_siswa_cendekia.kelas_cendekia_id', '=', 'kelas_cendekia.kelas_cendekia_id')
                ->whereIn('kelas_siswa_cendekia.kelas_cendekia_id', $kelasIds)
                ->whereNotNull('kelas_cendekia.jenjang')
                ->groupBy('kelas_cendekia.jenjang')
                ->select('kelas_cendekia.jenjang', DB::raw('count(distinct kelas_siswa_cendekia.siswa_id) as total'))
                ->get();
    
            $data_jenjang = $grafikJenjang->map(function ($item) {
                return ['name' => $item->jenjang, 'y' => $item->total, 'drilldown' => $item->jenjang];
            })->toJson();
            $data_kelas = "[]";
    
            // Kirim data baru ke view
            $load['jumlah_siswa'] = $jumlah_siswa;
            $load['jumlah_sekolah'] = 0; // Sesuai permintaan (dihilangkan)
            $load['jumlah_tryout'] = $jumlah_tryout;
            $load['jumlah_materi'] = $jumlah_mapel_diampu; // Diganti
            $load['top_sekolah'] = []; // Sesuai permintaan (dihilangkan)
            $load['data_jenjang'] = $data_jenjang;
            $load['data_kelas'] = $data_kelas;
            $load['jadwal_diampu'] = $jadwal_diampu; // Data baru untuk tabel
            $load['is_admin'] = false; 
    
            return view('pages.panel.dashboard', $load);
        }
    }
