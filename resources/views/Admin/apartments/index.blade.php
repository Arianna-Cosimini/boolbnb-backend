@extends('layouts.app')

@section('content')

<div class="container py-5">
      
    <nav aria-label="breadcrumb" class="d-none d-md-block">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Le tue strutture</li>
      </ol>
    </nav>
    <nav class="d-block d-md-none mb-3">
        <a href="{{ route('admin.index') }}" class="text-decoration-none text-black"><i class="fa-solid fa-chevron-left me-2"></i>Indietro</a>
    </nav>

    <h1 class="mb-4 fs-2">Le tue strutture</h1>

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

    <div class="d-flex justify-content-between align-items-center mb-5">
        <a href="{{ route('admin.apartments.create') }}" class="btn btn-danger button-red text-white">
            <i class="fas fa-plus"></i> Aggiungi
        </a>

        
        <!-- Filtro per sponsorizzazioni -->
        <form method="GET" action="{{ route('admin.apartments.index') }}">
            <div class="input-group">
                <select name="filter" class="form-select" onchange="this.form.submit()">
                    <option value="0" {{ $filter == 0 ? 'selected' : '' }}>Tutte le strutture</option>
                    <option value="1" {{ $filter == 1 ? 'selected' : '' }}>Sponsorizzate</option>
                    <option value="2" {{ $filter == 2 ? 'selected' : '' }}>Non sponsorizzate</option>
                </select>
            </div>
        </form>
    </div>
    
    @if (count($apartments) > 0)

    <a href="{{ route('admin.sponsorships.create') }}" class="text-decoration-none">

        <div class="mb-3">
            <div class="d-flex justify-content-between p-3 sponsored-start text-black rounded-4 border border-2 border-black">
                <div class="left d-flex gap-3 align-items-top ps-0 ps-md-4">
                        <img src="{{ asset('ads/sponsorship_img.svg') }}" class="cover-img d-none d-md-inline-block" style="width: 40px;" alt="">
                    <div class="ps-3">
                        <h5 class="fs-6 mb-0">Aumenta la visibilità del tuo appartamento</h5>
                        <p class="m-0">In media un appartamento sponsorizzato ha il 25% di visualizzazioni in più</p>
                    </div>
                </div>        
            </div>
        </div>
    </a>

    <div class="container apartments-container d-flex flex-column gap-3">
        @foreach ($apartments as $apartment)
        <div class="row apartment-card d-flex flex-column flex-md-row p-3 rounded-4">
            <div class="left col-12 col-md-2 mb-3 mb-md-0 px-0">
                <a href="{{ route('admin.apartments.show', $apartment->slug) }}"><img src="{{ $apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('placeholder/Placeholder.png') }}" class="apartment-img w-100 rounded-3" style="height: 144px;" alt="{{ $apartment->name }}"></a>
            </div>
            <div class="right position-relative col-12 col-md-10 ps-0 ps-md-4 pe-0">
                <h6 class="my-1">{{ $apartment->name }}</h6>
                <p class="mb-0">{{ $apartment->address }}</p>

                <div class="apartment-info d-flex flex-column flex-md-row justify-content-between">
                    <div class="left-info px-0 col-12 col-md-6">
                        <div class="mb-3 text-body-secondary">
                            {{ $apartment->room_number }} {{ $apartment->room_number == 1 ? 'camera' : 'camere' }} &middot; 
                            {{ $apartment->bed_number }} {{ $apartment->bed_number == 1 ? 'letto' : 'letti' }} &middot; 
                            {{ $apartment->bathroom_number }} {{ $apartment->bathroom_number == 1 ? 'bagno' : 'bagni' }}
                        </div>
                        <div class="d-none d-md-flex gap-3 align-items-center">
                            @foreach ($apartment->services->take(2) as $service)
                                <div>
                                    <img src="{{ $service->icon }}" style="width: 32px" alt="">
                                </div>
                            @endforeach
                            @if ($apartment->services->count() > 2)
                                <div>
                                    + altri {{ $apartment->services->count() - 2 }} servizi
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="right-info col-12 px-0 mb-2 col-md-3 mt-2 mt-md-0">
                        @if ($apartment->sponsorships->isNotEmpty())
                        @foreach ($apartment->sponsorships as $sponsorship)
                        <div>
                            <p class="mb-0" style="font-size: 14px">Sponsorizzata <span class="badge rounded-pill user-select-none" style="background-color: #ff385c">{{ $sponsorship->title }}</span></p>
                            <p class="mb-0" style="font-size: 14px">Scadenza: {{ Carbon\Carbon::parse($sponsorship->pivot->end_date)->translatedFormat('d M Y') }}</p>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="d-flex justify-content-start justify-content-md-end align-items-end col-12 col-md-3 px-0 mt-2 mt-md-0">
                        <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn btn-secondary bg-black border border-2 text-white border-black">Visualizza</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
            {{-- @foreach ($apartments as $apartment)
                <div class="apartment-card d-flex justify-content-between p-3 rounded-4">
                    <div class="left d-flex">
                        <div class="img-container">
                            <img src="{{ $apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('placeholder/Placeholder.png') }}" class="apartment-img rounded-3" style="max-width: 128px; height: 128px;" alt="{{ $apartment->name }}">
                        </div>
                        <div>
                            <h5 class="my-1">{{ $apartment->name }}</h5>
                        </div>
                        <div class="apartment-info d-flex flex-column justify-content-between">
                            <div>
                                <p class="mb-0">
                                    <p class="mb-0">{{ $apartment->address }}</p>
                                    {{ $apartment->room_number }} {{ $apartment->room_number == 1 ? 'camera' : 'camere' }} &middot; 
                                    {{ $apartment->bed_number }} {{ $apartment->bed_number == 1 ? 'letto' : 'letti' }} &middot; 
                                    {{ $apartment->bathroom_number }} {{ $apartment->bathroom_number == 1 ? 'bagno' : 'bagni' }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                @foreach ($apartment->services->take(2) as $service)
                                    <div>
                                        <img src="{{ $service->icon }}" style="width: 32px" alt="">
                                    </div>
                                @endforeach
                                @if ($apartment->services->count() > 2)
                                    <div>
                                        + altri {{ $apartment->services->count() - 2 }} servizi
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="w-25 d-flex flex-column ps-4 justify-content-center">
                        @if ($apartment->sponsorships->isNotEmpty())
                                @foreach ($apartment->sponsorships as $sponsorship)
                                <div>
                                    <p class="mb-1" style="font-size: 14px">Sponsorizzata <span class="badge rounded-pill user-select-none" style="background-color: #ff385c">{{ $sponsorship->title }}</span></p>
                                    <p class="mb-2">Scadenza: {{ Carbon\Carbon::parse($sponsorship->pivot->end_date)->translatedFormat('d M Y') }}</p>
                                </div>
                                @endforeach
                            @endif
                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" class="btn button-red text-white ">Dettagli</a>
                        </div>
                    </div>            
                </div>
            @endforeach --}}
        

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