<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\order_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(){
        return Inertia::render('payment/index');

    }
    public function store(Request  $request){
        $request->validate([
            'items' => 'required|array',
            'total' => 'required|numeric'
        ]);
        DB::transaction(function() use ($request){
            $order = Order::create([
                'user_id' => auth()->id(),
                'gross_amount' => 0, // Nilai sementara
                'status' => 'pending',  
            ]);
            $totalamount = 0;

        foreach($request->items as $item){
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

        return Inertia::render('payment/index');
    }
}
