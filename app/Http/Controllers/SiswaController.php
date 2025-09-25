<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class SiswaController extends Controller
{
    public function index()
    {
        // ambil semua user (atau bisa ditambahkan filter kalau khusus siswa saja)
        $siswa = User::paginate(10); // tampilkan 10 per halaman
    return view('pages.siswa.index', compact('siswa'));

}
}