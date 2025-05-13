<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images=Image::with('products')->get();
        return ImageResource::collection($images);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('url')) {
            $path = $request->file('url')->store('imagenes', 'public');
            $validatedData['url'] = $path;
        }

        $image = Image::create($validatedData);
        return new ImageResource($image);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('products');
        return new ImageResource($image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('url')) {
            if ($image->url) {
                Storage::disk('public')->delete($image->url);
            }
            $path = $request->file('url')->store('imagenes', 'public');
            $validatedData['url'] = $path;
        } else {
            $validatedData['url'] = $image->url;
        }
        
        $image->update($validatedData);
        return new ImageResource($image);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return response()->json(['message' => 'Imagen eliminada correctamente'], 200);
    }
}
