<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function cariSekolah(Request $request){
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
