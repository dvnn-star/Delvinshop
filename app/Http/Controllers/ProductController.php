<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(  )
    {   
        $datas = Product::orderBy('id','asc')->paginate(10);
        return Inertia::render('Products/Index',['products' => [
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
        ]]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return Inertia::render('Products/Create',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'nama' => 'required|string|max:255',
            'price'=> 'required|numeric||min:0',
            'description' => 'nullable|string'
        ]);
        Product::create($data);
        return redirect()->route('products')->with('message','product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::all();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'price'=> 'required|numeric||min:0',
            'description' => 'nullable|string'
        ]);
        $product->update([
            'nama'=> $request->input('nama'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ]);
        return redirect()->route('products')->with('update','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.  
     */
    public function destroy(Product $product)
    {
      
        $product->delete();
        return redirect()->route('products')->with('delete','Product Delete successfully');
    }
    public function search(Request $request)
    {
        $query = $request->q;
        $results = [];
        if ($query){
            $results = Product::where("nama","LIKE","%{$query}%")->get();
        }
       
        return inertia::render('Products/Index',[
            'products' =>[
                'data' => $results,
                'meta' => [],
                'links' => []
            ],
            'Results' => $results
        ]);
            
    }   

}