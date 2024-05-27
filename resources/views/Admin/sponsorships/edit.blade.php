@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Modifica Sponsorizzazione</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sponsorships.update', ['apartment_id' => $apartmentSponsorship->apartment_id, 'sponsorship_id' => $apartmentSponsorship->sponsorship_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="sponsorship_id" class="form-label">Sponsorizzazione</label>
            <select id="sponsorship_id" name="sponsorship_id" class="form-control">
                @foreach($sponsorships as $sponsorship)
                    <option value="{{ $sponsorship->id }}" {{ $sponsorship->id == $apartmentSponsorship->sponsorship_id ? 'selected' : '' }}>
                        {{ $sponsorship->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Data Inizio</label>
            <input type="datetime-local" id="start_date" name="start_date" class="form-control" value="{{ \Carbon\Carbon::parse($apartmentSponsorship->start_date)->format('Y-m-d\TH:i') }}">
        </div>

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</div>
@endsection