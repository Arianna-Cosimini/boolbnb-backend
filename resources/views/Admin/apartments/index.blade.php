@extends('layouts.app')

@section('content')

<div class="container py-5">
      
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">I tuoi appartamenti</li>
        </ol>
      </nav>

      <h1 class="mb-4">I tuoi appartamenti</h1>
      <a href="{{ route('admin.apartments.create') }}" class="btn btn-danger button-red text-white mb-5">
        <i class="fas fa-plus"></i> Aggiungi
      </a>
      <div class="d-flex flex-wrap gap-4 row-gap-5">
        <table class="table">
            <thead>
                <th>
                    <th scope="col" class="text-color">Nome</th>
                    <th scope="col" class="text-color">Indirizzo</th>
                    <th scope="col" class="text-color">Stanze</th>
                    <th scope="col" class="text-color">Posti letto</th>
                    <th scope="col" class="text-color">Bagni</th>
                    <th scope="col" class="text-color">Metri quadri</th>
                    <th scope="col" class="text-color"></th>
                    <th scope="col" class="text-color"></th>
                </th>
            </thead>
            <tbody>
                @foreach ($apartments as $apartment)
                <tr>
                    <th scope="row"> 
                        <img src="{{$apartment['image']}}" class="rounded-3" style="width: 50px; height:50px" alt="{{ $apartment->name }}">
                    </th>
                    <td class="align-middle">
                        {{$apartment['name']}}
                    </td>
                    <td class="align-middle">
                        {{$apartment['address']}}
                    </td>
                    <td class="align-middle">
                        {{$apartment['room_number']}}
                    </td>
                    <td class="align-middle">
                        {{$apartment['bed_number']}}
                    </td>
                    <td class="align-middle">
                        {{$apartment['bathroom_number']}}
                    </td>
                    <td class="align-middle">
                        {{$apartment['square_meters']}}
                    </td>
                    <td class="align-middle">
                        <a href="{{route('admin.apartments.show', $apartment)}}" class="btn btn-secondary bg-white border border-2 text-black border-black">Info</a>
                    </td>
                    <td class="align-middle">
                        <a href="{{route('admin.apartments.show', $apartment)}}" class="btn text-color" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash-can"></i></a>
                    </td>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered ">
                          <div class="modal-content">
                
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina appartamento</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                
                            <div class="modal-body">
                              Sei sicuro che vuoi eliminare "{{$apartment->name}}" ?
                            </div>
                
                
                            <div class="modal-footer">
                
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                                <form action="{{route('admin.apartments.destroy', $apartment)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                
                            </div>
                
                          </div>
                        </div>
                    </div>


                </tr>
                @endforeach
            </tbody>
        </table>


        {{-- <a href="{{route('admin.apartments.show', $apartment)}}" class="card-link text-decoration-none">
            <div class="card border-0" style="width: 18rem;">
                <img src="{{$apartment['image']}}" class="card-img-top card rounded-4" alt="{{ $apartment->name }}">
                <div class="card-text">
                    <p class="card-title fw-bold mt-2 mb-0">{{$apartment['name']}}</p>
                    <p>{{$apartment['address']}}</p>
                </div>
            </div>
        </a> --}}
    </div>
</div>

@endsection