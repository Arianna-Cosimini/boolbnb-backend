@extends('layouts.app')

@section('content')
<div id="messages_index" class="container-fluid mt-4">
    <div class="row row-cols-1 mb-5">
        <div class="col py-3">
            <h1>
                <span class="icon-section me-2">
                    <i class="fa-solid fa-message fa-sm"></i>
                </span>
                I miei messaggi
            </h1>
        </div>

    </div>
  {{--   @if ($allMessages->isNotEmpty()) --}}
    <table class="table my-4 ">
        <thead>
            <tr>
                <th scope="col" class="d-none d-sm-table-cell rounded-top-start p-3">
                    <i class="fa-solid fa-envelope"></i>
                    Mail
                </th>
                <th scope="col" class="p-3">
                    <i class="fa-solid fa-user"></i>
                    Mittente
                </th>
                <th scope="col" class="d-lg-table-cell p-3">
                    <i class="fa-solid fa-message fa-sm"></i>
                    Messaggio
                </th>
                <th scope="col " class="p-3">
                    <div class="text-center">
                        <i class="fa-solid fa-clock"></i>
                        Data invio
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allMessages as $message)
            <tr data-bs-toggle="modal" data-bs-target="#message-{{ $message->id }}"
                class="cursor-pointer-message">
                {{-- <td class="">{{ $message->apartment?->id}}</td> --}}
                <td class="">{{ $message->address}}</td>
                <td>{{$message->name}} {{$message->surname}}</td>
                <td class="">{{ $message->message}}</td>
                <td class="text-center"><strong>{{ date_format($message->created_at, 'd/m/Y H:i') }}</strong></td>
            </tr>

            @empty
            @endforelse
        </tbody>
        {{-- @endif --}}


@endsection