<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Category;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

//import library Str for 
use Illuminate\Support\Str;

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
        $services = Service::all();
        $categories = Category::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.create', compact('services', 'categories', 'sponsorships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $request->validated();
        $newApartment = new Apartment();

        // dd($request);
        // DA ELIMINARE IL PRIMA POSSIBILE
        // $newApartment->latitude = '44.494750';
        // $newApartment->longitude = '44.494340';

        if ($request->hasFile('cover_image')) {

            $path = Storage::disk('public')->put('apartment_images', $request->cover_image);

            $newApartment->cover_image = $path;
        }

        // save slug
        $newApartment->slug = Str::slug($request->name);

        $newApartment->fill($request->all());
        
        $newApartment->user_id = Auth::id();

        $newApartment->save();

        $newApartment->services()->attach($request->services);
        $newApartment->categories()->attach($request->categories);
        $newApartment->sponsorships()->attach($request->sponsorships);

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
        $services = Service::all();
        $categories = Category::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.edit', compact('apartment','services', 'categories', 'sponsorships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $apartment->fill($request->all());

        /* dd($request->all()); */

        if ($request->hasFile('cover_image')) {

            $path = Storage::disk('public')->put('apartment_images', $request->cover_image);


            $apartment->cover_image = $path;
        }
        // save slug
        $apartment->slug = Str::slug($request->name);
        $apartment->services()->sync($request->services);
        $apartment->categories()->sync($request->categories);
        $apartment->sponsorships()->sync($request->sponsorships);


        $apartment->save();
        return redirect()->route('admin.apartments.show', compact('apartment'));

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
