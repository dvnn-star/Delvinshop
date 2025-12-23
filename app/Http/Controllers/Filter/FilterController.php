<?php

namespace App\Http\Controllers\Filter;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilterController extends Controller
{
    public function Baju()
    {
        $datas =  Product::orderBy('id', 'asc')->where('type', '=', 'baju')->get();
        return Inertia::render('Products/baju', ['datas' => $datas]);
    }
    public function Celana()
    {
        $datas =  Product::orderBy('id', 'asc')->where('type', '=', 'celana')->get();
        return Inertia::render('Products/celana', ['datas' => $datas]);
    }
        public function Gaun()
    {
        $datas =  Product::orderBy('id', 'asc')->where('type', '=', 'gaun')->get();
        return Inertia::render('Products/gaun', ['datas' => $datas]);
    }
        public function Kemeja()
    {
        $datas =  Product::orderBy('id', 'asc')->where('type', '=', 'kemeja')->get();
        return Inertia::render('Products/kemeja', ['datas' => $datas]);
    }

}
