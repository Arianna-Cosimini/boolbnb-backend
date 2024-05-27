@extends('layouts.app')

@section('content')
<div class="container py-5">
   
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Sponsorizzazioni</li>
        </ol>
    </nav>
      
    <h1>Sponsorizzazioni degli Appartamenti</h1>
    @foreach($sponsorships as $sponsorship)
    <div class="feature-item">
        <h2 class="h4">Gestione Sponsorizzate</h2>
        <p>Sponsorizza il tuo appartamento in modo da avere più visibilità.</p>
        <a href="{{ route('admin.sponsorships.show'), $sponsorship->id}}" class="btn button-black text-white">Crea una sponsorizzata</a>
    </div>
    @endforeach
    <div class="feature-item">
        <h2 class="h4">Gestione Sponsorizzate</h2>
        <p>Sponsorizza il tuo appartamento in modo da avere più visibilità.</p>
        <a href="{{ route('admin.sponsorships.create') }}" class="btn button-black text-white">Crea una sponsorizzata</a>
    </div>
  </div>
</div>

@endsection