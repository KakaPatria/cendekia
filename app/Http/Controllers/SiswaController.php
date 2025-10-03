<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('roles_id', 1);
        $jenjang = $request->input('jenjang');
        if ($jenjang) {
            $query->whereRaw('LOWER(jenjang) = ?', [strtolower($jenjang)]);
        }
        $siswa = $query->paginate(10)->appends($request->except('page'));
        return view('pages.siswa.index', compact('siswa', 'jenjang'));
    }
}
