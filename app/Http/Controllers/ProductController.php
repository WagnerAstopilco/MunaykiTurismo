<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'ratings', 'activities', 'images', 'reservations', 'promotions'])->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'ratings', 'activities', 'images', 'reservations', 'promotions']);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
    public function uploadImagenes(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'required|image|max:5120', // Máx 5MB por imagen
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            $product->images()->create(['url' => '/storage/' . $path]);
        }

        return response()->json(['message' => 'Imágenes subidas correctamente'], 200);
    }

    public function uploadFile(Request $request, Product $product)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,csv,ppt,pptx,txt,zip|max:10240',
        ]);

        $path = $request->file('file')->store('brochures', 'public');
        $product->update(['file' => '/storage/' . $path]);

        return response()->json(['message' => 'Archivo cargado correctamente', 'path' => '/storage/' . $path], 200);
    }
}
