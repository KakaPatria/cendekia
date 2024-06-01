<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Tryout;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = User::where('status', 'Aktif')->whereHas('roles', function ($q) {
            $q->where('id', 1);
        })->get();
        $jumlahSekolah = 0;

        $susunUrutanSekolah = [];
        foreach ($user->groupBy('asal_sekolah') as $key => $value) {
            $jumlahSekolah += 1;
            $susunUrutanSekolah[] = [
                'nama' => $key,
                'jumlah' => count($value)
            ];
        }
        usort($susunUrutanSekolah, function($a, $b) {
            return $b['jumlah'] - $a['jumlah'];
        });
        
        // Ambil lima elemen teratas
        $topFive = array_slice($susunUrutanSekolah, 0, 5);
        $load['top_sekolah'] = $topFive;
        //print_r($susunUrutanSekolah);die;


        $load['jumlah_siswa'] = $user->count();
        $load['jumlah_sekolah'] = $jumlahSekolah;

        $dataJenjang = [];
        $dataKelas = [];
        foreach ($user->groupBy('jenjang') as $key => $value) {
            $dataJenjang[] = [
                'name' => $key,
                'drilldown' => $key,
                'y' => count($value),
            ];

            $dataKelas[$key]['id'] = $key;
            $dataKelas[$key]['name'] = $key;
            foreach ($value->groupBy('kelas') as $kKelas => $vKelas) {
                $dataKelas[$key]['data'][] =  [
                    'name' => "Kelas ".$kKelas,
                    'y' => count($vKelas),
                ];
            }
            
        }  
       
        $load['data_jenjang'] = json_encode($dataJenjang);
        $load['data_kelas'] = json_encode(array_values($dataKelas)); 

        $load['jumlah_tryout'] = Tryout::where('tryout_status', 'Aktif')->count();
        $load['jumlah_materi'] = Materi::count();
        //dd($siswa,$tryout, $materi, $jumlahSekolah);
        return view('pages.panel.dashboard', $load);
    }
}
