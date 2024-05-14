@extends('layouts.app')

@section('content')

<div class="container p-5">
      
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">I miei appartamenti</li>
        </ol>
      </nav>

      <h1 class="mb-4">I miei appartamenti</h1>
      <a href="{{url('admin')}}" class="btn btn-primary mb-5">Aggiungi appartamento</a>

      <div class="d-flex flex-wrap gap-4 row-gap-5">
        @foreach ($apartments as $apartment)
        <a href="{{route('admin.apartments.show', $apartment)}}" class="card-link text-decoration-none">
            <div class="card border-0" style="width: 18rem;">
                <img src="{{$apartment['image']}}" class="card-img-top card" alt="{{ $apartment->name }}">
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