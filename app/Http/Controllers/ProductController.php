<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->paginate(15);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['price'] = (int) $data['price'];
        // dd($data);
        if(Product::create($data)){
            return redirect()->route('produtos.index')->with('message', 'Produto cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'erro ao cadastrar.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $product_id)
    {
        $product = Product::findORFail($product_id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product_id)
    {
        $data = $request->validated();
        $data['price'] = (int) $data['price'];

        $product = Product::findOrFail($product_id);

        if(!$product){
            throw new Exception('Produto não encontrado.');
        }

        $product->update($data);

        return redirect()->route('produtos.index')->with('message', 'Produto atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $product, $product_id)
    {
        $product = Product::findOrFail($product_id);
        if(!$product){
            return redirect()->back()->with('error', 'Não foi possível fazer a ação.');
        }

        $product->delete();
        return redirect()->back()->with('message', 'Produto deletado!');
    }
}
