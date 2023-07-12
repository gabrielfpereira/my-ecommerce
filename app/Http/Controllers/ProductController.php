<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\TemporaryImage;
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
        $products = Product::with('images')->orderBy('created_at','desc')->paginate(15);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['price'] = (int) $data['price'];
//        dd($data);
        $product = Product::create($data);
        $temporyImage = TemporaryImage::where('folder', $request->images)->first();

        if ($temporyImage){
            $product
                ->addMedia(storage_path('app/public/images/tmp/' . $temporyImage->folder . '/' . $temporyImage->filename))
                ->toMediaCollection();
            rmdir(storage_path('app/public/images/tmp/' . $temporyImage->folder));
            $temporyImage->delete();
        }

        if(!$product){
            return redirect()->back()->with('error', 'erro ao cadastrar.');
        }

        $product->categories()->sync($data['categories']);

//        dd($product->categories);

        return redirect()->route('produtos.index')->with('message', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $product_id)
    {
        $product = Product::with('categories')->findOrFail($product_id);

        if(!$product){
            dd('Deu erro');
        }

        return view('products.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $product_id)
    {
        $product = Product::with('categories')->findORFail($product_id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
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
        $product->categories()->sync($data['categories']);

        $temporyImage = TemporaryImage::where('folder', $request->images)->first();

        if ($temporyImage){
            $product
                ->addMedia(storage_path('app/public/images/tmp/' . $temporyImage->folder . '/' . $temporyImage->filename))
                ->toMediaCollection();
            rmdir(storage_path('app/public/images/tmp/' . $temporyImage->folder));
            $temporyImage->delete();
        }

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
