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
            ->get()
             ->filter(function ($tryout) {
                return $tryout->is_can_register;
            });
             

        // [PERBAIKAN] Mengambil data dari TryoutNilai, bukan Pengerjaan
        $load['riwayat_pengerjaan'] = TryoutNilai::where('user_id', $user->id)
            ->where('status', 'Selesai') // Filter hanya yang sudah selesai
            ->with('masterTryout')
            ->orderBy('created_at', 'asc')
            ->get();

        // Prioritaskan session-based recent accesses jika ada (siswa membuka halaman detail)
        $sessionRecent = session()->get('recent_tryouts', []);
        if (is_array($sessionRecent) && count($sessionRecent) > 0) {
            $tryouts = Tryout::whereIn('tryout_id', $sessionRecent)
                ->where('tryout_status', 'Aktif')
                ->get()
                ->keyBy('tryout_id')
                ->filter(function ($tryout) {
                    return $tryout->is_can_register;
                });;

            // Kembalikan urutan sesuai session (most recent first)
            $recentOrdered = collect();
            foreach ($sessionRecent as $tid) {
                if (isset($tryouts[$tid])) {
                    $recentOrdered->push($tryouts[$tid]);
                }
            }
            $load['recent_tryouts'] = $recentOrdered;
        } else {
            // Recent accesses: gunakan TryoutNilai sebagai proxy untuk tryout yang baru diakses
            // Ambil entri terbaru per tryout (unique by tryout_id), batasi ke 5
            $load['recent_tryouts'] = TryoutNilai::where('user_id', $user->id)
                ->with('masterTryout')
                ->orderBy('updated_at', 'desc')
                ->get()
                ->unique('tryout_id')
                ->take(5)
                ->values();
        }

        return view('pages.siswa.dashboard', $load);
    }
}
