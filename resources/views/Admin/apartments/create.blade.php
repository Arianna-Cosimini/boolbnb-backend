@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.apartments.index') }}" class="text-black">I tuoi
                        appartamenti</a></li>
                <li class="breadcrumb-item active" aria-current="page">Affitta appartamento</li>
            </ol>
        </nav>

        <h1 class="mb-3">Affitta appartamento</h1>

        {{-- form --}}
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data" class="py-5">
            @csrf

            {{-- nome appartamento --}}
            <div class="form-floating mb-3 position-relative">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="Nome appartamento" value="{{ old('name') }}">
                <label for="name">Nome appartamento<span class="required">*</span></label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            {{-- immagine principale --}}
            <div class="mb-3">
                <label for="cover_image" class="form-label">Immagine di copertina</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
                @error('cover_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- indirizzo --}}
            <div class="form-floating mb-3 position-relative">
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" placeholder="Indirizzo" {{-- value="{{ old('address') }}" --}} autocomplete="off">
                <label for="address" class="@error('address') text-danger @enderror">Indirizzo<span class="required">*</span></label>
                @error('address')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <div id="menuAutoComplete" class="card position-absolute w-100 radius d-none" style="z-index: 1000;">
                    <ul class="list">
                     
                    </ul>
                </div>
            </div>

            <div class="d-none">
                <input type="text" id="latitude" name="latitude">
                <input type="text" id="longitude" name="longitude">
            </div>

            {{-- numero di stanze --}}
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('room_number') is-invalid @enderror" id="room_number"
                    name="room_number" placeholder="0" min="0" max="10" value="{{ old('room_number') }}">
                <label for="room_number">Numero di stanze<span class="required">*</span></label>
                @error('room_number')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- numero di letti --}}
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('bed_number') is-invalid @enderror" id="bed_number"
                    name="bed_number" placeholder="0" min="0" max="20" value="{{ old('bed_number') }}">
                <label for="bed_number">Numero di posti letto<span class="required">*</span></label>
                @error('bed_number')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- numero di bagni --}}
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('bathroom_number') is-invalid @enderror"
                    id="bathroom_number" name="bathroom_number" placeholder="0" min="0" max="5"
                    value="{{ old('bathroom_number') }}">
                <label for="bathroom_number">Numero di bagni<span class="required">*</span></label>
                @error('bathroom_number')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- metri quadri --}}
            <div class="form-floating mb-5">
                <input type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
                    name="square_meters" placeholder="0" min="0" max="500" value="{{ old('square_meters') }}">
                <label for="square_meters">Metri quadrati<span class="required">*</span></label>
                @error('square_meters')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- immagine provvisoria --}}
            {{-- <div class="form-floating mb-3">
                <input type="string" class="form-control" id="image" name="image" value="{{ old('image') }}"
                    placeholder="https://bollbnb.com/img-default">
                <label for="image" class="form-label">Immagine di copertina</label>
            </div> --}}

            <div class="mb-4">
                <label class="fw-bold fs-4">Servizi</label>
                <p class="mb-3">Almeno un servizio</p>
                <div class="d-flex flex-column gap-2">
                    @foreach($services as $service)
                     <div class="form-check">
                        <label for="service-{{ $service->id }}" class="form-check-label"><div class="text-nowrap">{{ $service->title }}</div></label>
                        <input type="checkbox" name="services[]" value="{{ $service->id }}" class="form-check-input" id="service-{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}> 
                    </div>
                    @endforeach
                </div>
                @error('services')
                     <p class="text-danger mt-3">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label class="mb-3 fw-bold fs-4">Categoria</label>
                <div class="d-flex gap-4">
                    @foreach($categories as $key => $category)
                    <div class="form-check d-flex ps-0">
                        <input type="radio" class="btn-check" name="options-outlined" id="{{ $category->id }}" autocomplete="off" {{ $key == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-dark" for="{{ $category->id }}"><i class="{{ $category->icon }} me-2"></i>{{ $category->title }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-5">
                
                <div class="form-check me-3">
                    <input class="form-check-input  @error('services') is-invalid @enderror" type="radio"
                        name="visible" id="visible" value="1"
                        {{ old('visible') == 1 ? 'checked' : '' }}>
                    <label class="form-check-label  @error('visible') text-danger @enderror" for="visible">
                        Visibile
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input  @error('services') is-invalid @enderror" type="radio"
                        name="visible" id="visible" value="0"
                        {{ old('visible') == 0 ? 'checked' : '' }}>
                    <label class="form-check-label  @error('visible') text-danger @enderror" for="visible">
                        Non Visibile
                    </label>
                </div>

            </div>

            {{-- <div class="mb-3">
                <label class="mb-2" for="">Vuoi Sponsorizzare il tuo BnB?</label>
                <div class="d-flex gap-4">
                    @foreach($sponsorships as $sponsorship)
                    <div class="form-check ">
                        <input type="checkbox" name="sponsorships[]" value="{{$sponsorship->id}}" class="form-check-input" id="sponsorship-{{$sponsorship->id}}"
                            {{ in_array($sponsorship->id, old('sponsorships', [])) ? 'checked' : '' }}> 
                        
                        <label for="sponsorship-{{$sponsorship->id}}" class="form-check-label">{{$sponsorship->title}}</label>
                    </div>
                    @endforeach
                </div>
            </div> --}}

            <button type="submit" class="btn btn-danger button-red mt-5">Aggiungi</button>

        </form>

    </div>
@endsection


@section('javascript')
    <script>
        const keyApi = 'RrNofIXHXhCLSto2sM1SEfvmA1AamCSs';
        const lat = '44.4949';
        const lon = '11.3426';
        const radius = '20000';

        const search = document.getElementById('address');
        const menuAutoComplete = document.getElementById('menuAutoComplete');
        const menuAutoCompleteClass = menuAutoComplete.classList;
        const ulList = document.querySelector('ul.list');

        const latitude = document.getElementById('latitude');
        const longitude = document.getElementById('longitude');


        search.addEventListener('input', function() {
            if (search.value != '')
                getApiProjects(search.value);
            addRemoveClass();

        })

        // aggiunge e rimuove classi 
        function addRemoveClass() {
            console.log(menuAutoCompleteClass);
            if (search.value == '')
                menuAutoCompleteClass.add('d-none');
            else
                menuAutoCompleteClass.remove('d-none');
        }

        function getApiProjects(address) {
            fetch(
                    `https://api.tomtom.com/search/2/search/${address}.json?key=${keyApi}&countrySet=IT&limit=5&lat=${lat}&lon=${lon}&radius=${radius}`
                )
                .then(response => response.json())
                .then(data => {

                    console.log(data.results);


                    ulList.innerHTML = '';
                    if (data.results != undefined)
                        data.results.forEach(function(currentValue, index, array) {
                            const li = document.createElement('li');
                            li.append(currentValue.address.freeformAddress);
                            li.addEventListener('click',
                                () => {
                                    search.value = currentValue.address.freeformAddress;
                                    menuAutoCompleteClass.add('d-none');
                                    ulList.innerHTML = '';
                                    latitude.value = currentValue.position.lat;
                                    longitude.value = currentValue.position.lon;
                                    console.log(latitude.value, 'lat');
                                    console.log(longitude.value, 'lon');
                                }
                            )


                            ulList.appendChild(li);
                        });
                });
        }

        function visbile()
    </script>
@endsection
