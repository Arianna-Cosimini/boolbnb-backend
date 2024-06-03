@extends('layouts.app')
@section('content')

<div class="container py-5">
    <ol class="breadcrumb mb-5">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
      
      <div class="cover w-100 d-flex flex-column-reverse bg-body-secondary p-4 p-md-5 rounded-4 position-relative" style="height: 350px;">
        <div class="background-image position-absolute w-100 h-100" style="background-image: url('./Illustration_cover.webp'); background-size: cover; filter: brightness(0.8); top: 0; left: 0; z-index: 0; border-radius: 0.5rem;"></div>

        <div class="content position-relative">
          <h1 class="fs-1 fw-light mb-0 text-white">Ciao</h1>
          <span class="display-2 text-white">{{ Auth::user()->name }}</span>
        </div>
    </div>
    
    <div class="features mt-5">
      <div class="feature-item mb-5">
          <h2 class="h4">Le tue strutture</h2>
          <p>Gestisci tutte le tue proprietà da un unico posto.<br> Metti in affitto la tua struttura!</p>
          <a href="{{ route('admin.apartments.index') }}" class="btn button-black text-white">Vai alle strutture</a>
      </div>
      <div class="feature-item mb-5">
          <h2 class="h4">I tuoi messaggi</h2>
          <p>Controlla e rispondi ai messaggi dei visitatori interessati alle tue proprietà.</p>
          <a href="{{ route('admin.messages.index') }}" class="btn button-black text-white">Vai ai messaggi</a>
      </div>
     
      <div class="feature-item">
        <h2 class="h4">Le tue statistiche</h2>
        <p>Monitora le visualizzazioni dei tuoi appartamenti e analizza le performance.</p>
        <a href="{{ route('admin.visited.index') }}" class="btn button-black text-white">Vai alle statistiche</a>
    </div>
  </div>
  
</div>


@endsection