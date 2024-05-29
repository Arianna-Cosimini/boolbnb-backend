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
   
    @if (session()->has('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.apartments.create') }}" class="btn btn-danger button-red text-white">
            <i class="fas fa-plus"></i> Aggiungi
        </a>

        
        <!-- Filtro per sponsorizzazioni -->
        <form method="GET" action="{{ route('admin.apartments.index') }}">
            <div class="input-group">
                <select name="filter" class="form-select" onchange="this.form.submit()">
                    <option value="0" {{ $filter == 0 ? 'selected' : '' }}>Tutti gli appartamenti</option>
                    <option value="1" {{ $filter == 1 ? 'selected' : '' }}>Solo con sponsorizzazione</option>
                    <option value="2" {{ $filter == 2 ? 'selected' : '' }}>Solo senza sponsorizzazione</option>
                </select>
            </div>
        </form>
    </div>
    
    @if (count($apartments) > 0)

        <div class="mb-3">
            <div class="d-flex justify-content-between p-3 rounded-4 border border-2 border-black">
                <div class="left d-flex gap-3 align-items-top w-75 ps-4">
                    <div class="img-container">
                        <img src="{{ asset('ads/sponsorship_img.png') }}" class="cover-img rounded-3" style="max-width: 64px; height: 64px;" alt="">
                    </div>
                    <div class="d-flex flex-column justify-content-center ps-3">
                        <h5>Aumenta la visibilità del tuo appartamento</h5>
                        <p class="m-0">In media un appartamento sponsorizzato ha il 25% di visualizzazioni in più</p>
                    </div>
                </div>
                <div class="d-flex flex-column w-25 justify-content-center align-items-end">
                    <div>
                        <a href="{{ route('admin.sponsorships.create') }}" class="btn btn-secondary bg-black border border-2 text-white border-black">
                            Crea Sponsorizzata
                        </a>
                    </div>
                </div>            
            </div>
        </div>

        <div class="apartments-container d-flex flex-column gap-3">
            @foreach ($apartments as $apartment)
                <div class="apartment-card d-flex justify-content-between p-3 rounded-4">
                    <div class="left d-flex gap-3 align-items-top w-50">
                        <div class="img-container">
                            <img src="{{ $apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('placeholder/Placeholder.png') }}" class="cover-img rounded-3" style="max-width: 128px; height: 128px;" alt="{{ $apartment->name }}">
                        </div>
                        <div class="apartment-info d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="my-1">{{ $apartment->name }}</h5>
                                <p class="mb-0">{{ $apartment->address }}</p>
                            </div>
                            @if ($apartment->sponsorships->isNotEmpty())
                                @foreach ($apartment->sponsorships as $sponsorship)
                                <div>
                                    <p class="mb-0">Pacchetto sponsorizzata: {{ $sponsorship->title }}</p>
                                    <p class="mb-0">Sponsorizzato fino al: {{ Carbon\Carbon::parse($sponsorship->pivot->end_date)->format('d/m/Y') }}</p>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="w-25 d-flex flex-column">
                        <h6 class="my-1">Dettagli</h6>
                        <div>
                            <p class="mb-3">
                                {{ $apartment->room_number }} {{ $apartment->room_number == 1 ? 'camera' : 'camere' }} &middot; 
                                {{ $apartment->bed_number }} {{ $apartment->bed_number == 1 ? 'letto' : 'letti' }} &middot; 
                                {{ $apartment->bathroom_number }} {{ $apartment->bathroom_number == 1 ? 'bagno' : 'bagni' }}
                            </p>
                        </div>
                        <div class="d-flex align-items-center">
                            @foreach ($apartment->services->take(2) as $service)
                                <div>
                                    <img src="{{ $service->icon }}" alt="">
                                </div>
                            @endforeach
                            @if ($apartment->services->count() > 2)
                                <div>
                                    + altri {{ $apartment->services->count() - 2 }} servizi
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-column w-25 justify-content-between">
                        <p class="mt-4 mb-0 text-nowrap text-center">{{ $apartment->square_meters }} mq<sup>2</sup></p>
                        <div class="d-flex gap-3 justify-content-end align-items-end">
                            @if ($apartment->sponsorships->isNotEmpty())
                                <a href="#" class="btn btn-secondary bg-black border border-2 text-white border-black">Modifica sponsorizzazione</a>    
                            @endif
                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn btn-secondary bg-black border border-2 text-white border-black">Dettagli</a>
                        </div>
                    </div>            
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