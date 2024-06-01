<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\TryoutJawaban;
use App\Models\TryoutSoal;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getJawaban(Request $request)
    {

        $id = $request->input('id');

        $soal = TryoutSoal::where('tryout_soal_id', $id)->first();

        $element = '<h4 class="card-title mb-0 flex-grow-1">Edit Jawaban  No. ' . $soal->tryout_nomor . '</h4>';
        $element .= '<table class="table table-nowrap">';
        $element .=    '<th>';
        $element .=        '<tr>';
        $element .=            '<th class="col-1">Kunci Jawaban</th>';
        $element .=            '<th class="col-1">Abjad</th>';
        $element .=            '<th>Isi Jawaban</th>';
        $element .=        '</tr>';
        $element .=    '</th>';
        $element .=    '<tbody>';
        foreach ($soal->jawaban as $key => $value) {
            $element .=        '<tr>';
            $element .=            '<td><input class="form-check-input" type="radio" name="opsi_jawaban" value="' . $value->tryout_jawaban_prefix . '" id="" ' . ($soal->tryout_kunci_jawaban == $value->tryout_jawaban_prefix ? 'selected' : '') . '></td>';
            $element .=            '<td>' . $value->tryout_jawaban_prefix . '.</td>';
            $element .=            '<td><input type="text" class="form-control" name="jawaban[' . $value->tryout_jawaban_id . ']" value="' . $value->tryout_jawaban_isi . '"></td>';
            $element .=        '</tr>';
        }




        return response()->json($element);
    }

    public function cariSekolah(Request $request)
    {
        $search = $request->input('q');

        $users = User::where('asal_sekolah', 'LIKE', "%{$search}%")->get();

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                'id' => $user->asal_sekolah,
                'text' => $user->asal_sekolah,
            ];
        }

        return response()->json($response);
    }
    public function cariSiswa(Request $request)
    {
        $search = $request->input('q');

        $users = User::where('name', 'LIKE', "%{$search}%")
            ->whereHas(
                'roles',
                function ($q) {
                    $q->where('id', 1);
                }
            )->get();

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                'id' => $user->id,
                'text' => $user->name,
            ];
        }

        return response()->json($response);
    }
    public function materiTryout(Request $request)
    {

        $materi = Materi::when($request->kelas, function ($q, $kelas) {
            return $q->where('ref_materi_kelas', $kelas);
        })->get();

        $results = [];
        foreach ($materi as $item) {
            $results[] = [
                'id' => $item->ref_materi_id,
                'text' => $item->ref_materi_judul,
            ];
        }

        return response()->json(['results' => $results]);
    }
}
