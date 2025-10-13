<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\TryoutNilai; // [PERBAIKAN] Menggunakan model TryoutNilai yang benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $load['tryout'] = Tryout::where('tryout_kelas', $user->kelas)
            ->where('tryout_status', 'Aktif')
            ->paginate(10);

        // [PERBAIKAN] Mengambil data dari TryoutNilai, bukan Pengerjaan
        $load['riwayat_pengerjaan'] = TryoutNilai::where('user_id', $user->id)
                                    ->where('status', 'Selesai') // Filter hanya yang sudah selesai
                                    ->with('masterTryout')
                                    ->orderBy('created_at', 'asc')
                                    ->get();
        
        return view('pages.siswa.dashboard', $load);
    }
}

