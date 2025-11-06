<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = Invoice::query()
            ->when($request->status, function ($q, $status) {
                if ($status == 2) {
                    $q->where('status', 0);
                } else {
                    $q->where('status', $status);
                }
            })
            // Keyword search: invoice id, related tryout title, peserta name, or numeric amounts
            ->when($request->keyword, function ($q, $keyword) {
                $cleanNumeric = preg_replace('/\D/', '', $keyword);

                // detect status keywords
                $lower = strtolower(trim($keyword));
                $statusVal = null;
                if (in_array($lower, ['lunas'])) {
                    $statusVal = 1;
                } elseif (in_array($lower, ['menunggu', 'menunggu pembayaran', 'menunggu_pembayaran'])) {
                    $statusVal = 0;
                }

                // detect date-like input
                $ts = strtotime($keyword);
                $isDate = $ts !== false && $ts !== -1;
                $dateYmd = $isDate ? date('Y-m-d', $ts) : null;

                // if the cleaned keyword is a number (e.g. searching amounts like 300000)
                if ($cleanNumeric !== '' && is_numeric($cleanNumeric)) {
                    $q->where(function ($sub) use ($cleanNumeric, $keyword, $statusVal, $isDate, $dateYmd) {
                        $sub->where('amount', $cleanNumeric)
                            ->orWhere('total', $cleanNumeric)
                            // discount column stores percentage; also check percentage equality
                            ->orWhere('discount', $cleanNumeric)
                            // also check computed discount nominal: (amount * discount) / 100 = searched value
                            ->orWhereRaw('ROUND((COALESCE(amount,0) * COALESCE(discount,0)) / 100) = ?', [$cleanNumeric])
                            ->orWhere('inv_id', 'like', "%{$keyword}%")
                            ->orWhereHas('tryout', function ($q2) use ($keyword) {
                                $q2->where('tryout_judul', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('peserta', function ($q3) use ($keyword) {
                                $q3->where('tryout_peserta_name', 'like', "%{$keyword}%");
                            });

                        if (!is_null($statusVal)) {
                            $sub->orWhere('status', $statusVal);
                        }

                        if ($isDate && $dateYmd) {
                            $sub->orWhereDate('created_at', $dateYmd)
                                ->orWhereDate('inv_paid', $dateYmd)
                                ->orWhereDate('due_date', $dateYmd);
                        }
                    });
                } else {
                    $q->where(function ($sub) use ($keyword, $statusVal, $isDate, $dateYmd) {
                        $sub->where('inv_id', 'like', "%{$keyword}%")
                            ->orWhereHas('tryout', function ($q2) use ($keyword) {
                                $q2->where('tryout_judul', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('peserta', function ($q3) use ($keyword) {
                                $q3->where('tryout_peserta_name', 'like', "%{$keyword}%");
                            });

                        if (!is_null($statusVal)) {
                            $sub->orWhere('status', $statusVal);
                        }

                        if ($isDate && $dateYmd) {
                            $sub->orWhereDate('created_at', $dateYmd)
                                ->orWhereDate('inv_paid', $dateYmd)
                                ->orWhereDate('due_date', $dateYmd);
                        }
                    });
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $load['invoices'] = $invoices;
        return view('pages.panel.invoice.index', $load);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $load['invoice'] = Invoice::find($id);
        return view('pages.panel.invoice.show', $load);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
