<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\payments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function HandleCallBack()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        $notif  = new \Midtrans\Notification();
        $transaction =  $notif->transaction_status;
        $fraud = $notif->fraud_status;


        // dapatkan order id
        $orderId = $notif->order_id;

        $order = order::where('invoice_number', $orderId)->first();
        if (!$order) {
            return response()->json(['error' => 'order not found'], 404);
        }
        if ($transaction == 'capture') {
            if ($fraud == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
            } else if ($fraud == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $this->UpdateOrderStatus($order, 'paid', $notif);
            }
        } else if ($transaction == 'cancel') {
            $this->UpdateOrderStatus($order, 'canceled', $notif);
        } else if ($transaction == 'deny') {
            $this->UpdateOrderStatus($order, 'failed', $notif);
        } else if ($transaction == 'settlement') {
            $this->UpdateOrderStatus($order, 'paid', $notif);
        }
    }
    protected function UpdateOrderStatus(order $order, string $status, $notif)
    {
        $order->update(['status' => $status]);
        payments::updateOrCreate([
            'order_id' => $order->id],
            [
                'amount' => $notif->gross_amount,
                'status' => $status,
                'payment_date' => in_array($status, ['paid', 'settlement']) ? now() : null
            ]
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
