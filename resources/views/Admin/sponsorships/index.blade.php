@extends('layouts.app')

@section('content')
<div class="container py-5">
    <ol class="breadcrumb mb-5">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
      
    <h1>Sponsorizzazioni degli Appartamenti</h1>
    <div class="feature-item">
        <h2 class="h4">Gestione Sponsorizzate</h2>
        <p>Sponsorizza il tuo appartamento in modo da avere più visibilità.</p>
        <a href="{{ route('admin.sponsorships.create') }}" class="btn button-black text-white">Crea una sponsorizzata</a>
    </div>
  </div>
</div>

@endsection