<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request) {

        $user = Auth::user();

        $apartment_id = $request->input('apartment_id');

        // query to order messages
       /*  $allMessages = Message::whereHas('apartment', function($query) use($user) {
            $query->where('user_id' ,'=', $user->id)
            ->orderBy('created_at', 'desc');
        });

        if ($apartment_id){
            $allMessages = $allMessages->where('apartment_id',$apartment_id);
        }

        $allMessages = $allMessages->get();
        $allMessages = $allMessages->sortByDesc('created_at');

        $apartments = Apartment::where('user_id',$user->id)->get(); */
        $allMessages = Message::all();
        $apartments = Apartment::all();
        return view('admin.messages.index', (compact('allMessages','apartments')));
/*             'allMessages' => $allMessages,
            'apartments' => $apartments,
            'apartment_id_used' => $apartment_id,

        ]);
 */

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
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
