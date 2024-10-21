<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $load['tryout'] = Tryout::where('tryout_kelas', $user->kelas)
        ->where('tryout_status','Aktif')
            ->paginate(10);

        //dd($load,$user->kelas);

        return view('pages.siswa.dashboard',$load);
    }
}
