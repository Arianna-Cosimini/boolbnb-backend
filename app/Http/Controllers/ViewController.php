<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Models\Apartment;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(View $view)
    {
        $user = Auth::user();

        // Recupera tutti gli appartamenti con le visualizzazioni raggruppate per mese
        $apartments = Apartment::where('user_id', Auth::id())->with(['view' => function ($query) {
            $query->select(DB::raw('count(*) as count, month(created_at) as month, apartment_id'))
                ->groupBy('month', 'apartment_id');
        }])->get();

        // Definisce i mesi
        $months = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];

        // Calcola i totali delle visualizzazioni per ogni appartamento
        $apartmentViewCounts = [];
        $apartmentMonthlyCounts = [];

        foreach ($apartments as $apartment) {
            $totalViews = 0;
            $monthlyCounts = array_fill(0, 12, 0);

            foreach ($apartment->view as $view) {
                $monthlyCounts[$view->month - 1] = $view->count;
                $totalViews += $view->count;
            }

            $apartmentViewCounts[$apartment->id] = $totalViews;
            $apartmentMonthlyCounts[$apartment->id] = $monthlyCounts;
        }

        // Passa gli appartamenti e i dati alla vista
        return view('admin.visited.index', compact('apartments', 'months', 'apartmentViewCounts', 'apartmentMonthlyCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        //
    }
}
