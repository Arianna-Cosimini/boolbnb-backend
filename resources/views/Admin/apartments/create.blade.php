@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.apartments.index') }}" class="text-black">I tuoi
                        annunci</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nuovo annuncio</li>
            </ol>
        </nav>

        <h1 class="mb-3 fs-2">Nuovo annuncio</h1>

        {{-- form --}}
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data" class="py-5"
            onsubmit="return validateForm()">
            @csrf

            {{-- nome struttura --}}
            <div class="form-floating mb-3 position-relative">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="Nome appartamento" value="{{ old('name') }}">
                <label for="name">Nome struttura<span class="required">*</span></label>
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

            {{-- descrizione --}}
            <div class="form-floating mb-3">
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    placeholder="Descrizione">{{ old('description') }}</textarea>
                <label for="description">Descrizione<span class="required">*</span></label>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
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
                <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                    id="square_meters" name="square_meters" placeholder="0" min="0" max="500"
                    value="{{ old('square_meters') }}">
                <label for="square_meters">Metri quadrati<span class="required">*</span></label>
                @error('square_meters')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            {{-- servizi --}}
            <div class="mb-4">
                <label class="fw-medium fs-3">Servizi</label>
                <p class="mb-3">Almeno un servizio</p>
                <div class="d-flex flex-column gap-2">
                    @foreach ($services as $service)
                        <div class="form-check d-flex">
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

            {{-- categorie --}}
            <div class="mt-5">
                <label class="mb-4 fw-medium fs-3">Quale di queste opzioni descrive meglio il tuo alloggio?</label>
                <div class="row px-2 d-flex gap-3">
                    @foreach ($categories as $category)
                        <div class="form-check col-3 px-0">
                            <button
                                class="btn border border-2 border-secondary-subtle rounded-4 px-3 py-4 my-button-categories"
                                type="button" onclick="selectCategory('{{ $category->id }}')">
                                <label class="d-flex flex-column align-items-center gap-2 my-radio-label form-check-label"
                                    for="category-{{ $category->id }}">
                                    <img src="{{ $category->icon }}" class="my-icon" alt="">
                                    {{-- <i class="{{ $category->icon }} fs-3"></i> --}}
                                    <div class="fs-5">{{ $category->title }}</div>
                                    <input type="radio" name="categories[]" value="{{ $category->id }}"
                                        class="my-radio form-check-input my-input-form fs-5"
                                        id="category-{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                        {{ $loop->first ? 'checked' : '' }}>
                                </label>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- visibilità --}}

            <div class="mt-5">
                <label class="mb-4 fw-medium fs-3">Vuoi rendere questo appartamento visibile?</label>
                <div class="form-check form-switch">
                    <input class="form-check-input @error('visible') is-invalid @enderror" type="checkbox" role="switch"
                        id="visible" name="visible" value="1" checked {{ old('visible') ? 'checked' : '' }}>
                    <label class="form-check-label" for="visible">Visibile</label>
                </div>
            </div>



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
    </script>

    <script>
        function selectCategory(categoryId) {
            // Rimuovi la classe 'selected-category' da tutti i pulsanti
            document.querySelectorAll('.my-button-categories').forEach(button => {
                button.classList.remove('selected-category');
                button.querySelector('.my-icon').classList.remove('animate-scale');
            });

            // Aggiungi la classe 'selected-category' al pulsante cliccato
            const selectedButton = document.getElementById('category-' + categoryId).closest('.my-button-categories');
            selectedButton.classList.add('selected-category');

            // Aggiungi la classe 'animate-scale' solo all'icona
            const icon = selectedButton.querySelector('.my-icon');
            icon.classList.add('animate-scale');

            // Rimuovi la classe 'animate-scale' dopo 1 secondo
            setTimeout(() => {
                icon.classList.remove('animate-scale');
            }, 1000);

            // Seleziona il radio button corrispondente
            document.getElementById('category-' + categoryId).checked = true;
        }

        // Imposta il pulsante selezionato al caricamento della pagina
        window.onload = function() {
            document.querySelectorAll('.my-radio').forEach(radio => {
                if (radio.checked) {
                    const button = radio.closest('.my-button-categories');
                    button.classList.add('selected-category');
                    const icon = button.querySelector('my-icon');
                    icon.classList.add('animate-scale');
                }
            });
        }
    </script>
@endsection
