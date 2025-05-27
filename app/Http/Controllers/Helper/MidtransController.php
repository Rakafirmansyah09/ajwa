<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Transaction;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Set Midtrans Configuration
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    public function checkPaymentStatus($orderId)
    {
        try {
            $status = Transaction::status($orderId);

            return [
                'success' => true,
                'message' => 'Payment status retrieved successfully',
                'data' => json_decode(json_encode($status), true),
            ];
        } catch (\Exception $e) {
            // Jika error dari Midtrans, parsing response JSON
            $message = $e->getMessage();
            $errorData = null;

            if (strpos($message, '{') !== false) {
                $errorData = json_decode(substr($message, strpos($message, '{')), true);
            }

            return [
                'success' => false,
                'message' => 'Failed to retrieve payment status: ' . ($errorData['status_message'] ?? $e->getMessage()),
                'data' => [
                    'status_code' => $errorData['status_code'] ?? 500,
                    'id' => $errorData['id'] ?? null,
                ],
            ];
        }
    }

    public function generateSnapToken($params)
    {
        try {
            $snapToken = Snap::getSnapToken($params);

            return [
                'success' => true,
                'message' => 'Snap token generated successfully',
                'data' => $snapToken,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to generate Snap token: ' . $e->getMessage(),
                'data' => null,
            ];
        }
    }
}
