<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::with(['subcategories', 'categoryParent','products'])->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData=$request->validated();
        if($request->parent_id){
            $parent=Category::find($validatedData['parent_id']);
            $slug='/'.Str::slug($parent->name).'/'.Str::slug($validatedData['name']);
            $validatedData['slug']=$slug;
        }
        else{
            $slug='/'.Str::slug($validatedData['name']);
            $validatedData['slug']=$slug;
        }

        $category = Category::create($validatedData);
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['subcategories', 'categoryParent','products']);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateCategoryRequest $request, Category $category)
{
    $validatedData = $request->validated();

    $nombreCambiado = isset($validatedData['name']) && $validatedData['name'] !== $category->name;
    $parentCambiado = isset($validatedData['parent_id']) && $validatedData['parent_id'] !== $category->parent_id;

    if ($nombreCambiado || $parentCambiado) {
        $parentId = $validatedData['parent_id'] ?? $category->parent_id;

        if ($parentId) {
            $parent = Category::find($parentId);
            if (!$parent) {
                return response()->json(['error' => 'La categoría padre especificada no existe.'], 404);
            }
            $slugPrefix = '/' . Str::slug($parent->slug);
        } else {
            // Si no hay padre, el slug es raíz
            $slugPrefix = '';
        }

        $nombreCategoria = $validatedData['name'] ?? $category->name;
        $validatedData['slug'] = $slugPrefix . '/' . Str::slug($nombreCategoria);
    }

    $category->update($validatedData);

    return new CategoryResource($category);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Categoría eliminada correctamente'], 200);
    }
}
