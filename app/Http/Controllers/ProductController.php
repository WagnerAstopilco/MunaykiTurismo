<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'ratings', 'activities', 'images', 'reservations', 'promotions', 'destino', 'coupons'])->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::find($validatedData['category_id']);
        if ($category->parent_id) {
            $parent = Category::find($category['parent_id']);
            $slug = '/' . Str::slug($parent->name) . '/' . Str::slug($category->name) . '/' . Str::slug($validatedData['name']);
            $validatedData['slug'] = $slug;
        } else {
            $slug = '/' . Str::slug($category->name) . '/' . Str::slug($validatedData['name']);
            $validatedData['slug'] = $slug;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = $file->getClientOriginalName();
            $filename = Str::uuid();
            $fileCompleteName = $filename . '__' . $originalFileName;
            $path = $file->storeAs('brochures', $fileCompleteName, 'public');
            $validatedData['file'] = $path;
        }
        $product = Product::create(Arr::except($validatedData, ['image_ids', 'activity_ids']));

        $product->activities()->attach($validatedData['activity_ids']);
        $product->images()->attach($validatedData['image_ids']);

        return new ProductResource($product);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'ratings', 'activities', 'images', 'reservations', 'promotions', 'destino', 'coupons']);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        $nombreCambiado = isset($validatedData['name']) && $validatedData['name'] !== $product->name;
        $categoriaCambiada = isset($validatedData['category_id']) && $validatedData['category_id'] !== $product->category_id;

        if ($nombreCambiado || $categoriaCambiada) {
            $categoryId = $validatedData['category_id'] ?? $product->category_id;
            $category = Category::find($categoryId);
            if (!$category) {
                return response()->json(['error' => 'La categoría especificada no existe.'], 404);
            }
            $nombreProducto = $validatedData['name'] ?? $product->name;
            $validatedData['slug'] = '/' . Str::slug($category->slug) . '/' . Str::slug($nombreProducto);
        }
        if ($request->hasFile('file')) {
            if ($product->file) {
                Storage::disk('public')->delete($product->file);
            }
            $path = $request->file('file')->store('brochures', 'public');
            $validatedData['file'] = $path;
        } else {
            $validatedData['file'] = $product->file;
        }
        $product->update(Arr::except($validatedData, ['image_ids', 'activity_ids']));
        $product->activities()->syncWithoutDetaching($validatedData['activity_ids'] ?? []);
        $product->images()->syncWithoutDetaching($validatedData['image_ids'] ?? []);

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


    // public function uploadImagenes(Request $request, Product $product)
    // {
    //     $request->validate([
    //         'images.*' => 'required|image|max:5120', // Máx 5MB por imagen
    //     ]);

    //     foreach ($request->file('images') as $image) {
    //         $path = $image->store('products', 'public');
    //         $product->images()->create(['url' => '/storage/' . $path]);
    //     }

    //     return response()->json(['message' => 'Imágenes subidas correctamente'], 200);
    // }
}
