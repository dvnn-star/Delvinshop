<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index(){
        return Inertia::render('payment/index');

    }
    public function store(Request  $request){
        dd($request);

        return Inertia::render('payment/index');
    }
}
