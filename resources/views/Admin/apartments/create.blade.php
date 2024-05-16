@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.apartments.index') }}" class="text-black">I tuoi
                        annunci</a></li>
                <li class="breadcrumb-item active" aria-current="page">Affitta appartamento</li>
            </ol>
        </nav>

        <h1 class="mb-3">Affitta appartamento</h1>

        {{-- form --}}
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data" class="py-5" onsubmit="return validateForm()">
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
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image"
                    name="cover_image">
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
                <label for="address" class="@error('address') text-danger @enderror">Indirizzo<span
                        class="required">*</span></label>
                {{-- mostro messaggio di errore --}}
                <span id="address-error" class="text-danger"></span>
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
                    name="square_meters" placeholder="0" min="0" max="500"
                    value="{{ old('square_meters') }}">
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
                    @foreach ($services as $service)
                        <div class="form-check">
                            <label for="service-{{ $service->id }}" class="form-check-label">
                                <div class="text-nowrap">{{ $service->title }}</div>
                            </label>
                            <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                class="form-check-input" id="service-{{ $service->id }}"
                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        </div>
                    @endforeach
                </div>
                @error('services')
                    <p class="text-danger mt-3">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-5">
                <label class="mb-3 fw-bold fs-4">Categoria</label>
                <div class="row">

                    @foreach ($categories as $category)
                        <div class="form-check d-flex flex-column justify-content-center align-items-center col-4">
                            <button class="btn btn-outline-dark w-100 pb-5 position-relative my-button-categories"
                                type="button">
                                <label
                                    class="form-check-label d-flex flex-column justify-content-center align-items-center fs-1"
                                    for="category-{{ $category->id }}">
                                    <i class="{{ $category->icon }} me-2"></i>
                                    <div class="fs-3">{{ $category->title }}</div>
                                    <input type="radio" name="categories[]" value="{{ $category->id }}"
                                        class="form-check-input position-absolute my-input-form fs-5"
                                        id="category-{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                </label>
                            </button>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="mt-5">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="flexSwitchCheckDefault"> Visibile </label>
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                </div>
            </div>

            {{-- <div class="mb-3">
                <label class="mb-2" for="">Vuoi Sponsorizzare il tuo BnB?</label>
                <div class="d-flex gap-4">
                    @foreach ($sponsorships as $sponsorship)
                    <div class="form-check ">
                        <input type="radio" name="sponsorships[]" value="{{$sponsorship->id}}" class="form-check-input" id="sponsorship-{{$sponsorship->id}}"
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
                    ulList.innerHTML = '';

                    if (data.results) {
                        data.results.forEach(function(currentValue, index, array) {
                            const li = document.createElement('li');
                            li.append(currentValue.address.freeformAddress);

                            li.addEventListener('click', () => {
                                search.value = currentValue.address.freeformAddress;
                                // Al click sul suggerimento il menu scompare
                                menuAutoCompleteClass.add('d-none');

                                // Controllo se l'indirizzo corrisponde a un suggerimento
                                const indirizzoSelezionato = currentValue.address.freeformAddress;
                                const risultatoCorrispondente = data.results.find(result => result
                                    .address.freeformAddress === indirizzoSelezionato);

                                if (risultatoCorrispondente) {
                                    latitude.value = risultatoCorrispondente.position.lat;
                                    longitude.value = risultatoCorrispondente.position.lon;

                                    console.log(latitude.value, 'lat');
                                    console.log(longitude.value, 'lon');
                                }
                            });

                            ulList.appendChild(li);
                        });
                    } else {
                        console.log("Nessun risultato trovato per", address);
                    }
                })
        }


        // function per controllare che l'utente scelga uno dei suggerimenti
        function validateForm() {
            const inputAddress = document.getElementById("address").value;
            const suggestions = document.querySelectorAll("#menuAutoComplete ul.list li");

            // Controllo che l'indirizzo corrisponda a uno dei suggerimenti
            const addressMatched = false;
            suggestions.forEach(function(suggestion) {
                const suggestionText = suggestion.textContent.trim().toLowerCase();
                const inputAddressTrimmed = inputAddress.trim().toLowerCase();
                if (suggestionText === inputAddressTrimmed) {
                    addressMatched = true;
                    return;
                }
            });
            // Se l'indirizzo inserito non corrisponde mostro un messaggio di errore
            if (!addressMatched) {
                const errorMessage = "L'indirizzo inserito non corrisponde a uno dei suggerimenti.";
                document.getElementById('address-error').textContent = errorMessage;
                return false;
            } else {
                document.getElementById('address-error').textContent = "";
            }


            // Se l'indirizzo corrisponde invio il modulo
            return true;
        }

        document.addEventListener('click', function(event) {
            // Verifica se il clic è avvenuto all'interno del menu
            const isClickInsideMenu = menuAutoComplete.contains(event.target);

            // Se il clic non è avvenuto all'interno del menu, chiudi il menu
            if (!isClickInsideMenu) {
                menuAutoCompleteClass.add('d-none');
            }
        });
                });
        }

        function visbile()
    </script>
@endsection
