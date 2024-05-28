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
        // Recupera gli appartamenti dell'utente autenticato con sponsorizzazioni attive
        $apartments = Apartment::where('user_id', Auth::id())
            ->whereHas('sponsorships', function ($query) {
                $query->where('end_date', '>', Carbon::now());
            })
            ->with(['sponsorships' => function ($query) {
                $query->where('end_date', '>', Carbon::now());
            }])
            ->get();


        return view('admin.sponsorships.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sponsorships = Sponsorship::all();
        $apartments = Apartment::where('user_id', Auth::id())
            ->whereDoesntHave('sponsorships', function ($query) {
                $query->where('end_date', '>', Carbon::now());
            })->get();

        // Configurazione di Braintree
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        // Generazione del client token
        $clientToken = $gateway->clientToken()->generate();

        // Debug del token
        // dd($clientToken);

        return view('admin.sponsorships.create', compact('sponsorships', 'apartments', 'clientToken'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorshipRequest $request)
    {
        // Ottenere i dati dalla richiesta
        $data = $request->validated();

        // Verifica se esiste già una sponsorizzazione attiva per l'appartamento specificato
        $existingSponsorship = ApartmentSponsorship::where('apartment_id', $data['apartment_id'])
            ->where('end_date', '>', Carbon::now())
            ->first();

        if ($existingSponsorship) {
            return back()->withErrors('Esiste già una sponsorizzazione attiva per questo appartamento.');
        }

        // Calcolare il prezzo in base alla sponsorizzazione selezionata
        $sponsorshipPrice = $this->calculateSponsorshipPrice($data['sponsorships'][0]);

        // Configurazione di Braintree
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        // Creazione del nonce del cliente
        $nonce = $request->payment_method_nonce;

        // Creazione della transazione
        $result = $gateway->transaction()->sale([
            'amount' => $sponsorshipPrice,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // Creare un nuovo record di ApartmentSponsorship
            $newSponsorship = new ApartmentSponsorship();
            $newSponsorship->apartment_id = $data['apartment_id'];
            $newSponsorship->sponsorship_id = $data['sponsorships'][0];
            $newSponsorship->start_date = Carbon::now();
            $newSponsorship->end_date = $this->calculateEndDate($data['sponsorships'][0]);
            $newSponsorship->save();

            return redirect()->route('admin.sponsorships.index')->with('success', 'Sponsorizzazione creata con successo.');
        } else {
            // Gestire l'errore di transazione
            return back()->withErrors('La transazione non è riuscita: ' . $result->message);
        }
    }

    /**
     * Calcola il prezzo della sponsorizzazione in base all'ID della sponsorizzazione.
     */
    private function calculateSponsorshipPrice($sponsorshipId)
    {
        // Implementa la logica per calcolare il prezzo in base all'ID della sponsorizzazione
        // Questo è solo un esempio, sostituiscilo con la tua logica effettiva
        switch ($sponsorshipId) {
            case 1:
                return 10.00; // Prezzo per la sponsorizzazione 1
            case 2:
                return 20.00; // Prezzo per la sponsorizzazione 2
            case 3:
                return 30.00; // Prezzo per la sponsorizzazione 3
            default:
                return 0.00; // Prezzo predefinito nel caso di ID non valido
        }
    }

    /**
     * Calcola la data di fine sponsorizzazione in base all'ID della sponsorizzazione.
     */
    private function calculateEndDate($sponsorshipId)
    {
        // Implementa la logica per calcolare la data di fine sponsorizzazione
        // in base all'ID della sponsorizzazione
        // Questo è solo un esempio, sostituiscilo con la tua logica effettiva
        $currentDate = Carbon::now();
        switch ($sponsorshipId) {
            case 1:
                return $currentDate->copy()->addHours(24); // Durata di 24 ore
            case 2:
                return $currentDate->copy()->addHours(72); // Durata di 72 ore
            case 3:
                return $currentDate->copy()->addHours(144); // Durata di 144 ore (6 giorni)
            default:
                return null;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(ApartmentSponsorship $apartmentSponsorship)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($apartment_id, $sponsorship_id)
    {
        $apartmentSponsorship = ApartmentSponsorship::where('apartment_id', $apartment_id)
            ->where('sponsorship_id', $sponsorship_id)
            ->firstOrFail();
        $sponsorships = Sponsorship::all();

        dd($apartmentSponsorship);

        return view('admin.sponsorships.edit', compact('apartmentSponsorship', 'sponsorships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorshipRequest $request, $apartment_id, $sponsorship_id)
    {
        $apartmentSponsorship = ApartmentSponsorship::where('apartment_id', $apartment_id)
            ->where('sponsorship_id', $sponsorship_id)
            ->firstOrFail();

        $sponsorshipId = $request->input('sponsorship_id');
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

        $apartmentSponsorship->start_date = $request->input('start_date', $currentDate);
        $apartmentSponsorship->end_date = $endDate;
        $apartmentSponsorship->sponsorship_id = $sponsorshipId;

        $apartmentSponsorship->save();

        return redirect()->route('admin.sponsorships.index')->with('success', 'Sponsorship updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
