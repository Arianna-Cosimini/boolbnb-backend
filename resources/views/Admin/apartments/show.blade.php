@extends('layouts.app')

@section('content')

<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.apartments.index')}}" class="text-black">I tuoi appartamenti</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $apartment->name }}</li>
        </ol>
      </nav>

      <div class="apartment-title d-flex justify-content-between">
        <h1 class="apartment-title mb-3 fs-2">{{ $apartment['name'] }}</h1>
        <div class="button-container">
          <a href="{{route('admin.apartments.show', $apartment)}}" class="btn text-color" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash-can"></i></a>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content">
    
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina appartamento</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                  Sei sicuro di voler eliminare "{{$apartment->name}}" ?
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
      </div>

    <div class="img-container w-100 mb-4">
      <img src="{{ $apartment['image'] }}" alt="{{ $apartment['name'] }}" class="w-100 object-fit-cover rounded-3" style="height: 600px">
    </div>

    <div class="left-container">
      <h2 class="mb-0 fs-4">Appartamento in {{ $apartment['address'] }}</h2>
      <p class="mb-5">{{ $apartment['room_number'] }} camere 	&middot; {{ $apartment['bed_number'] }} letti &middot; {{ $apartment['bathroom_number'] }} bagni</p>
      <p class="fw-bold">Servizi</p>   
    </div>

    

    
</div>

@endsection