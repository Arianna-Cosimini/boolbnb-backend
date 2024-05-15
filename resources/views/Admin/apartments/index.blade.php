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
   

    @if (count($apartments) > 0)

    <a href="{{ route('admin.apartments.create') }}" class="btn btn-danger button-red text-white mb-5">
        <i class="fas fa-plus"></i> Aggiungi
      </a>

      <div class="apartments-container d-flex flex-column gap-3">
      @foreach ($apartments as $apartment)
        <div class="apartment-card d-flex justify-content-between align-items-center p-3 rounded-4">
            <div class="left d-flex gap-3 align-items-center w-50">
                <img src="{{asset('storage/' . $apartment->cover_image)}}"  class="rounded-3" style="width: 64px; height:64px" alt="{{ $apartment->name }}">
                <div class="apartment-info">
                    <h6 class="mb-0">{{ $apartment['name'] }}</h6>
                    <p class="mb-0">{{ $apartment['address'] }}</p>
                </div>
            </div>

            <p class="mb-0 w-25">
                {{ $apartment['room_number'] }} {{ $apartment['room_number'] == 1 ? 'camera' : 'camere' }} &middot; 
                {{ $apartment['bed_number'] }} {{ $apartment['bed_number'] == 1 ? 'letto' : 'letti' }} &middot; 
                {{ $apartment['bathroom_number'] }} {{ $apartment['bathroom_number'] == 1 ? 'bagno' : 'bagni' }}
            </p>            
            <p class="mb-0 w-25">{{ $apartment['square_meters'] }} metri quadri</p>
            <a href="{{route('admin.apartments.show', $apartment)}}" class="btn btn-secondary bg-black border border-2 text-white border-black">Dettagli</a>
        </div>
      @endforeach
    </div>

    @else
    <div class="no-apartments d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center gap-2 align-items-center fs-4 mt-5 mb-4">
            <i class="fa-solid fa-house"></i> 
            <p class="m-0">Non ci sono appartamenti registrati</p>
        </div>
    
        <div class="add-button">
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-danger button-red text-white">
               <i class="fas fa-plus"></i> Aggiungi
            </a>
        </div>
    </div>
    @endif

</div>

@endsection