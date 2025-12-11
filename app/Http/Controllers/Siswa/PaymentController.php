<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\TryoutPeserta;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createSnapToken(Request $request, MidtransService $midtrans)
    {
        $invoice = Invoice::find($request->inv_id);

        if ($invoice->snap_token) {

            return response()->json([
                'snap_token' => $invoice->snap_token,
                'redirect_url' => $invoice->redirect_url,
            ]);
        } else {
            $params = [
                'transaction_details' => [
                    'order_id' => $invoice->inv_id, // ID unik setiap transaksi
                    'gross_amount' => $invoice->total,
                ],
                'customer_details' => [
                    'first_name' => $invoice->peserta->tryout_peserta_name,
                    'email' => $invoice->peserta->tryout_peserta_email,
                    'phone' => $invoice->peserta->tryout_peserta_telpon,
                ],
            ];
            $snap = $midtrans->createTransaction($params);

            $invoice->snap_token =  $snap->token;
            $invoice->redirect_url =  $snap->redirect_url;
            $invoice->save();

            return response()->json([
                'snap_token' => $snap->token,
                'redirect_url' => $snap->redirect_url,
            ]);
        }
    }

    public function handleNotification(Request $request)
    {

        $invoice = Invoice::find($request->order_id);
        if (!$invoice) {
            return response()->json(['message' => 'Notification handled'], 200);
        }

        $invoiceStatus = 0;
        if ($request->transaction_status == 'settlement') {
            $invoiceStatus = 1;
        } elseif ($request->transaction_status == 'expire') {
            $invoiceStatus = 2;
        }

        $invoice->status = $request->transaction_status == $invoiceStatus;
        $invoice->payment_type = $request->payment_type;

        if ($invoice->payment_type == 'bank_transfer') {
            $invoice->bank = $request->va_numbers[0]['bank'] ?? '';
            $invoice->va_number = $request->va_numbers[0]['va_number'] ?? '';
        }

        if ($request->transaction_status == 'settlement') {
            $invoice->inv_paid = $request->transaction_time;
            $invoice->remark = "Dibayar melalui Midtrans dengan status " . $request->transaction_status;
        }
        $invoice->updated_at = now();
        $invoice->save();

        $tryoutPeserta = TryoutPeserta::where('tryout_peserta_id', $invoice->tryout_peserta_id)
            ->where('tryout_id', $invoice->tryout_id)
            ->first();

        if ($tryoutPeserta) {
            $statusTryoutPeserta = 0;
            if ($request->transaction_status == 'settlement') {
                $statusTryoutPeserta = 1;
            } elseif ($request->transaction_status == 'expire') {
                $statusTryoutPeserta = 2;
            }
            $tryoutPeserta->tryout_peserta_status  = $statusTryoutPeserta;
            $tryoutPeserta->updated_at = now();
            $tryoutPeserta->save();
        }


        return response()->json(['message' => 'Notification handled'], 200);
    }
}
