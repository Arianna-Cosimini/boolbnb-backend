@extends('layouts.app')

@section('content')

<div class="container py-5">
      
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">I tuoi appartamenti</li>
        </ol>
      </nav>

      <h1 class="mb-4">I tuoi appartamenti</h1>
      <a href="{{route('admin.apartments.create')}}" class="btn btn-danger button-red text-white mb-5">Affitta appartamento</a>

      <div class="d-flex flex-wrap gap-4 row-gap-5">
        @foreach ($apartments as $apartment)
        <a href="{{route('admin.apartments.show', $apartment)}}" class="card-link text-decoration-none">
            <div class="card border-0" style="width: 18rem;">
                <img src="{{$apartment['image']}}" class="card-img-top card rounded-4" alt="{{ $apartment->name }}">
                <div class="card-text">
                    <p class="card-title fw-bold mt-2 mb-0">{{$apartment['name']}}</p>
                    <p>{{$apartment['address']}}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection