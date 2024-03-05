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


    public function show(Gallery $gallery)
    {
        return new ImageResource($gallery);
    }
    public function update(UpdateGalleryRequest $request, $id)
    {
        $gallery=Gallery::find($id);
        // dd($gallery);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $imagePath = $request->file('image')->store('gallery_images', 'public');
            $data['image'] = $imagePath;
        }


        $gallery->update($data);
        // dd($gallery);
        return new ImageResource($gallery);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
