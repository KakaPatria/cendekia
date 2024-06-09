<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryoutPeserta;
use App\Models\Invoice;
use Carbon\Carbon;



class PendaftaranController extends Controller
{
    public function index(Request $request)
    {

        $load['peserta'] =  TryoutPeserta::with('siswa', 'masterTryout')->when($request->keyword, function ($query) use ($request) {
            return $query->where('tryout_peserta_name', 'like', "%{$request->keyword}%")
                ->where('tryout_peserta_telpon', 'like', "%{$request->keyword}%");
        })->orderBy('created_at')
            ->paginate(10);

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

        $load['peserta'] = TryoutPeserta::with('siswa', 'masterTryout')->find($id);

        return view('pages.panel.pendaftaran.show', ($load));
    }
}
