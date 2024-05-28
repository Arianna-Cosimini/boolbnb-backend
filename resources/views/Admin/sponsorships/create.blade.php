@extends('layouts.app')

@section('content')

<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.sponsorships.index') }}" class="text-black">Sponsorizzazione</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nuova sponsorizzazione</li>
        </ol>
    </nav>
    <form action="{{ route('admin.sponsorships.store') }}" method="POST">
        @csrf
        <div class="my-5">
            <h1 class="mb-4 fw-medium fs-3">Nuova sponsorizzazione</h1>
        </div>
        <h2 class="mb-4 fw-medium fs-5">Seleziona annuncio</h2>
        <div class="mb-5">
            <select name="apartment_id" class="form-select">
                @foreach ($apartments as $apartment)
                    <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
                @endforeach
            </select>
        </div>
        <h2 class="mb-4 fw-medium fs-5">Seleziona piano</h2>
        <div class="row mb-5">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-4 mb-3">
                    <div class="card sponsorship-card" onclick="selectSponsorship({{ $sponsorship->id }})">
                        <div class="card-body">
                            <h6 class="card-title">{{ $sponsorship->title }}</h6>
                            @if ($sponsorship->id == 1)
                                <p class="fs-6">1 giorno</p>
                            @elseif ($sponsorship->id == 2)
                                <p class="fs-6">3 giorni</p>
                            @elseif ($sponsorship->id == 3)
                                <p class="fs-6">6 giorni</p>
                            @endif
                            <p class="fs-3">€ {{ $sponsorship->price }}</p>
                        </div>
                        <input type="radio" name="sponsorship_id" value="{{ $sponsorship->id }}" id="sponsorship-{{ $sponsorship->id }}" class="d-none">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn-container">
            <button type="submit" class="btn btn-danger button-red mt-5">Sponsorizza</button>
        </div>
    </form>
</div>

<script>
    function selectSponsorship(id) {
        // Deseleziona tutte le card
        document.querySelectorAll('.sponsorship-card').forEach(card => card.classList.remove('selected'));
        // Seleziona la card cliccata
        document.getElementById('sponsorship-' + id).checked = true;
        document.getElementById('sponsorship-' + id).closest('.sponsorship-card').classList.add('selected');
    }
</script>

<style>
    .card.selected {
        border: 1px solid #222;
        background-color: #222;
        color: white;
    }
    .card:hover {
        cursor: pointer;
        border: 1px solid #999;
    }
</style>

@endsection
