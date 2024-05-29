<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Category;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

//import library Str for 
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Recupera il filtro dal request, di default mostra tutti gli appartamenti
        $filter = $request->input('filter', 0);

        // Recupera gli appartamenti dell'utente autenticato
        $query = Apartment::where('user_id', Auth::id());

        // Aggiungi le relazioni e i filtri in base al valore del filtro
        if ($filter == 1) {
            // Solo appartamenti con sponsorizzazione attiva
            $query->whereHas('sponsorships', function ($query) {
                $query->where('end_date', '>', Carbon::now());
            });
        } elseif ($filter == 2) {
            // Solo appartamenti senza sponsorizzazione attiva
            $query->whereDoesntHave('sponsorships', function ($query) {
                $query->where('end_date', '>', Carbon::now());
            });
        }

        $query->with(['services', 'sponsorships' => function ($query) {
            $query->where('end_date', '>', Carbon::now());
        }])->withCount('services');

        $apartments = $query->get();
        

        return view('admin.apartments.index', compact('apartments', 'filter'));
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

        $messages = Message::whereIn('apartment_id', $apartment)
        ->select('id', 'apartment_id', 'created_at')
        ->orderBy('created_at', 'desc')  // Optional: Order by creation date (desc)
        ->get()
        ->groupBy(function ($message) {
            return Carbon::parse($message->created_at)->format('M');
        });
        $months = [];
        $monthCount = [];
        foreach($views as $month => $values ){
            $months[] = $month;
            $monthCount[] = count($values);
        }
        
        /* $messages_no = []; */
        $messageCount=[];
        foreach($messages as $message => $value){
            /* $messages_no [] = $month; */
            $messageCount[] = count($values);
        }
        $months = array_reverse($months);
        

        return view('admin.apartments.show', compact('apartment','views','messages','months','monthCount','messageCount',));
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
