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

      <div class="d-flex flex-wrap gap-4">
        @foreach ($apartments as $apartment)
            <div class="card" style="width: 18rem;">
                <img src="{{$apartment['image']}}" class="card-img-top" alt="{{ $apartment->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{$apartment['name']}}</h5>
                    <a href="{{route('admin.apartments.show', $apartment)}}" class="btn btn-primary">INFO</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection