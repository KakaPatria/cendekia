<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryoutPeserta;
use App\Models\Tryout;
use App\Models\Invoice;
use Carbon\Carbon;



class PendaftaranController extends Controller
{
    public function index(Request $request)
    {

        $load['peserta'] =  TryoutPeserta::with('siswa', 'masterTryout')
            ->when($request->keyword, function ($query) use ($request) {
                return $query->where('tryout_peserta_name', 'like', "%{$request->keyword}%")
                    ->orWhere('tryout_peserta_telpon', 'like', "%{$request->keyword}%");
            })
            ->when($request->tryout, function ($query) use ($request) {
                return $query->where('tryout_id',  "$request->tryout");
            })
            ->when($request->asal_sekolah, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('asal_sekolah', $request->asal_sekolah);
                });
            })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('jenjang', $request->jenjang);
                });
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('kelas', $request->kelas);
                });
            })
            ->orderBy('tryout_peserta_status')
            ->orderByDesc('created_at')
            ->paginate(10);

        $load['tryout'] = Tryout::select('tryout_judul', 'tryout_id')->get()->pluck('tryout_judul', 'tryout_id');

        $load['keyword'] = $request->keyword;

        return view('pages.panel.pendaftaran.index', ($load));
    }

    public function approve($id)
    {
        $peserta = TryoutPeserta::with('siswa', 'masterTryout')->find($id);
        $peserta->tryout_peserta_status = 1;
        $peserta->save();

        if ($peserta->masterTryout->tryout_jenis != 'Gratis') {
            $invoice =  Invoice::where('user_id', $peserta->user_id)
                ->where('tryout_id', $peserta->tryout_id)
                ->where('tryout_peserta_id', $id)
                ->first();
            $invoice->status = 1;
            $invoice->inv_paid = Carbon::now()->format('Y-m-d');
            $invoice->save();
        }

        return redirect()->route('panel.pendaftaran.index')
            ->withSuccess(('Siswa Berhasil ditambahkan.'));
    }

    public function show($id)
    {

        $peserta =  TryoutPeserta::with('siswa', 'masterTryout')->find($id);
        $load['peserta'] = $peserta;

        if ($peserta->tryout_peserta_status) {
            $telpon = $peserta->waNumber;

            $load['wa_link'] = "https://wa.me/" . $telpon . "?text=Halo " . $peserta->tryout_peserta_name . ". Pendaftaran Anda untuk tryout " . $peserta->masterTryout->tryout_judul . " telah dikonfirmasi. Silakan melakukan tryout.";
        }



        return view('pages.panel.pendaftaran.show', ($load));
    }
}
