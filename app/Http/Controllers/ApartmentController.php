<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Category;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
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
        // Recupera gli appartamenti dell'utente autenticato
        $apartments = Apartment::where('user_id', Auth::id())
        ->with(['services', 'sponsorships' => function ($query) {
            $query->where('end_date', '>', Carbon::now());
        }])
        ->get();

        // dd($apartments);
        
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
        $newApartment->slug = Str::slug($request->name . Str::random(10));

        $newApartment->fill($request->all());

        $newApartment->user_id = Auth::id();
        $newApartment->visible = $request->has('visible') ? 1 : 0;

        $newApartment->save();

        $newApartment->services()->attach($request->services);
        $newApartment->categories()->attach($request->categories);
        $newApartment->sponsorships()->attach($request->sponsorships);

        return redirect()->route('admin.apartments.index')->with('success', 'Annuncio aggiunto con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        if (Auth::user()->id != $apartment->user_id)
        return redirect()->route('admin.apartments.index', compact('apartment'))->with('warning', 'Ci dispiace, questo appartamento non esiste');

        $user = User::where('user_id', $apartment->user_id);

        /* $apartments = Apartment::where('user_id', $user->id)->pluck('id');   */

        $views = View::whereIn('apartment_id', $apartment)
        ->select('id', 'apartment_id', 'created_at')
        ->orderBy('created_at', 'desc')  // Optional: Order by creation date (desc)
        ->get()
        ->groupBy(function ($view) {
            return Carbon::parse($view->created_at)->format('M');
        });

        /* $views = View::select('id','apartment_id','created_at')->get()
        ->groupBy(function ($views){
           return Carbon::parse($views->created_at)->format('M');
        }); */
        $months = [];
        $monthCount = [];
        foreach($views as $month => $values){
            $months[] = $month;
            $monthCount[] = count($values);
        }

        

        return view('admin.apartments.show', compact('apartment','views','months','monthCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        if (Auth::user()->id != $apartment->user_id)
        return redirect()->route('admin.apartments.index', compact('apartment'))->with('warning', 'Ci dispiace, questo appartamento non esiste');

        $user = User::where('user_id', $apartment->user_id);
        $services = Service::all();
        $categories = Category::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.edit', compact('apartment', 'services', 'categories', 'sponsorships'));
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
        $apartment->slug = Str::slug($request->name . Str::random(10));

        $apartment->visible = $request->has('visible') ? 1 : 0;

        $apartment->services()->sync($request->services);
        $apartment->categories()->sync($request->categories);
        $apartment->sponsorships()->sync($request->sponsorships);


        $apartment->save();
        return redirect()->route('admin.apartments.show', compact('apartment'))->with('success', 'Annuncio aggiornato con successo');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('success', 'Annuncio eliminato con successo');
    }
}
