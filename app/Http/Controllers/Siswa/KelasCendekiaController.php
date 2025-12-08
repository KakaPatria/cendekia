<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\KelasCendekia;
use App\Models\Tryout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasCendekiaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->tipe_siswa != 'Cendekia') {
            return redirect()->back();
        }

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
            })
            ->whereHas('siswaKelas', function ($q1) use ($user) {
                $q1->where('siswa_id', $user->id);
            });


        $kelasCendekia = $kelasCendekia->orderByDesc('created_at')
            ->paginate(10);

        $load['kelas_cendekia'] = $kelasCendekia;

        return view('pages.siswa.kelas_cendekia.index', $load);
    }


    public function Show($kelasCendekiaId)
    {
        $user = Auth::user();

        if ($user->tipe_siswa != 'Cendekia') {
            return redirect()->back();
        }

        $kelasCendekia = KelasCendekia::with('jadwal', 'siswaKelas', 'tryouts')
            ->find($kelasCendekiaId);


        // ambil tryout urut berdasar waktu
        $tryouts = Tryout::where('kelas_cendekia_id', $kelasCendekiaId)
            ->orderBy('created_at', 'asc')
            ->with([
                'materi.refMateri'
            ])
            ->get();

        $susunNilai = [];
        foreach ($tryouts as $kTreyout => $vTryout) {
            $nilai = $vTryout->nilai->where('user_id', $user->id);

            foreach ($vTryout->materi as $kMateri => $vMateri) {
                $susunNilai[$vMateri->materi_id]['materi'] = $vMateri->refMateri;
                $susunNilai[$vMateri->materi_id]['nilai'][$vTryout->tryout_id] = $vMateri->nilai->where('user_id', $user->id)->first();
            }
        } 
        $load['kelas_cendekia'] = $kelasCendekia;
        $load['susun_nilai'] = $susunNilai;

        return view('pages.siswa.kelas_cendekia.show', ($load));
    }
}
