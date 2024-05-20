@extends('layouts.app')

@section('content')


<h1>Tutti i messaggi ricevuti</h1>

<p>
    <ul>
        <li>
            Da: {{$message->name}} {{$message->surname}}
        </li>
        <li>
            Email: {{$message->address}}
        </li>
        <li>
            Messaggio: {{$message->message}}
        </li>
    </ul>
</p>
@endsection