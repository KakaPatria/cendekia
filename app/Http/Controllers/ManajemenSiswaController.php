<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManajemenSiswaController extends Controller
{
    public function index()
    {
        // nanti data jadwal bisa diambil dari database
        return view('pages.panel.manajemen_siswa.index');

    }
}
