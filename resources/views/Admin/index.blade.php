@extends('layouts.app')
@section('content')

<div class="container py-5">
    <ol class="breadcrumb mb-5">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
      
      <div class="cover w-100 d-flex flex-column-reverse bg-body-secondary p-5 rounded-4 position-relative" style="height: 350px;">
        <div class="background-image position-absolute w-100 h-100" style="background-image: url('./Illustration_cover.webp'); background-size: cover; filter: brightness(0.8); top: 0; left: 0; z-index: 0; border-radius: 0.5rem;"></div>

        <div class="content position-relative">
          <h1 class="fs-1 fw-light mb-0 text-white">Ciao</h1>
          <span class="display-2 text-white">{{ Auth::user()->name }}</span>
        </div>
    </div>
    
    <div class="features mt-5">
      <div class="feature-item mb-5">
          <h2 class="h4">Le tue Strutture</h2>
          <p>Qui puoi gestire tutte le tue Strutture.<br> Modifica, elimina o aggiungi nuovi appartamenti da affittare su Boolbnb.</p>
          <a href="{{ route('admin.apartments.index') }}" class="btn button-black text-white">Strutture</a>
      </div>
      <div class="feature-item mb-5">
          <h2 class="h4">I tuoi Messaggi</h2>
          <p>Visualizza e rispondi ai messaggi ricevuti dai visitatori interessati ai tuoi appartamenti.</p>
          <a href="{{ route('admin.messages.index') }}" class="btn button-black text-white">Messaggi</a>
      </div>
     
      <div class="feature-item">
        <h2 class="h4">Le tue Statistiche</h2>
        <p>Guarda come procede la visualizzazione totale dei tuoi appatamenti</p>
        <a href="{{ route('admin.visited.index') }}" class="btn button-black text-white">Statistiche</a>
    </div>
  </div>
  
</div>


<div class="container d-flex align-items-center justify-content-center ">

  <div class="alert border-1 border-black my-bg-opacity" role="alert">
    <div class="p-4">

      <div class="circle d-flex justify-content-center align-content-center mb-2">
        <i class="fa-solid fa-check check"></i>
      </div>
      <h4 class="alert-heading">Congratulazioni! <br>La tua sponsorizzazione è avvenuta con successo.</h4>
  
      <p>Ora il tuo appartamento avrà una visibilità maggiore del 25%</p>
    
      <a href="{{route('admin.index')}}" type="button" class="btn my-btn">Torna alla Home</a>
    </div>
    
    
    </div>
      
  </div>
  
</div>
@endsection

@section('style')
<style lang="scss">
  .circle{
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background-color: #ff385c;
    position: relative;
  }
  .check{
   font-size: 110px;
   position: absolute;
   bottom: 0px;
   left: 10px;
   color: white;
  }
  .my-bg-opacity{
  background-color: rgb(0, 0, 0, .3);
  
 }
 .my-bg{
  background-color: #ff385c;
 }
 .my-btn{
  background-color: #ff385c;
  color: white;
  transition: 0.3 ease;
 }
 .my-btn:hover{
  background-color: #ff385c;
  color: white;
  transform: scale(1.1);
 }
 

</style>
@endsection
