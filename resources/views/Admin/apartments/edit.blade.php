@extends('layouts.app')

@section('content')

<div class="container py-5">
      
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.apartments.index')}}" class="text-black">I tuoi appartamenti</a></li>
        <li class="breadcrumb-item active" aria-current="page">Modifica appartamento</li>
      </ol>
    </nav>

    <h1 class="mb-3">Modifica appartamento</h1>

    {{-- form --}}
    <form action="{{ route('admin.apartments.update', $apartment )}}" method="POST" class="py-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- nome appartamento--}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nome appartamento" value="{{ old('name') ?? $apartment->name }}">
            <label for="name" class="@error('name') text-danger @enderror">Nome appartamento</label>
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- immagine principale --}}
        <div class="mb-3">
            <label for="cover_image" class="form-label @error('cover_image') text-danger @enderror">Immagine di copertina</label>
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
            @error('cover_image')
                <div class="text-danger">
                    {{$message}}
                </div>
            @enderror
        </div>

        {{-- indirizzo --}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Indirizzo" value="{{ old('address') ?? $apartment->address }}">
            <label for="address" class="@error('address') text-danger @enderror">Indirizzo</label>
            @error('address')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- numero di stanze --}}
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('room_number') is-invalid @enderror" id="room_number" name="room_number" placeholder="0" min="0" max="10" value="{{ old('room_number') ?? $apartment->room_number }}">
            <label for="room_number" class="@error('address') text-danger @enderror">Numero di stanze</label>
            @error('room_number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- numero di letti --}}
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('bed_number') is-invalid @enderror" id="bed_number" name="bed_number" placeholder="0" min="0" max="20" value="{{ old('bed_number') ?? $apartment->bed_number }}">
            <label for="bed_number" class="@error('address') text-danger @enderror">Numero di posti letto</label>
            @error('bed_number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- numero di bagni --}}
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('bathroom_number') is-invalid @enderror" id="bathroom_number" name="bathroom_number" placeholder="0" min="0" max="5" value="{{ old('bathroom_number') ?? $apartment->bathroom_number }}">
            <label for="bathroom_number" class="@error('address') text-danger @enderror">Numero di bagni</label>
            @error('bathroom_number')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- metri quadri --}}
        <div class="form-floating mb-3">
            <input type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" name="square_meters" placeholder="0" min="0" max="500" value="{{ old('square_meters')  ?? $apartment->square_meters}}">
            <label for="square_meters" class="@error('address') text-danger @enderror">Metri quadrati</label>
            @error('square_meters')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        {{-- immagine provvisoria --}}
        {{-- <div class="form-floating mb-3">
            <input type="string" class="form-control" id="image" name="image" value="{{ old('image') }}" placeholder="https://bollbnb.com/img-default">
            <label for="image" class="form-label">Immagine di copertina</label>
        </div> --}}

        <button type="submit" class="btn btn-danger button-red mt-3">Salva modifiche</button>

    </form>
    
</div>

@endsection