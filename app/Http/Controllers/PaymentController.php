<?php

namespace App\Http\Controllers;

use App\Models\ApartmentSponsorship;
use App\Models\Sponsorship;
use Braintree\Exception;
use Braintree\Gateway;
use Braintree\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function token(Request $request)
    {
        if (request()->input('apartment_id') && request()->input('sponsor_id')) {
            $apartmentId = request()->input('apartment_id');
            $sponsorId = request()->input('sponsor_id');

            $user = Auth::user();
            // $apartment = Apartment::where('id', $apartmentId)->get();
            $apartment = $user->apartments->where('id', $apartmentId);
            if ($apartment->isEmpty() || ($sponsorId > 3 || $sponsorId <= 0)) {
                return redirect()->route('admin.sponsorships.index')->with('warning', 'Ci dispiace, la pagina non esiste, riprova di nuovo.');
            }

                    // Debugging environment variables
        $environment = env("BRAINTREE_ENV");
        $merchantId = env("BRAINTREE_MERCHANT_ID");
        $publicKey = env("BRAINTREE_PUBLIC_KEY");
        $privateKey = env("BRAINTREE_PRIVATE_KEY");

        // Print the environment variables to verify they are being loaded correctly
        dd($environment, $merchantId, $publicKey, $privateKey);

            $gateway = new \Braintree\Gateway([
                'environment' => env("BRAINTREE_ENV"),
                'merchantId' => env("BRAINTREE_MERCHANT_ID"),
                'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
                'privateKey' => env("BRAINTREE_PRIVATE_KEY")
            ]);
            $clientToken = $gateway->clientToken()->generate();
            return view('admin.payment.payment', ['token' => $clientToken]);
        } else {
            return redirect()->route('admin.sponsorships.index')->with('warning', 'Ci dispiace, la pagina non esiste, riprova di nuovo.');
        }
    }


    public function process(Request $request)
    {
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $sponsorId = request()->input('sponsor');
        // echo $sponsorId;
        $apartmentId = request()->input('apartment');
        $sponsor = Sponsorship::where('id', $sponsorId)->first();

        if ($sponsor) {
            $status = Transaction::sale([
                
                'amount' => $sponsor->price,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
        } else {
            // Gestire il caso in cui $sponsor è null
            // Ad esempio, restituire un errore o eseguire un'altra logica
        }

        $currentDate = date("Y-m-d H:i:s");
        $currentDateMin = date("Y-m-d H:i:s", strtotime('+' . $sponsor->duration . 'hours', strtotime($currentDate)));



        if ($status) {
            $apartment_sponsor = new ApartmentSponsorship();
            $apartment_sponsor->apartment_id = $apartmentId;
            $apartment_sponsor->sponsor_id = $sponsorId;
            $apartment_sponsor->deadline = $currentDateMin;
            $apartment_sponsor->save();
        }

        return response()->json($status);
    }
}
