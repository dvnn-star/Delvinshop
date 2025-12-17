<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductShowController extends Controller
{
    public function index()
    {
        $ratings = Ratings::orderBy('id', 'desc')->limit(11)->get();
        $datas = Product::orderBy('id', 'asc')->paginate(9);
        return Inertia::render('Welcome', [
            'products' => [
                'data' => $datas->items(),
                'meta' => [
                    'current_page' => $datas->currentPage(),
                    'from' => $datas->firstItem(),
                    'last_page' => $datas->lastPage(),
                    'per_page' => $datas->perPage(),
                    'to' => $datas->lastItem(),
                    'total' => $datas->total(),
                ],
                'links' => [
                    'first' => $datas->url(1),
                    'last' => $datas->url($datas->lastPage()),
                    'prev' => $datas->previousPageUrl(),
                    'next' => $datas->nextPageUrl(),
                    'pages' => $datas->linkCollection()->toArray(),
                ]
            ],
            'ratings' => $ratings,
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'message' => 'required|string|max:20',
            'bintang' => 'required|integer|min:1|max:5'
        ]);
        Ratings::create([
            'user' => $data['nama'],
            'Ratings' => $data['message'],
            'Bintang' => $data['bintang']
        ]);
        return back()->with('success', 'Data berhasil Dikirim');
    }
        public function search(Request $request)
    {
        $query = $request->q;
        $results = [];
        if ($query){
            $results = Product::where("nama","LIKE","%{$query}%")->orWhere("type","LIKE","%{$query}%")->get();
        }
       
        return inertia::render('Welcome',[
            'products' =>[
                'data' => $results,
                'meta' => [],
                'links' => []
            ],
            'Results' => $results
        ]);
    }
}
