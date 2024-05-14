@extends('layouts.app')

@section('content')

<div class="container py-5">
      
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.apartments.index')}}" class="text-black">I tuoi appartamenti</a></li>
        <li class="breadcrumb-item active" aria-current="page">Affitta appartamento</li>
      </ol>
    </nav>

    <h1 class="mb-3">Affitta appartamento</h1>

    <form action="{{ route('admin.apartments.store')}}" method="POST" class="py-5">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" placeholder="Nome appartamento">
            <label for="name">Nome appartamento</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="address" placeholder="0" min="0" max="500">
            <label for="address">Indirizzo</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="room_number" placeholder="0" min="0" max="10">
            <label for="room_number">Numero di stanze</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="bed_number" placeholder="0" min="0" max="20">
            <label for="bed_number">Numero di posti letto</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="bathroom_number" placeholder="0" min="0" max="5">
            <label for="bathroom_number">Numero di bagni</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="square_meters" placeholder="0" min="0" max="500">
            <label for="square_meters">Metri quadrati</label>
        </div>

        <button type="submit" class="btn btn-danger button-red mt-3">Affitta</button>

    </form>
    
</div>

@endsection