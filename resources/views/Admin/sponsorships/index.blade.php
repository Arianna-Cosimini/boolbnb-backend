@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">I tuoi annunci con sponsorizzazioni attive</li>
        </ol>
    </nav>

    <h1 class="mb-4 fs-2">I tuoi annunci con sponsorizzazioni attive</h1>

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

    <a href="{{ route('admin.sponsorships.create') }}" class="btn btn-danger button-red text-white mb-5">
        <i class="fas fa-plus"></i> Aggiungi
    </a>

    @if (count($apartments) > 0)
        <div class="apartments-container d-flex flex-column gap-3">
            @foreach ($apartments as $apartment)
                @foreach ($apartment->sponsorships as $sponsorship)
                    @if(\Carbon\Carbon::parse($sponsorship->pivot->end_date)->isFuture())
                        <div class="apartment-card d-flex justify-content-between align-items-center p-3 rounded-4">
                            <div class="left d-flex gap-3 align-items-center w-50">
                                <div class="img-container">
                                    <img src="{{ $apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('placeholder/Placeholder.png') }}" class="cover-img rounded-3" style="max-width: 64px; height: 64px;" alt="{{ $apartment->name }}">
                                </div>
                                <div class="apartment-info">
                                    <h6 class="mb-0">{{ $apartment->name }}</h6>
                                    <p class="mb-0">{{ $apartment->address }}</p>
                                    <p class="mb-0">Sponsorizzazione attiva fino a: {{ $sponsorship->pivot->end_date }}</p>
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
                    @endif
                @endforeach
            @endforeach
        </div>
    @endif

</div>
@endsection