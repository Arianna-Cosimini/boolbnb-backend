@extends('layouts.app')

@section('content')
<div class="container py-5">
   
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Sponsorizzazioni</li>
        </ol>
    </nav>
      
    <h1 class="mb-4 fs-2">Sponsorizzazioni</h1>
    <div class="feature-item">
        <p>Sponsorizza il tuo appartamento e raggiungi più facilmente il tuo pubblico.</p>
        <a href="{{ route('admin.sponsorships.create') }}" class="btn button-black text-white">Crea una sponsorizzata</a>
    </div>
  </div>
</div>

@endsection