<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\NewContact;
use App\Models\Apartment;
//Models
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
  
    public function store(Request $request) {

        //validation
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'surname' => 'required',
        'address' => 'required|email',
        'message' => 'required',
        'apartment_id' => '',

    ],
    [
        'name.required' => "Devi inserire il tuo nome",
        'surname.reuqired' => "Devi inserire il tuo cognome",
        'address.required' => "Devi insiere la tua mail",
        'address.email' => "La mail inserite deve essere una vera mai, quindi contenere '@' e '.com' (o simili)",
        'message.required' => "Devi inserire un messaggio",
        
    ]);
        //check conduct if validation dosen't work
    if($validator->fails()){

        return response()->json([
            'success' => false,
            'message' => 'Error of Validation',
            'errors' => $validator->errors()->toArray(),

        ]);
    }

        //save in db
        $newMessage = new Message();
        $newMessage->fill($request->all());
        $newMessage->save();

        //send the message
        Mail::to('boolteam5@gmail.com')->send(new NewContact($newMessage));

        return response()->json([
            'success' => true,
            'message' => 'Messaggio correctly send',
            'request' => $request->all(), /* for debug */
        ]);
    }
}