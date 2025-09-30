<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class SiswaController extends Controller
{
    public function index()
    {
        // ambil hanya user dengan roles_id = 1
        $siswa = User::where('roles_id', 1)->paginate(10);
        
        return view('pages.siswa.index', compact('siswa'));
    }
}
