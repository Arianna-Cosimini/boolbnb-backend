<?php

namespace App\Http\Controllers;

use App\Models\ApartmentSponsorship;
use App\Models\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }

    public function token(Request $request)
    {
        if ($request->input('apartment_id') && $request->input('sponsor_id')) {
            $apartmentId = $request->input('apartment_id');
            $sponsorId = $request->input('sponsor_id');

            $user = Auth::user();
            $apartment = $user->apartments->where('id', $apartmentId);
            if ($apartment->isEmpty() || ($sponsorId > 3 || $sponsorId <= 0)) {
                return redirect()->route('admin.sponsors.index')->with('warning', 'Ci dispiace, la pagina non esiste, riprova di nuovo.');
            }

            $clientToken = $this->gateway->clientToken()->generate();
            return view('admin.payment.payment', ['token' => $clientToken]);
        } else {
            return redirect()->route('admin.sponsors.index')->with('warning', 'Ci dispiace, la pagina non esiste, riprova di nuovo.');
        }
    }

    public function process(Request $request)
    {
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $sponsorId = $request->input('sponsor');
        $apartmentId = $request->input('apartment');
        $sponsor = Sponsorship::where('id', $sponsorId)->first();

        $status = $this->gateway->transaction()->sale([
            'amount' => $sponsor->price,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $currentDate = now();
        $currentDateMin = $currentDate->copy()->addHours($sponsor->duration);

        if ($status->success) {
            $apartment_sponsor = new ApartmentSponsorship();
            $apartment_sponsor->apartment_id = $apartmentId;
            $apartment_sponsor->sponsor_id = $sponsorId;
            $apartment_sponsor->deadline = $currentDateMin;
            $apartment_sponsor->save();

            return response()->json([
                'success' => true,
                'transaction' => $status->transaction
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $status->message
            ]);
        }
    }
}
