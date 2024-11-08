<?php

namespace App\Http\Controllers\Api;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Gallery\ImageResource;
use App\Http\Resources\Gallery\ImageCollection;
use App\Http\Requests\Gallery\StoreImageRequest;
use App\Http\Requests\Gallery\UpdateGalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return new ImageCollection(Gallery::all());
    }
    public function store(StoreImageRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery_images', 'public');
            $data['image'] = $imagePath;
        }


        $gallery = Gallery::create($data);
        return new ImageResource($gallery);
    }


    public function show(Gallery $image)
    {
        return new ImageResource($image);
    }
    public function update(UpdateGalleryRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['error' => 'Gallery not found'], 404);
        }

        $data = $request->validated();
        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('gallery_images', 'public');
                $oldImage = $gallery->image;
                $data['image'] = $imagePath;
                $gallery->update($data);
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            } else {
                $gallery->update($data);
            }

            return new ImageResource($gallery);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Gallery $image)
    {
        try {
            $image->delete();
            return response()->json(['message' => 'Gallery deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
