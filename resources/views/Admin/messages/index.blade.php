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
                    <i class="mx-2 fa-solid fa-envelope"></i>
                    Mail
                </th>
                <th scope="col" class="p-3">
                    <i class="mx-2 fa-solid fa-user"></i>
                    Mittente
                </th>
                <th scope="col" class="d-lg-table-cell p-3">
                    <i class="mx-2 fa-solid fa-message fa-sm"></i>
                    Messaggio
                </th>
                <th scope="col " class="p-3">
                    <div class="text-center">
                        <i class="mx-2 fa-solid fa-clock"></i>
                        Data invio
                    </div>
                </th>
                <th scope="col " class="p-3">
                    <div class="text-center">
                        <i class="fa-solid fa-trash-can "></i>
                        Elimina
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $message)
            <tr data-bs-toggle="modal" data-bs-target="#message-{{ $message->id }}"
                class="cursor-pointer-message">
                {{-- <td class="">{{ $message->apartment?->id}}</td> --}}
                <td class="">{{ $message->address}}</td>
                <td>{{$message->name}} {{$message->surname}}</td>
                <td class="">{{ $message->message}}</td>
                <td class="text-center"><strong>{{ date_format($message->created_at, 'd/m/Y H:i') }}</strong></td>
                <td class="d-flex justify-content-center ">
                    <a href="" class="btn button-red  text-white border border-1 border-black text-center " data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash-can text-white me-1 border-0 "></i></a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered ">
                          <div class="modal-content">
                
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina appartamento</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class=" fa-solid fa-square-xmark"></i></button>
                            </div>
                
                            <div class="modal-body">
                              Sei sicuro di voler eliminare il messaggio di {{$message->name}} {{$message->surname}} ?
                            </div>
                
                
                            <div class="modal-footer">
                
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                
                                <form action="{{route('admin.messages.destroy', $message)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                
                            </div>
                
                          </div>
                        </div>
                      </div>
                  </div>
                </td>
            </tr>

            @empty
            @endforelse
        </tbody>
        {{-- @endif --}}


@endsection