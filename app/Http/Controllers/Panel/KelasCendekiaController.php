<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\JadwalCendekia;
use App\Models\KelasCendekia;
use App\Models\KelasSiswaCendekia;
use App\Models\Tryout;
use App\Models\TryoutNilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasCendekiaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $kelasCendekia = KelasCendekia::with('jadwal')
            ->withCount('siswaKelas')
            ->when($request->keyword, function ($q, $keyword) {
                // Sekarang mencari di Nama Kelas, Jenjang, dan Kelas
                $q->where('kelas_cendekia_nama', 'like', "%$keyword%")
                    ->orWhere('jenjang', 'like', "%$keyword%")
                    ->orWhere('kelas', 'like', "%$keyword%");
            })
            ->when($request->kelas, function ($q, $kelas) {
                $q->where('kelas', $kelas);
            })

            ->when($request->jenjang, function ($q, $jenjang) {
                $q->where('jenjang', $jenjang);
            })

            ->when($request->guru, function ($q, $guru) {
                $q->whereHas('jadwal', function ($q2) use ($guru) {
                    $q2->where('guru_id', $guru);
                });
            });

        if (!$user->hasRole(['Admin'])) {
            $kelasCendekia->whereHas('jadwal', function ($q1) use ($user) {
                $q1->where('guru_id', $user->id);
            });
        }

        $kelasCendekia = $kelasCendekia->orderByDesc('created_at')
            ->paginate(10);

        $load['kelas_cendekia'] = $kelasCendekia;
        $load['keyword'] = $request->keyword;

        $load['filter_jenjang_dipilih'] = $request->jenjang;
        $load['filter_kelas_dipilih'] = $request->kelas;
        $load['filter_guru_dipilih'] = $request->guru;


        return view('pages.panel.kleas_cendekia.index', ($load));
    }

    public function Show($kelasCendekiaId)
    {

        $kelasCendekia = KelasCendekia::with('jadwal', 'siswaKelas', 'tryouts')
            ->find($kelasCendekiaId);

        // ambil tryout urut berdasar waktu
        $tryouts = Tryout::where('kelas_cendekia_id', $kelasCendekiaId)
            ->orderBy('created_at', 'asc')
            ->with(['materi.refMateri'])
            ->get();

        // ambil peserta
        $peserta = KelasSiswaCendekia::where('kelas_cendekia_id', $kelasCendekiaId)
            ->with('siswa')
            ->get();

        $nilaiList = TryoutNilai::whereIn('tryout_id', $tryouts->pluck('tryout_id'))
            ->whereIn('user_id', $peserta->pluck('siswa_id'))
            ->get()
            ->groupBy(['user_id', 'tryout_id', 'tryout_materi_id']);


        $detailData = [];
        $rataRataData = [];
        $mapelData = [];

        // Ambil semua mapel unik dari semua tryout
        $allMapel = collect($tryouts)
            ->flatMap(fn($t) => $t->materi->map(fn($m) => $m->refMateri->ref_materi_judul))
            ->unique()
            ->values();

        foreach ($peserta as $p) {
            $row = [
                'nama' => $p->siswa->name,
                'tryouts' => [],
            ];

            foreach ($tryouts as $t) {
                 $totalNilai = 0;
                $totalPoint = 0;
                $count = 0;

                foreach ($t->materi as $m) {
                    $item = $nilaiList[$p->siswa_id][$t->tryout_id][$m->tryout_materi_id][0] ?? null;
                    if ($item) {
                        $totalNilai += $item->nilai;
                        $totalPoint += $item->total_point;
                        $count++;
                    }
                }

                 $rataNilai = $count > 0 ? round($totalNilai / $count, 2) : '-';
                $totalPoint = $count > 0 ? round($totalPoint, 2) : '-';

                $row['tryouts'][$t->tryout_id] = [
                    'judul' => $t->tryout_judul,
                    'rata_rata' => $rataNilai,
                    'total_point' => $totalPoint,
                ];
            }

            $rataRataData[] = $row;
        }

        foreach ($allMapel as $mapel) {
            $mapelData[$mapel] = [];

            foreach ($peserta as $p) {
                $row = [
                    'nama' => $p->siswa->name,
                    'tryouts' => [],
                ];

                foreach ($tryouts as $t) {
                    $nilaiItem = null;

                    // cari materi tryout yang sesuai mapel
                    foreach ($t->materi as $m) {
                        if ($m->refMateri->ref_materi_judul === $mapel) {
                            $item = $nilaiList[$p->siswa_id][$t->tryout_id][$m->tryout_materi_id][0] ?? null;
                            $nilaiItem = $item ? [
                                'nilai' => $item->nilai,
                                'point' => $item->total_point,
                            ] : null;
                            break;
                        }
                    }

                    $row['tryouts'][$t->tryout_id] = [
                        'judul' => $t->tryout_judul,
                        'nilai' => $nilaiItem['nilai'] ?? '-',
                        'point' => $nilaiItem['point'] ?? '-',
                    ];
                }

                $mapelData[$mapel][] = $row;
            }
        }
 

        $load['kelas_cendekia'] = $kelasCendekia;
        $load['data_summary'] = $rataRataData;
        $load['data_detail'] = $mapelData;

        return view('pages.panel.kleas_cendekia.show', ($load));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Admin')) {
            return redirect()->route('panel.kelas_cendekia.index')
                ->with('error', 'Anda tidak memiliki izin untuk menambah kelas.');
        }
        $validator = Validator::make($request->all(), [
            'kelas_cendekia_nama' => 'required|string',
            'kelas_cendekia_keterangan' => 'nullable|',
            'jenjang' => 'required|in:SD,SMP,SMA',
            'kelas' => 'required|in:1,2,3,4,5,6,7,8,9',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $validated = $validator->validated();
        KelasCendekia::create($validated);


        return redirect()->route('panel.kelas_cendekia.index')
            ->withSuccess(('Kelas Baru berhasil ditambahkan.'));
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kelas_cendekia_nama' => 'required|string',
            'kelas_cendekia_keterangan' => 'nullable|',
            'jenjang' => 'required|in:SD,SMP,SMA',
            'kelas' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $validated = $validator->validated();
        $kelas = KelasCendekia::findOrFail($id);

        // Cek Keamanan: Jika bukan Admin, pastikan dia pemilik jadwal
        if (!Auth::user()->hasRole('Admin')) {
            $isOwner = $kelas->jadwal()->where('guru_id', Auth::id())->exists();
            if (!$isOwner) {
                return redirect()->route('panel.kelas_cendekia.index')
                    ->with('error', 'Anda tidak memiliki izin untuk mengedit kelas ini.');
            }
        }

        $kelas->update($validated);;


        return redirect()->route('panel.kelas_cendekia.show', $id)
            ->withSuccess(('Kelas berhasil diupdate.'));
    }

    public function destroy($id)
    {
        // --- TAMBAHKAN BLOK INI ---
        if (!Auth::user()->hasRole('Admin')) {
            return redirect()->route('panel.kelas_cendekia.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus kelas.');
        }
        KelasCendekia::findOrFail($id)->delete();


        return redirect()->route('panel.kelas_cendekia.index')
            ->withSuccess(('Kelas berhasil dihapus.'));
    }



    public function addMateri(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kelas_cendekia_id' => 'required|',
            'ref_materi_id' => 'required|',
            'guru_id' => 'required|',
            'jadwal_cendekia_hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jadwal_mulai' => 'required|date_format:H:i',
            'jadwal_selesai' => 'required|date_format:H:i|after:jadwal_mulai',
        ]);

        $validated = $validator->validated();
        JadwalCendekia::create($validated);


        return redirect()->route('panel.kelas_cendekia.show', $request->kelas_cendekia_id)
            ->withSuccess(('Jadwal Baru berhasil ditambahkan.'));
    }

    public function updateMateri($jadwal_cendekia_id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kelas_cendekia_id' => 'required|',
            'ref_materi_id' => 'required|',
            'guru_id' => 'required|',
            'jadwal_cendekia_hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jadwal_mulai' => 'required|date_format:H:i',
            'jadwal_selesai' => 'required|date_format:H:i|after:jadwal_mulai',
        ]);

        $validated = $validator->validated();
        JadwalCendekia::find($jadwal_cendekia_id)
            ->update($validated);


        return redirect()->route('panel.kelas_cendekia.show', $request->kelas_cendekia_id)
            ->withSuccess(('Jadwal berhasil diUpdate.'));
    }


    public function destroyMateri($id)
    {
        JadwalCendekia::findOrFail($id)->delete();

        return redirect()->back()
            ->withSuccess(('Jadwal berhasil dihapus.'));
    }

    public function addSiswa($kelasCendekiaId)
    {
        $kelasCendekia = KelasCendekia::find($kelasCendekiaId);

        $existingSiswaIds = $kelasCendekia->siswaKelas()->pluck('siswa_id');

        $siswa = User::where('roles_id', 1)
            ->where('jenjang', $kelasCendekia->jenjang)
            ->where('kelas', $kelasCendekia->kelas)
            ->whereNotIn('id', $existingSiswaIds)
            ->get();

        $load['kelas_cendekia'] = $kelasCendekia;
        $load['siswa'] = $siswa;

        return view('pages.panel.kleas_cendekia.add_siswa', ($load));
    }

    public function storeSiswa($kelasCendekiaId, Request $request)
    {

        $request->validate([
            'siswa_ids' => 'required|array|min:1',
        ]);

        foreach ($request->siswa_ids as $key => $value) {
            KelasSiswaCendekia::create([
                'kelas_cendekia_id' => $kelasCendekiaId,
                'siswa_id' => $value
            ]);
        }

        return redirect()->route('panel.kelas_cendekia.show', $kelasCendekiaId)
            ->withSuccess(('Siswa berhasil ditambahkan ke kelas!'));
    }

    public function destroySiswa($kelasCendekiaId, $kelasSiswaCendekia)
    {
        KelasSiswaCendekia::findOrFail($kelasSiswaCendekia)
            ->delete();

        return redirect()->route('panel.kelas_cendekia.show', $kelasCendekiaId)
            ->withSuccess(('Siswa berhasil dihapus dari kelas!'));
    }
    public function edit($id)
    {
        $kelas = \App\Models\KelasCendekia::findOrFail($id);

        // Keamanan: Cek apakah pengajar ini mengajar di kelas ini
        if (!Auth::user()->hasRole('Admin')) {
            $isOwner = $kelas->jadwal()->where('guru_id', Auth::id())->exists();
            if (!$isOwner) {
                return redirect()->route('panel.kelas_cendekia.index')
                    ->with('error', 'Anda tidak memiliki izin untuk mengedit kelas ini.');
            }
        }

        // Arahkan ke folder 'kleas_cendekia' Anda
        return view('pages.panel.kleas_cendekia.edit', compact('kelas'));
    }
}
