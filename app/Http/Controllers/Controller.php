<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\MidtransController;
use App\Models\pembayaran;
use Illuminate\Support\Facades\Log;

abstract class Controller
{
    public $midtrans;

    public function  __construct()
    {
        // Log::info('Controller: ' . now());

        $this->midtrans = new MidtransController();

        $this->checckPembayaan();
    }

    private function checckPembayaan()
    {
        $pembayaranPending =  pembayaran::where('status', 'pending')
            ->where('method', 'digital')
            ->get();


        foreach ($pembayaranPending as $pembayaran) {
            $data = $this->midtrans->checkPaymentStatus($pembayaran->id);

            $status = $data['data']['transaction_status'];
            $fraud = $data['data']['fraud_status'];
            $order_id = $data['data']['order_id'];

            if ($status == 'capture') {
                if ($fraud == 'challenge') {
                    $pembayaran->update(['status' => 'pending']);
                } else if ($fraud == 'accept') {
                    $pembayaran->update(['status' => 'success']);
                }
            } else if ($status == 'settlement') {
                $pembayaran->update(['status' => 'success']);
            } else if ($status == 'cancel' || $status == 'deny' || $status == 'expire') {
                $pembayaran->update(['status' => 'failed']);
            } else if ($status == 'pending') {
                $pembayaran->update(['status' => 'pending']);
            }
        }
    }
}
