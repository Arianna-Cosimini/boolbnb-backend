<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use App\Http\Requests\StoreSponsorshipRequest;
use App\Http\Requests\UpdateSponsorshipRequest;
use App\Models\Apartment;
use App\Models\ApartmentSponsorship;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        $apartmentSponsorships = ApartmentSponsorship::with(['apartments', 'sponsorships'])->get();
        $sponsorships = Sponsorship::all();

        return view('admin.sponsorships.index', compact('apartments', 'apartmentSponsorships', 'sponsorships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sponsorships = Sponsorship::all();

        $apartments = Apartment::where('user_id', Auth::id())->get();


        return view('admin.sponsorships.create', compact('sponsorships', 'apartments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorshipRequest $request)
    {
        $apartmentId = $request->input('apartment_id');
        $sponsorshipId = $request->input('sponsorships')[0];

        $currentDate = Carbon::now();
        $endDate = null;

        switch ($sponsorshipId) {
            case 1:
                $endDate = $currentDate->copy()->addHours(24);
                break;
            case 2:
                $endDate = $currentDate->copy()->addHours(72);
                break;
            case 3:
                $endDate = $currentDate->copy()->addHours(144);
                break;
        }

        // Creare un nuovo record di ApartmentSponsorship
        $newSponsorship = new ApartmentSponsorship();
        $newSponsorship->apartment_id = $apartmentId;
        $newSponsorship->sponsorship_id = $sponsorshipId;
        $newSponsorship->start_date = $currentDate;
        $newSponsorship->end_date = $endDate;
        $newSponsorship->save();

        return redirect()->back()->with('success', 'Sponsorship added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ApartmentSponsorship $apartmentSponsorship)
    {
        return view('admin.sponsorships.show', compact('apartmentSponsorship'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApartmentSponsorship $apartmentSponsorship)
    {
        $sponsorships = Sponsorship::all();

        return view('admin.sponsorships.edit', compact('apartmentSponsorship', 'sponsorships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorshipRequest $request, ApartmentSponsorship $apartmentSponsorship)
    {
        $sponsorshipId = $request->input('sponsorships')[0];
        $currentDate = Carbon::now();
        $endDate = null;

        switch ($sponsorshipId) {
            case 1:
                $endDate = $currentDate->copy()->addHours(24);
                break;
            case 2:
                $endDate = $currentDate->copy()->addHours(72);
                break;
            case 3:
                $endDate = $currentDate->copy()->addHours(144);
                break;
        }

        $apartmentSponsorship->sponsorship_id = $sponsorshipId;
        $apartmentSponsorship->start_date = $currentDate;
        $apartmentSponsorship->end_date = $endDate;
        $apartmentSponsorship->save();

        return redirect()->route('admin.sponsorships.edit', $apartmentSponsorship->id)->with('success', 'Sponsorship updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
