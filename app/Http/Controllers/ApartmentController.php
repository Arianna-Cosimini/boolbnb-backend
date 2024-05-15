<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        if($request->hasFile('cover_image')) {
            
            $path = Storage::disk('public')->put('apartment_images', $request->cover_image);
    
           
            $newApartment->cover_image = $path;
        }
        $request->validated();
        $newApartment = new Apartment();


        // DA ELIMINARE IL PRIMA POSSIBILE
        $newApartment->latitude = '44.494750';
        $newApartment->longitude = '44.494340';

        $newApartment->fill($request->all());
        $newApartment->user_id = Auth::id();

        $newApartment->save();
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        if($request->hasFile('cover_image')) {
            
            $path = Storage::disk('public')->put('apartment_images', $request->cover_image);
    
           
            $newApartment->cover_image = $path;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }
}
