@extends('layouts.app')

@section('content')

<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.apartments.index')}}" class="text-black">I tuoi annunci</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $apartment->name }}</li>
        </ol>
      </nav>

      <div class="apartment-title d-flex justify-content-between align-items-end mb-4">
        <h1 class="fs-3 mb-0">{{ $apartment['name'] }}</h1>
        <div class="button-container d-flex gap-2 align-items-center">
          <a href="{{ route('admin.apartments.edit', $apartment->slug) }}" class="btn bg-black text-white border border-1 border-black">
            <i class="fa-solid fa-pen-to-square text-white"></i> Modifica
          </a>
          <a href="{{route('admin.apartments.show', $apartment)}}" class="btn bg-white text-black border border-1 border-black" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash-can text-color me-1"></i>Elimina</a>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content">
    
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina appartamento</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                  Sei sicuro di voler eliminare "{{$apartment->name}}" ?
                </div>
    
    
                <div class="modal-footer">
    
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
    
                    <form action="{{route('admin.apartments.destroy', $apartment)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
    
                </div>
    
              </div>
            </div>
          </div>
      </div>
      <div class="d-flex justify-content-end ">
        @if ($apartment->visible == 1)
        <p class="button-red text-white rounded-3 p-2">
        Acquistabile
        </p>
        @elseif ($apartment->visible == 0)
        <p class="button-red text-white rounded-3 p-2">
        Non Acquistabile
       </p> 
        @endif
      </div>

    <div class="img-container w-100 mb-4">
      <img src="{{ $apartment->cover_image ? asset('storage/' . $apartment->cover_image) : asset('placeholder/Placeholder.svg') }}" alt="{{ $apartment['name'] }}" class="w-100 object-fit-cover rounded-3" style="height: 600px">
    </div>

    <div class="left-container">
      <h2 class="mb-0 fs-4">Appartamento in {{ $apartment['address'] }}</h2>
      <p class="mb-5">
        {{ $apartment['room_number'] }} {{ $apartment['room_number'] == 1 ? 'camera' : 'camere' }} &middot; 
        {{ $apartment['bed_number'] }} {{ $apartment['bed_number'] == 1 ? 'letto' : 'letti' }} &middot; 
        {{ $apartment['bathroom_number'] }} {{ $apartment['bathroom_number'] == 1 ? 'bagno' : 'bagni' }}
      </p>    
      
      <div class="mb-4">
        <label class="mb-3 fw-medium fs-4">Cosa troverai</label>
        <div class="row row-cols-1 d-flex gap-3">
            @foreach($apartment->services as $key => $service)
                <div class="col-2 d-flex flex-wrap gap-2 align-items-center">
                    <i class="{{ $service->icon }} fs-5"></i>
                    <span>{{ $service->title }}</span>
                </div>
    
                @if(($key + 1) % 2 == 0)
                    {{-- Aggiungi un div con classe w-100 per andare a capo --}}
                    <div class="w-100"></div>
                @endif
            @endforeach
        </div>
    </div>


      {{-- <p class="fw-bold">Servizi</p> 
      <div class="d-flex gap-2 mb-5 justify-content-center">
          @foreach ($apartment->services as $service)
          <div class="d-flex flex-column justify-content-center align-items-center p-3 border border-black rounded-2">
            <i class="{{$service->icon}}"></i>
            <span>{{$service->title}}</span>
          </div>
          @endforeach
      </div>  
      <p class="fw-bold">Categorie</p> 
      <div class="d-flex gap-2 mb-5 justify-content-center">
          @foreach ($apartment->categories as $category)
              <div class="d-flex flex-column justify-content-center align-items-center p-3 border border-black rounded-2">
                <i class="{{$category->icon}}"></i>
                <span>{{$category->title}}</span>
              </div>  
          @endforeach
      </div>  --}}
      {{-- <p class="fw-bold">Pacchetto Sponsorizzata</p> 
      <div class="d-flex gap-2 mb-5 justify-content-center">
          @foreach ($apartment->sponsorships as $sponsorship)
              <span>{{$sponsorship->title}}</span>
          @endforeach
      </div>  --}}
    </div>

    

    
</div>

@endsection