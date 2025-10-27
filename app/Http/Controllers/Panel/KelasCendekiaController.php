<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\JadwalCendekia;
use App\Models\KelasCendekia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasCendekiaController extends Controller
{
    public function index(Request $request)
    {

        $kelasCendekia = KelasCendekia::with('jadwal')
            ->withCount('siswaKelas')
            ->orderByDesc('created_at')
            ->paginate(10);

        $load['kelas_cendekia'] = $kelasCendekia;
        $load['keyword'] = $request->keyword;

        return view('pages.panel.kleas_cendekia.index', ($load));
    }

    public function Show($kelasCendekiaId)
    {

        $kelasCendekia = KelasCendekia::with('jadwal', 'siswaKelas')
            ->find($kelasCendekiaId);

        $load['kelas_cendekia'] = $kelasCendekia;

        return view('pages.panel.kleas_cendekia.show', ($load));
    }

    public function store(Request $request)
    {

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
            'kelas' => 'required|in:1,2,3,4,5,6,7,8,9',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $validated = $validator->validated();
        KelasCendekia::find($id)->update($validated);


        return redirect()->route('panel.kelas_cendekia.show', $id)
            ->withSuccess(('Kelas berhasil diupdate.'));
    }

    public function destroy($id)
    {

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
}
