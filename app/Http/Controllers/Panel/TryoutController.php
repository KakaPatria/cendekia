<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PrefixNumber;
use App\Models\Tryout;
use App\Models\TryoutMateri;
use App\Models\TryoutPeserta;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $load['tryout'] = Tryout::when($request->keyword, function ($query) use ($request) {
            return $query->where('tryout_judul', 'like', "%{$request->keyword}%")
                ->where('tryout_deskripsi', 'like', "%{$request->keyword}%");
        })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->where('tryout_jenjang', $request->jenjang);
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->where('tryout_kelas', $request->kelas);
            })->paginate(10);


        $load['keyword'] = $request->keyword;
        $load['filter_jenjang'] = $request->jenjang;
        $load['filter_kelas'] = $request->kelas;

        return view('pages.panel.tryout.index', ($load));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $load['pengajar'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 3);
            }
        )->get();

        return view('pages.panel.tryout.create', ($load));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'tryout_judul' => 'required|string|max:255',
            'tryout_jenjang' => 'required|string|in:SD,SMP,SMA',
            'tryout_kelas' => 'required|integer|min:1|max:12',
            'tryout_register_due' => 'required|date',
            'tryout_status' => 'required',
            'tryout_jenis' => 'required',
            'tryout_nominal' => 'required',
        ]);

        $tryout = new Tryout();
        $tryout->tryout_judul = $request->tryout_judul;
        $tryout->tryout_deskripsi = $request->tryout_deskripsi ?? '';
        $tryout->tryout_jenjang = $request->tryout_jenjang;
        $tryout->tryout_kelas = $request->tryout_kelas;
        $tryout->tryout_register_due = $request->tryout_register_due;
        $tryout->tryout_status = $request->tryout_status;
        $tryout->tryout_jenis = $request->tryout_jenis;
        $tryout->tryout_nominal = $request->tryout_nominal;
        $tryout->save();

        if ($request->file('tryout_banner')) {
            $file = $request->file('tryout_banner');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/banner_tryout';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->storeAs($directory, $fileName);

            $tryout->tryout_banner = $directory . '/' . $fileName;
            $tryout->update();
        }


        $postMateri = [];
        foreach ($request->materi_data['materi_data'] as $key => $value) {
            if ($value['materi_id']) {
                $postMateri[] = [
                    'tryout_materi_id' => Str::random(10),
                    'tryout_id' => $tryout->tryout_id,
                    'materi_id' => $value['materi_id'],
                    'pengajar_id' => $value['pengajar_id'],
                    'tryout_materi_deskripsi' => $value['tryout_materi_deskripsi']
                ];
            }
        }

        TryoutMateri::insert($postMateri);

        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Tryout Berhasil ditambahkan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $load['tryout'] = Tryout::where('tryout_id', $id)->first()->load('materi.refMateri');
        $load['pengajar'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 3);
            }
        )->get();

        return view('pages.panel.tryout.show', $load);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $load['pengajar'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 3);
            }
        )->get();

        $load['tryout'] = Tryout::where('tryout_id', $id)->first()->load('materi.refMateri');

        return view('pages.panel.tryout.edit', $load);
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
        $request->validate([
            'tryout_judul' => 'required|string|max:255',
            'tryout_jenjang' => 'required|string|in:SD,SMP,SMA',
            'tryout_kelas' => 'required|integer|min:1|max:12',
            'tryout_register_due' => 'required|date',
            'tryout_status' => 'required',
            'tryout_jenis' => 'required',
            'tryout_nominal' => 'required',
        ]);

        $tryout = Tryout::find($id);
        $tryout->tryout_judul = $request->tryout_judul;
        $tryout->tryout_deskripsi = $request->tryout_deskripsi ?? '';
        $tryout->tryout_jenjang = $request->tryout_jenjang;
        $tryout->tryout_kelas = $request->tryout_kelas;
        $tryout->tryout_register_due = $request->tryout_register_due;
        $tryout->tryout_status = $request->tryout_status;
        $tryout->tryout_jenis = $request->tryout_jenis;
        $tryout->tryout_nominal = $request->tryout_nominal;
        $tryout->update();

        if ($request->file('tryout_banner')) {
            $file = $request->file('tryout_banner');

            // Buat direktori jika belum ada
            $directory = 'public/uploads/banner_tryout';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }

            // Rename file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Simpan file
            $file->storeAs($directory, $fileName);

            $tryout->tryout_banner = $directory . '/' . $fileName;
            $tryout->update();
        }



        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Tryout Berhasil Diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tryout::where('tryout_id', $id)->delete();

        return redirect()->route('panel.tryout.index')
            ->withSuccess(('Tryout Berhasil dihapus.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addMateri(Request $request, $id)
    {
        $request->validate([
            'materi_id' => 'required',
            'pengajar_id' => 'required',
            'tryout_materi_deskripsi' => 'required',
        ]);
        $tryout = Tryout::find($id);

        TryoutMateri::insert([
            'tryout_materi_id' => Str::random(10),
            'tryout_id' => $tryout->tryout_id,
            'materi_id' => $request->materi_id,
            'pengajar_id' => $request->pengajar_id,
            'tryout_materi_deskripsi' => $request->tryout_materi_deskripsi
        ]);

        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Materi Tryout Berhasil ditambahkan.'));
    }

    public function editMateri(Request $request, $id)
    {
        $request->validate([
            'materi_id' => 'required',
            'pengajar_id' => 'required',
            'tryout_materi_deskripsi' => 'required',
            'periode_mulai' => 'required',
            'periode_selesai' => 'required',
            'safe_mode' => 'required|integer',
        ]);
        $tryoutMateri = TryoutMateri::find($id);
        $tryoutMateri->materi_id =  $request->materi_id;
        $tryoutMateri->pengajar_id =  $request->pengajar_id;
        $tryoutMateri->tryout_materi_deskripsi =  $request->tryout_materi_deskripsi;
        $tryoutMateri->periode_mulai = $request->periode_mulai;
        $tryoutMateri->periode_selesai = $request->periode_selesai;
        $tryoutMateri->safe_mode = $request->safe_mode;
        $tryoutMateri->update();
        

        return redirect()->route('panel.tryout_materi.show', $id)
            ->withSuccess(('Materi Tryout Berhasil diupdate.'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addPeserta(Request $request, $id)
    {
        $tryout = Tryout::find($id);

        foreach ($request->siswa as $key => $value) {

            $user = User::find($value);
            $peserta = new TryoutPeserta();

            $peserta->tryout_id = $id;
            $peserta->user_id = $user->id;
            $peserta->tryout_peserta_name = $user->name;
            $peserta->tryout_peserta_telpon = $user->telepon;
            $peserta->tryout_peserta_email = $user->email;
            $peserta->tryout_peserta_alamat = $user->alamat ?? '';
            $peserta->tryout_peserta_status = 1;
            $peserta->save();

            if ($tryout->tryout_jenis != 'Gratis') {
                $prefix = PrefixNumber::find('Invoice')->first();
                $prefix->value = $prefix->value + 1;
                $prefix->update();

                $invoice = new Invoice();
                $invoice->user_id = $user->id;
                $invoice->inv_id = 'IN-' . date('ym') . '-' . sprintf('%04d', ($prefix->value));
                $invoice->keterangan = 'Biaya ' . $tryout->tryout_judul;
                $invoice->tryout_id = $request->tryout_id;
                $invoice->tryout_peserta_id = $peserta->tryout_peserta_id;
                $invoice->amount = $tryout->getRawOriginal('tryout_nominal');
                $invoice->status = 1;
                $invoice->due_date = Carbon::now()->format('Y-m-d');
                $invoice->inv_paid = Carbon::now()->format('Y-m-d');
                $invoice->save();
            }
        }
        return redirect()->route('panel.tryout.show', $tryout->tryout_id)
            ->withSuccess(('Siswa Berhasil ditambahkan.'));
    }
}
