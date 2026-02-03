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

        // Tampilkan tryout aktif untuk kelas siswa.
        // Jangan difilter oleh batas pendaftaran supaya siswa tetap bisa melihat daftar tryout dan bannernya
        // (tryout yang sudah lewat deadline bisa ditandai/disable di UI).
        $load['tryout'] = Tryout::query()
            ->when($user->kelas, function ($query) use ($user) {
                return $query->where('tryout_kelas', $user->kelas);
            })
            ->where('tryout_status', 'Aktif')
            ->withCount('peserta') // Hitung jumlah peserta yang mendaftar
            ->orderByDesc('tryout_register_due')
            ->get();
             

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
                ->keyBy('tryout_id');

            // Bersihkan session dari tryout yang sudah tidak ada / tidak aktif
            $cleanRecent = [];
            foreach ($sessionRecent as $tid) {
                if (isset($tryouts[$tid])) {
                    $cleanRecent[] = $tid;
                }
            }
            session()->put('recent_tryouts', array_slice($cleanRecent, 0, 5));

            // Kembalikan urutan sesuai session (most recent first)
            $recentOrdered = collect();
            foreach ($sessionRecent as $tid) {
                if (isset($tryouts[$tid])) {
                    $recentOrdered->push($tryouts[$tid]);
                }
            }
            $load['recent_tryouts'] = $recentOrdered;
        } else {
            // Recent accesses fallback: ambil dari TryoutNilai lalu resolve ke Tryout yang masih ada.
            $recentTryoutIds = TryoutNilai::where('user_id', $user->id)
                ->orderBy('updated_at', 'desc')
                ->pluck('tryout_id')
                ->unique()
                ->take(5)
                ->values()
                ->all();

            $tryouts = Tryout::whereIn('tryout_id', $recentTryoutIds)
                ->where('tryout_status', 'Aktif')
                ->get()
                ->keyBy('tryout_id');

            $recentOrdered = collect();
            foreach ($recentTryoutIds as $tid) {
                if (isset($tryouts[$tid])) {
                    $recentOrdered->push($tryouts[$tid]);
                }
            }
            $load['recent_tryouts'] = $recentOrdered;
        }

        return view('pages.siswa.dashboard', $load);
    }
}
