<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\order_details;
use App\Models\payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function index(order $order)
    {
            $order->load(['order_details.product', 'user']);
            $payment = $order->payments->last();
            $snap_token = '';

            if ($payment && $payment->snap_token != null){
                $snap_token = $payment->snap_token;
            }
            if ($payment == null || $payment->status != 'paid') {
                // Set your Merchant Server Key
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = config('midtrans.is_production');
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;


                $transaction_details = array(
                    'order_id' => $order->invoice_number,
                    'gross_amount' => $order->gross_amount, // no decimal allowed for creditcard
                );
                $customer_details = array(
                    'first_name'    => $order->user->name,
                    'last_name'     => "",
                    'email'         => $order->user->email,
                    'phone'         => ""
                );
                $item_details  = [];
                foreach($order->order_details as $detail) {
                    $item_details[] = [
                        'id' => $detail->product_id,
                        'price' => $detail->price,
                        'quantity' => $detail->quantity,
                        'name' => $detail->Product->nama
                    ];
                }

                

                $transaction = array(
                    'transaction_details' => $transaction_details,
                    'customer_details' => $customer_details,
                    'item_details' => $item_details,
                );
                    if(empty($snap_token)){

                        try {
                            $snap_token = \Midtrans\Snap::getSnapToken($transaction);
                            payments::updateOrCreate(['order_id' => $order->id,],[
                                'amount' => $order->gross_amount,
                                'status' => 'pending',
                                'snap_token' => $snap_token,
                            ]);
                        } catch (\Exception $e) {
                            echo $e->getMessage();
                        }   
                    }

        }
        return Inertia::render('payment/index', [
            'Order' => $order,
            'snap_token' => $snap_token,
            'midtrans_client_key'=> config('midtrans.client_key')]);
    }
    public function store(Request  $request)
    {
        $request->validate([
            'items' => 'required|array',
            'total' => 'required|numeric'
        ]);
        DB::transaction(function () use ($request) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'gross_amount' => 0, // Nilai sementara
                'status' => 'pending',
            ]);
            $totalamount = 0;

            foreach ($request->items as $item) {
                $subtotal = $item['qty'] * $item['price'];
                order_details::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price']
                ]);
                $totalamount += $subtotal;
            };
            $order->update(['gross_amount' => $totalamount]);
        }); 
            $Orderid = order::where('user_id',auth()->id())->get();
            $order = $Orderid->last();
            $orders = $order->invoice_number; 

        return redirect(route('order',$orders));
    }



    public function show($id){
        settype($id,"integer");
        $dataOrder = order::where('user_id',$id)->get();
        if($id !== auth()->id()){
            abort(403,'Anda gapunya akses ke akun ini');
        }   
        return Inertia::render('payment/order',['Orders' => $dataOrder]);
    }

    public function dashboard(){
        $data = order::with(['order_details','user','order_details.Product'])->get();
        return Inertia::render('Dashboard',['data' => $data]);
    }
}