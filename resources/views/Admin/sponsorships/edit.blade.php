@extends('layouts.app')

@section('content')
<form action="{{ route('sponsorships.update', $apartmentSponsorship->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mt-5">
        <label class="mb-4 fw-medium fs-3" for="">Modifica la Sponsorizzazione del tuo BnB</label>
        <div class="d-flex gap-4">
            @foreach ($sponsorships as $sponsorship)
            <div class="form-check">
                <input type="radio" name="sponsorships[]" value="{{ $sponsorship->id }}" class="form-check-input" id="sponsorship-{{ $sponsorship->id }}"
                    {{ $apartmentSponsorship->sponsorship_id == $sponsorship->id ? 'checked' : '' }}>
                
                <label for="sponsorship-{{ $sponsorship->id }}" class="form-check-label">{{ $sponsorship->title }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-4">Aggiorna Sponsorizzazione</button>
</form>
@endsection