<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\NewContact;
use App\Models\Apartment;
// Models
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required|email',
            'message' => 'required',
            'apartment_id' => 'nullable|exists:apartments,id',
        ], [
            'name.required' => "Devi inserire il tuo nome",
            'surname.required' => "Devi inserire il tuo cognome",
            'address.required' => "Devi inserire la tua mail",
            'address.email' => "La mail inserita deve essere una vera mail, quindi contenere '@' e '.com' (o simili)",
            'message.required' => "Devi inserire un messaggio",
        ]);

        // check conduct if validation doesn't work
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error of Validation',
                'errors' => $validator->errors()->toArray(),
            ]);
        }

        // save in db
        $newMessage = new Message();
        $newMessage->fill($request->all());
        if ($request->has('apartment_id')) {
            $newMessage->apartment_id = $request->input('apartment_id');
        }
        $newMessage->save();

        // send the message
        Mail::to('boolteam5@gmail.com')->send(new NewContact($newMessage));

        return response()->json([
            'success' => true,
            'message' => 'Messaggio correctly sent',
            'request' => $request->all(), /* for debug */
        ]);
    }

    public function index()
    {
        // Get messages ordered by created_at in descending order
        $messages = Message::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    public function show($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        return response()->json($message);
    }
}
