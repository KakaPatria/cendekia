<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;


class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('app/public/uploads/DATA SISWA LMS.xlsx');

        // Baca file Excel jadi array
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $header = array_map('trim', $rows[0]);
        unset($rows[0]);

        foreach ($rows as $key => $value) {
            $clean_name = strtolower($value[0]);
            // hapus tanda baca
            $clean_name = str_replace([".", "'", ","], "", $clean_name);
            // ganti spasi dengan titik
            $clean_name = str_replace(" ", ".", $clean_name);
            // hapus spasi/tanda di awal/akhir
            $clean_name = trim($clean_name);
            // gabungkan jadi email
            $email = $clean_name . "@cendekia.com";

            $kelas = explode(' ', $value[2]);

            $cekUser = User::where('email', 'like', $email)->first();

            if ($cekUser) {
                $cekUser->update([
                    'roles_id' => 1, // siswa
                    'name' => ucfirst($value[0]),
                    'email' => $email,
                    'telepon' => $value[4],
                    'asal_sekolah' => $value[3],
                    //'jenjang' => $faker->randomElement(['SD', 'SMP', 'SMA']),
                    'jenjang' => $value[1],
                    'kelas' => $kelas[0] ?? '0',
                    'alamat' => $value[7],
                    'nama_orang_tua' => $value[5],
                    'telp_orang_tua' => $value[6],
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'), // Use a static password for simplicity
                    'remember_token' => Str::random(10),
                    'tipe_siswa' => 'Cendekia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $cekUser->assignRole('Siswa');
            } else {
                $user = User::create([
                    'roles_id' => 1, // siswa
                    'name' => ucfirst($value[0]),
                    'email' => $email,
                    'telepon' => $value[4],
                    'asal_sekolah' => $value[3],
                    //'jenjang' => $faker->randomElement(['SD', 'SMP', 'SMA']),
                    'jenjang' => $value[1],
                    'kelas' => $kelas[0] ?? '0',
                    'alamat' => $value[7],
                    'nama_orang_tua' => $value[5],
                    'telp_orang_tua' => $value[6],
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'), // Use a static password for simplicity
                    'remember_token' => Str::random(10),
                    'tipe_siswa' => 'Cendekia',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $user->assignRole('Siswa');
            }
        }
    }
}
