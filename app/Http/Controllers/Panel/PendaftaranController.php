<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryoutPeserta;
use App\Models\Tryout;
use App\Models\Invoice;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Symfony\Component\HttpFoundation\StreamedResponse;



class PendaftaranController extends Controller
{
    public function index(Request $request)
    {

        $load['peserta'] =  TryoutPeserta::with('siswa', 'masterTryout')
            ->when($request->keyword, function ($query) use ($request) {
                $kw = "%{$request->keyword}%";
                return $query->where(function ($q) use ($kw) {

                    // Nama peserta
                    $q->where('tryout_peserta_name', 'like', $kw)

                        // Relasi ke siswa (kelas & asal sekolah)
                        ->orWhereHas('siswa', function ($sq) use ($kw) {
                            $sq->where('asal_sekolah', 'like', $kw)
                                ->orWhere('kelas', 'like', $kw)
                                ->orWhere('jenjang', 'like', $kw); // optional, kalau kolom jenjang ditampilkan
                        })

                        // Relasi ke Tryout
                        ->orWhereHas('masterTryout', function ($tq) use ($kw) {
                            $tq->where('tryout_judul', 'like', $kw);
                        });
                });
            })
            ->when($request->tryout, function ($query) use ($request) {
                return $query->where('tryout_id',  "$request->tryout");
            })
            ->when($request->asal_sekolah, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('asal_sekolah', $request->asal_sekolah);
                });
            })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('jenjang', $request->jenjang);
                });
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('kelas', $request->kelas);
                });
            })
            ->orderBy('tryout_peserta_status')
            ->orderByDesc('created_at')
            ->paginate(10);

        $load['tryout'] = Tryout::select('tryout_judul', 'tryout_id')->get()->pluck('tryout_judul', 'tryout_id');

        $load['keyword'] = $request->keyword;

        return view('pages.panel.pendaftaran.index', ($load));
    }

    /**
     * Export data peserta ke Excel
     */
    public function export(Request $request)
    {
        $query = TryoutPeserta::with('siswa', 'masterTryout')
            ->when($request->keyword, function ($query) use ($request) {
                return $query->where('tryout_peserta_name', 'like', "%{$request->keyword}%")
                    ->orWhere('tryout_peserta_telpon', 'like', "%{$request->keyword}%");
            })
            ->when($request->tryout, function ($query) use ($request) {
                return $query->where('tryout_id',  "{$request->tryout}");
            })
            ->when($request->asal_sekolah, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('asal_sekolah', $request->asal_sekolah);
                });
            })
            ->when($request->jenjang, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('jenjang', $request->jenjang);
                });
            })
            ->when($request->kelas, function ($query) use ($request) {
                return $query->whereHas('siswa',  function ($q) use ($request) {
                    return $q->where('kelas', $request->kelas);
                });
            })
            ->orderBy('tryout_peserta_status')
            ->orderByDesc('created_at');

        $rows = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // header
        $headers = ['No', 'Nama', 'Telepon', 'Kelas', 'Asal Sekolah', 'Tryout', 'Status', 'Tanggal Daftar'];
        $col = 1;
        foreach ($headers as $h) {
            $colLetter = Coordinate::stringFromColumnIndex($col);
            $sheet->setCellValue($colLetter . '1', $h);
            $col++;
        }

        $rowNum = 2;
        foreach ($rows as $index => $item) {
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(1) . $rowNum, $index + 1);
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(2) . $rowNum, $item->tryout_peserta_name);
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(3) . $rowNum, $item->tryout_peserta_telpon ?? ($item->siswa->telepon ?? '-'));
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(4) . $rowNum, $item->siswa->kelas ?? '-');
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(5) . $rowNum, $item->siswa->asal_sekolah ?? '-');
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(6) . $rowNum, $item->masterTryout->tryout_judul ?? '-');
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(7) . $rowNum, $item->tryout_peserta_status ? 'Teregister' : 'Pending');
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(8) . $rowNum, Carbon::parse($item->created_at)->format('Y-m-d H:i:s'));
            $rowNum++;
        }

        // Styling header: bold, background color, white font, center align
        $lastColIndex = count($headers);
        $lastColLetter = Coordinate::stringFromColumnIndex($lastColIndex);
        $headerRange = 'A1:' . $lastColLetter . '1';
        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF1976D2');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

        // Autosize columns
        for ($i = 1; $i <= $lastColIndex; $i++) {
            $sheet->getColumnDimension(Coordinate::stringFromColumnIndex($i))->setAutoSize(true);
        }

        // Apply borders and wrap text for data range
        $lastRow = $rowNum - 1;
        $dataRange = 'A1:' . $lastColLetter . $lastRow;
        $sheet->getStyle($dataRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFDDDDDD');
        $sheet->getStyle($dataRange)->getAlignment()->setWrapText(true);

        // Format tanggal column (assumed column 8)
        if ($lastRow >= 2 && $lastColIndex >= 8) {
            $dateCol = Coordinate::stringFromColumnIndex(8);
            $sheet->getStyle($dateCol . '2:' . $dateCol . $lastRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DATETIME);
        }

        // Freeze header row
        $sheet->freezePane('A2');

        $writer = new Xlsx($spreadsheet);

        // Nama file default (format semula): gunakan timestamp agar unik
        $fileName = 'pendaftaran_' . now()->format('Ymd_His') . '.xlsx';

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $fileName . '"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    public function approve($id)
    {
        $peserta = TryoutPeserta::with('siswa', 'masterTryout')->find($id);
        $peserta->tryout_peserta_status = 1;
        $peserta->save();

        if ($peserta->masterTryout->tryout_jenis != 'Gratis') {
            $invoice =  Invoice::where('user_id', $peserta->user_id)
                ->where('tryout_id', $peserta->tryout_id)
                ->where('tryout_peserta_id', $id)
                ->first();
            $invoice->status = 1;
            $invoice->inv_paid = Carbon::now()->format('Y-m-d');
            $invoice->save();
        }

        return redirect()->route('panel.pendaftaran.index')
            ->withSuccess(('Siswa Berhasil ditambahkan.'));
    }

    public function reject($id)
    {
        $peserta = TryoutPeserta::with('siswa', 'masterTryout')->find($id);
        $peserta->tryout_peserta_status = 2;
        $peserta->save();

        if ($peserta->masterTryout->tryout_jenis != 'Gratis') {
            $invoice =  Invoice::where('user_id', $peserta->user_id)
                ->where('tryout_id', $peserta->tryout_id)
                ->where('tryout_peserta_id', $id)
                ->first();
            $invoice->status = 3;
            $invoice->inv_paid = Carbon::now()->format('Y-m-d');
            $invoice->save();
        }

        return redirect()->route('panel.pendaftaran.index')
            ->withSuccess(('Siswa Berhasil dibatalkan.'));
    }

    public function show($id)
    {

        $peserta =  TryoutPeserta::with('siswa', 'masterTryout')->find($id);

        $load['peserta'] = $peserta;

        if ($peserta->tryout_peserta_status) {
            $telpon = $peserta->waNumber;

            $load['wa_link'] = "https://wa.me/" . $telpon . "?text=Halo " . $peserta->tryout_peserta_name . ". Pendaftaran Anda untuk tryout " . $peserta->masterTryout->tryout_judul . " telah dikonfirmasi. Silakan melakukan tryout.";
        }



        return view('pages.panel.pendaftaran.show', ($load));
    }
}
