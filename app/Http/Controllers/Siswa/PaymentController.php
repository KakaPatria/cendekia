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

        $transactionStatus = (string) $request->input('transaction_status', '');
        $paymentType = (string) $request->input('payment_type', '');
        $fraudStatus = (string) $request->input('fraud_status', '');

        
        $invoiceStatus = 0;
        $isPaid = false;
        if ($transactionStatus === 'settlement') {
            $invoiceStatus = 1;
            $isPaid = true;
        } elseif ($transactionStatus === 'capture') {
          
            if ($fraudStatus === '' || $fraudStatus === 'accept') {
                $invoiceStatus = 1;
                $isPaid = true;
            }
        } elseif ($transactionStatus === 'expire') {
            $invoiceStatus = 2;
        } elseif (in_array($transactionStatus, ['cancel', 'deny'], true)) {
            $invoiceStatus = 3;
        }

        $invoice->status = $invoiceStatus;
        $invoice->payment_type = $paymentType;

        if ($invoice->payment_type == 'bank_transfer') {
            $invoice->bank = $request->va_numbers[0]['bank'] ?? '';
            $invoice->va_number = $request->va_numbers[0]['va_number'] ?? '';
        }

        if ($isPaid) {
            $invoice->inv_paid = $request->input('transaction_time');
            $invoice->remark = "Dibayar melalui Midtrans dengan status " . $transactionStatus;
        }
        $invoice->updated_at = now();
        $invoice->save();

        $tryoutPeserta = TryoutPeserta::where('tryout_peserta_id', $invoice->tryout_peserta_id)
            ->where('tryout_id', $invoice->tryout_id)
            ->first();

        if ($tryoutPeserta) {
            // Tryout peserta: 0=Pending, 1=Terdaftar (boleh mengerjakan), 2=Batal
            $statusTryoutPeserta = 0;
            if ($isPaid) {
                $statusTryoutPeserta = 1;
            } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'], true)) {
                $statusTryoutPeserta = 2;
            }
            $tryoutPeserta->tryout_peserta_status  = $statusTryoutPeserta;
            $tryoutPeserta->updated_at = now();
            $tryoutPeserta->save();
        }


        return response()->json(['message' => 'Notification handled'], 200);
    }
}
