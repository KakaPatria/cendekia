<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tryout;
use App\Models\TryoutPeserta;
use App\Models\Invoice;
use App\Models\PrefixNumber;
use Carbon\Carbon;

class TryoutPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'tryout_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $user = auth()->user();

        $tryout = Tryout::find($request->tryout_id);
        
        // Validasi tryout exists
        if (!$tryout) {
            return redirect()->route('siswa.tryout.library')
                ->with('error', 'Tryout tidak ditemukan.');
        }
        
        // Validasi akses berdasarkan tipe siswa
        if ($tryout->is_open === 'Cendekia' && $user->tipe_siswa !== 'Cendekia') {
            return redirect()->route('siswa.tryout.library')
                ->with('error', 'Anda tidak memiliki akses untuk mendaftar tryout ini.');
        }
        
        $peserta = new TryoutPeserta();
        $peserta->tryout_id = $request->tryout_id;
        $peserta->user_id = $user->id;
        $peserta->tryout_peserta_name = $request->name;
        $peserta->tryout_peserta_telpon = $request->telepon;
        $peserta->tryout_peserta_email = $request->email;
        $peserta->tryout_peserta_alamat = $request->alamat;
        $peserta->tryout_peserta_status = 0;
        $peserta->save();

        if ($tryout->tryout_jenis == 'Gratis') {
            //dd($tryout->getAverageNilai());
            $peserta->tryout_peserta_status = 1;
            $peserta->update();

            return redirect()->route('siswa.tryout.show', $request->tryout_id)
                ->withSuccess(('Tryout Berhasil terdaftar'));
        } else {
            $prefix = PrefixNumber::find('Invoice');
            $prefix->value = $prefix->value + 1;


            $nominal = $tryout->getRawOriginal('tryout_nominal') ?? 0;
            $diskon = $tryout->getRawOriginal('tryout_diskon') ?? 0;

            $harga_jual = $nominal - ($nominal * $diskon / 100);

            $invoice = new Invoice();
            $invoice->user_id = $user->id;
            $invoice->inv_id = 'IN-' . date('ym') . '-' . sprintf('%04d', ($prefix->value));
            $invoice->keterangan = 'Biaya ' . $tryout->tryout_judul;
            $invoice->tryout_id = $request->tryout_id;
            $invoice->tryout_peserta_id = $peserta->tryout_peserta_id;
            $invoice->amount = $tryout->getRawOriginal('tryout_nominal');
            $invoice->discount = $tryout->getRawOriginal('tryout_diskon');
            $invoice->total = $harga_jual;
            $invoice->status = 0;
            $invoice->due_date = Carbon::now()->addDays(7)->format('Y-m-d');
            $invoice->save();

            $prefix->update();

            //dd($invoice,$peserta,$prefix);
            return redirect()->route('siswa.invoice.show', $invoice->inv_id)
                ->withSuccess(('Tryout Berhasil terdaftar. silahkan melakukan pembayaran'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
