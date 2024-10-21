<?php

namespace App\Http\Controllers\Panel\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryoutMateri;


class BankSoalController extends Controller
{
    public function index(Request $request)
    {
        $tryout =  TryoutMateri::with('tryoutMaster', 'soal', 'refMateri')
            ->has('soal')
            ->when($request->keyword, function ($query) use ($request) {
                return $query->where('tryout_materi_deskripsi', 'like', "%{$request->keyword}%");
            })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->whereHas('refMateri',function($q)use($request){
                    return $q->where('ref_materi_jenjang', $request->jenjang);
                });
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->whereHas('refMateri',function($q)use($request){
                    return $q->where('ref_materi_kelas', $request->kelas);
                });
            })
            ->paginate(10);

        $load['keyword'] = $request->keyword;
        $load['filter_jenjang'] = $request->jenjang;
        $load['filter_kelas'] = $request->kelas;

        $load['bank_soal']  = $tryout;

        return view('pages.panel.ref_soal.index', ($load));
    }

    public function show($id)
    {

        $tryout =  TryoutMateri::where('tryout_materi_id',$id)
            ->with('tryoutMaster', 'soal', 'refMateri')
            ->has('soal')
            ->first();

        $load['bank_soal']  = $tryout;

        return view('pages.panel.ref_soal.show', ($load));
    }
}
