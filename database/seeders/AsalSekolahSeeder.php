<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsalSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sekolahList = [
            ['nama_sekolah' => 'SD Indonesia Merdeka', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD KANISIUS GAYAM 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI JETIS 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI LEMPUYANGAN 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD MUHAMMADIYAH BAUSASRAN 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD MUHAMMADIYAH BAUSASRAN 2', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI DEMANGAN', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD TAMANSISWA JETIS', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI JETISHARJO', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD JOANNES BOSCO YOGYAKARTA', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI COKROKUSUMAN', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI BHAYANGKARA', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI WIDORO', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI SERAYU', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI UNGARAN 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD BOPKRI GONDOLAYU', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI KYAI MOJO', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI BUMIJO', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI GONDOLAYU', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI BACIRO', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD KANISIUS GOWONGAN', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI KLITREN', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD BHINNEKA TUNGGAL IKA', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD TARAKANITA 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI TERBANSARI 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD BUDYA WACANA 1', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI JETIS 2', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI VIDYA QASANA', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI BADRAN', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD NEGERI LEMPUYANGWANGI', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'SD BUASASRAN 3', 'jenjang' => 'SD'],
            ['nama_sekolah' => 'smk 2 depok', 'jenjang' => 'SMA'],
            ['nama_sekolah' => 'SMK Negeri 2 Yogyakarta', 'jenjang' => 'SMA'],
            ['nama_sekolah' => 'SMKN 1 KOTABUMI', 'jenjang' => 'SMA'],
            ['nama_sekolah' => 'SMP 9 Yogyakarta', 'jenjang' => 'SMP'],
            ['nama_sekolah' => 'smk', 'jenjang' => 'SMA'],
        ];

        foreach ($sekolahList as $sekolah) {
            DB::table('asal_sekolah')->insert($sekolah);
        }
    }
}
