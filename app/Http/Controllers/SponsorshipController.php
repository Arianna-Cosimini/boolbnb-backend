<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use App\Http\Requests\StoreSponsorshipRequest;
use App\Http\Requests\UpdateSponsorshipRequest;
use App\Models\ApartmentSponsorship;
use Carbon\Carbon;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreSponsorshipRequest $request)
    {
        $validatedData = $request->validate([
            'apartment_id' => 'required|integer',
            'sponsorship_id' => 'required|integer',
            'end_date' => 'required|date',
        ]);

        $sponsorship = new ApartmentSponsorship($validatedData);



        $endDate = Carbon::parse($sponsorship->start_date)->addDays(1);
        $sponsorship->end_date = $endDate;

        // $currentDate = date("Y-m-d H:i:s");

        // if ($sponsorship->sponsorship_id == 1) {
        //     $sponsorDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($currentDate)));
        // } else if ($sponsorship->sponsorship_id == 2) {
        //     $sponsorDate = date("Y-m-d H:i:s", strtotime('+72 hours', strtotime($currentDate)));
        // } else if ($sponsorship->sponsorship_id == 3) {
        //     $sponsorDate = date("Y-m-d H:i:s", strtotime('+144 hours', strtotime($currentDate)));
        // }

        // $sponsorship->end_date = $sponsorDate;

        $sponsorship->save();

        return redirect()->route('admin.apartments.index')->with('success', 'Sponsorship created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorshipRequest $request, Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
