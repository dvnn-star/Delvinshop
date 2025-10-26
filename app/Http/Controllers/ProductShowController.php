<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductShowController extends Controller
{
    public function index(){
        $data = Product::all();
        return Inertia::render('Welcome',[
            'data' => $data
        ]);
    
    }
}
