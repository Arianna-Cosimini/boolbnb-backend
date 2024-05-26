@extends('layouts.app')

@section('content')
<form action="{{ route('admin.sponsorships.store') }}" method="POST">
    @csrf
    <div class="mt-5">
        <label class="mb-4 fw-medium fs-3" for="">Vuoi Sponsorizzare il tuo BnB?</label>
        <div class="d-flex gap-4 mb-5">
            @foreach ($sponsorships as $sponsorship)
            <div class="form-check">
                <input type="radio" name="sponsorships[]" value="{{ $sponsorship->id }}" class="form-check-input" id="sponsorship-{{ $sponsorship->id }}"
                    {{ in_array($sponsorship->id, old('sponsorships', [])) ? 'checked' : '' }}>
                
                <label for="sponsorship-{{ $sponsorship->id }}" class="form-check-label">{{ $sponsorship->title }}</label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex gap-4">
        @foreach ($apartments as $apartment)
            <div class="form-check">
                <input type="radio" class="form-check-input" name="apartment_id" value="{{ $apartment->id }}">
                <label for="apartment-{{ $apartment->id }}" class="form-check-label">{{$apartment->name}}</label>
            </div>
        @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Sponsorizza</button>
</form>
@endsection