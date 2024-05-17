@extends('layouts.app')

@section('content')

<div class="container py-5">
      
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">I tuoi annunci</li>
      </ol>
    </nav>

    <h1 class="mb-4 fs-2">I tuoi annunci</h1>

    @if(session('success'))
      <div class="alert alert-success">
      {{ session('success') }}
      </div>
    @endif
   

    @if (count($apartments) > 0)

    <a href="{{ route('admin.apartments.create') }}" class="btn btn-danger button-red text-white mb-5">
        <i class="fas fa-plus"></i> Aggiungi
      </a>

      <div class="apartments-container d-flex flex-column gap-3">
        @foreach ($apartments as $apartment)
            <div class="apartment-card d-flex justify-content-between align-items-center p-3 rounded-4">
                <div class="left d-flex gap-3 align-items-center w-50">
                    <div class="img-container">
                        <img src="{{ $apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('placeholder/Placeholder.svg') }}" class="cover-img rounded-3" style="max-width: 64px; height: 64px;" alt="{{ $apartment->name }}">
                    </div>
                    <div class="apartment-info">
                        <h6 class="mb-0">{{ $apartment->name }}</h6>
                        <p class="mb-0">{{ $apartment->address }}</p>
                    </div>
                </div>
    
                <p class="mb-0 w-25">
                    {{ $apartment->room_number }} {{ $apartment->room_number == 1 ? 'camera' : 'camere' }} &middot; 
                    {{ $apartment->bed_number }} {{ $apartment->bed_number == 1 ? 'letto' : 'letti' }} &middot; 
                    {{ $apartment->bathroom_number }} {{ $apartment->bathroom_number == 1 ? 'bagno' : 'bagni' }}
                </p>            
                <p class="mb-0 w-25">{{ $apartment->square_meters }} metri quadri</p>
                <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn btn-secondary bg-black border border-2 text-white border-black">Dettagli</a>
            </div>
        @endforeach
    </div>

    @else
    <div class="no-apartments d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center gap-2 align-items-center fs-4 mt-5 mb-4">
            {{-- <i class="fa-solid fa-house"></i>  --}}
            <img src="https://a0.muscache.com/pictures/87444596-1857-4437-9667-4f9cb4f5baf2.jpg" class="w-25" alt="">
            <p class="m-0 fw-semibold fs-6">Non hai ancora annunci</p>
            <p class="fs-6 text-black-50">Crea un annuncio con Airbnb Start e inizia a ricevere prenotazioni.</p>
        </div>
    
        <div class="add-button">
            <a href="{{ route('admin.apartments.create') }}" class="btn btn-lg border border-black  text-black">
               Inizia
            </a>
        </div>
    </div>
    @endif

</div>

@endsection