<?php

namespace App\Http\Controllers\Panel\Referensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsalSekolah;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Str;

class AsalSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $load['asal_sekolah'] = AsalSekolah::when($request->keyword, function ($query) use ($request) {
            return $query->where('nama_sekolah', 'like', "%{$request->keyword}%");
        })
            ->paginate(10);



        $load['keyword'] = $request->keyword;

        return view('pages.panel.ref_asal_sekolah.index', ($load));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
        ]);

        $user = AsalSekolah::create([
            'nama_sekolah' => $request->nama_sekolah,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('panel.asal_sekolah.index')
            ->withSuccess(('Asal Sekolah berhasil ditambahkan.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
        ]);

        $user = AsalSekolah::where('nama_sekolah', $id)->update([
            'nama_sekolah' => $request->nama_sekolah,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('panel.asal_sekolah.index')
            ->withSuccess(('Asal Sekolah berhasil diupdate.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AsalSekolah::where('nama_sekolah', $id)->delete();

        return redirect()->route('panel.asal_sekolah.index')
            ->withSuccess(('Asal Sekolah Berhasil dihapus.'));
    }

    /**
     * Import asal sekolah dari file Excel/CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $path = $request->file('import_file')->getRealPath();

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $index => $row) {
            // Skip header row if it looks like header
            if ($index == 0) {
                $firstCell = trim(strtolower((string)($row[0] ?? '')));
                if (in_array($firstCell, ['nama sekolah', 'nama_sekolah', 'school name', 'name'])) {
                    continue;
                }
            }

            $name = trim((string)($row[0] ?? ''));
            if (!$name) continue;

            // Normalize name (trim and reduce spaces)
            $nameNormalized = preg_replace('/\s+/', ' ', $name);

            // Get jenjang from second column, or detect from school name
            $jenjang = trim((string)($row[1] ?? ''));
            if (!$jenjang) {
                // Auto-detect jenjang from school name
                if (stripos($nameNormalized, 'SD') !== false) {
                    $jenjang = 'SD';
                } elseif (stripos($nameNormalized, 'SMP') !== false) {
                    $jenjang = 'SMP';
                } elseif (stripos($nameNormalized, 'SMA') !== false) {
                    $jenjang = 'SMA';
                } elseif (stripos($nameNormalized, 'SMK') !== false) {
                    $jenjang = 'SMK';
                } else {
                    $jenjang = 'SD'; // Default to SD if can't detect
                }
            }

            // Insert if not exists
            $exists = AsalSekolah::where('nama_sekolah', $nameNormalized)->exists();
            if (!$exists) {
                AsalSekolah::create([
                    'nama_sekolah' => $nameNormalized,
                    'jenjang' => $jenjang
                ]);
                $inserted++;
            } else {
                $skipped++;
            }
        }

        return redirect()->route('panel.asal_sekolah.index')
            ->withSuccess("Import selesai. Dimasukkan: $inserted, dilewati (duplikat): $skipped.");
    }
}
