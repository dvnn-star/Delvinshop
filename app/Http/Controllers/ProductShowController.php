<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductShowController extends Controller
{
    public function index(){
        $datas = Product::orderBy('id','asc')->paginate(9);
        return Inertia::render('Welcome',['products' => [
            'data' => $datas->items(),
            'meta' => [
                'current_page' =>$datas->currentPage(),
                'from' => $datas->firstItem(),
                'last_page' => $datas->lastPage(),
                'per_page' => $datas->perPage(),
                'to' => $datas->lastItem(),
                'total' =>$datas->total(),
            ],
            'links' =>[
                'first' => $datas->url(1),
                'last' =>$datas->url($datas->lastPage()),
                'prev' => $datas->previousPageUrl(),
                'next' => $datas->nextPageUrl(),
                'pages' => $datas->linkCollection()->toArray(),
            ]
            ],
            'ratings' => Ratings::orderBy('id','desc')->limit(11)->get(),
        ]);
    
    }
}
