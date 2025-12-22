<?php

namespace App\Http\Controllers\Filter;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilterController extends Controller
{
    public function Baju(){
        $datas =  Product::orderBy('id','asc')->where('type','=','baju')->get();
        return Inertia::render('Products/baju',['datas' => $datas]);
    }
}
