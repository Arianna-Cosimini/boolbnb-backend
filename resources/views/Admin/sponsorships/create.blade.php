@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="sponsorship_index" class="container py-5">


        <nav aria-label="breadcrumb" class="d-flex justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-black">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sponsorizzazioni</li>
            </ol>

            <a href="{{ route('admin.index') }}" class="btn btn-danger button-red text-white">
                <i class="fa-solid fa-arrow-left"></i> Torna indietro
            </a>
        </nav>
        @if ($apartments->isEmpty())
            <div class="alert alert-warning">Non ci sono appartamenti disponibili per la sponsorizzazione al momento.</div>
        @else
            <form action="{{ route('admin.sponsorships.store') }}" method="POST" id="payment-form" class="container">
                @csrf
                <div class="mt-5">
                    <label class="mb-4 fw-medium fs-3" for="">Vuoi Sponsorizzare il tuo BnB?</label>
                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                        @foreach ($sponsorships as $sponsorship)
                            <div class="col">
                                <div class="card h-100 text-center">
                                    <div class="card-body">
                                        <input type="radio" name="sponsorships[]" value="{{ $sponsorship->id }}"
                                            class="form-checked-input" id="sponsorship-{{ $sponsorship->id }}"
                                            {{ in_array($sponsorship->id, old('sponsorships', [])) ? 'checked' : '' }}>
                                        <label for="sponsorship-{{ $sponsorship->id }}" class="form-checked-label d-block">
                                            <h5 class="card-title">{{ $sponsorship->title }}</h5>
                                            <p class="card-text">{{ $sponsorship->price }} €</p>
                                            <p class="card-text">{{ $sponsorship->description }}</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-center">
                    <!-- Pulsante per aprire il modale -->
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                        data-bs-target="#selectApartmentModal">
                        Seleziona il tuo appartamento
                    </button>
                </div>
                <!-- Modale per la selezione dell'appartamento -->
                <div class="modal fade" id="selectApartmentModal" tabindex="-1" aria-labelledby="selectApartmentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="selectApartmentModalLabel">Seleziona la struttura che vuoi
                                    sponsorizzare</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="sponsorship-apartment mt-5" style="max-height: 300px; overflow-y: auto;">

                                    <div class="d-flex flex-column">
                                        @foreach ($apartments as $apartment)
                                            <div class="col">
                                                <div class="card h-100 text-center">
                                                    <div class="card-body">
                                                        <input type="radio" class="form-checked-input" name="apartment_id"
                                                            id="apartment-{{ $apartment->id }}"
                                                            value="{{ $apartment->id }}">
                                                        <label for="apartment-{{ $apartment->id }}"
                                                            class="form-checked-label d-block">
                                                            <p class="card-title">{{ $apartment->name }}</p>
                                                            <p class="card-text">{{ $apartment->location }}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Chiudi</button>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#paymentModal">
                                    Procedi al pagamento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <!-- Trigger for Modal -->
                <div class="text-center my-3">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#paymentModal">
                        Procedi al pagamento
                    </button>
                </div> --}}

                <!-- Modal -->
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Procedi al pagamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="dropin-container" class="mt-5"></div>
                                <input type="hidden" name="payment_method_nonce" id="nonce">
                            </div>
                            <div class="modal-footer text-center">
                                <button type="submit" id="submit-button" class="btn btn-dark">Procedi al
                                    pagamento</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Loader Overlay -->
            <div id="loader-overlay" class="w-100"
                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.5); z-index: 9999;">
                <div
                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                    <div class="spinner"></div>
                    <div id="success-message" class="fw-bold"
                        style="display: none; font-size: 1.2rem; color: green; position: absolute; top: calc(50% + 50px); left: 50%; transform: translate(-50%, -50%); display: inline-block;">
                        Transazione effettuata con successo!
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('style')
    <style>
        .spinner {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }



        .card-body {
            position: relative;
        }


        /* Stile della scrollbar */
        .sponsorship-apartment::-webkit-scrollbar {
            width: 6px;
            border-radius: 10px
        }

        .sponsorship-apartment::-webkit-scrollbar-thumb {
            background-color: grey;
            border-radius: 15px;
        }

        .sponsorship-apartment::-webkit-scrollbar-track {
            background-color: transparent;
        }
    </style>
@endsection

@section('javascript')
    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var submitButton = document.querySelector('#submit-button');
        var loaderOverlay = document.querySelector('#loader-overlay');
        var successMessage = document.querySelector('#success-message');
        var client_token = "{{ $clientToken }}"; // Passa il client token alla vista

        braintree.dropin.create({
            authorization: client_token,
            container: '#dropin-container'
        }, function(createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Mostra il loader overlay
                loaderOverlay.style.display = 'block';
                submitButton.disabled = true;

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.error(err);
                        // Nascondi il loader overlay in caso di errore
                        loaderOverlay.style.display = 'none';
                        submitButton.disabled = false;
                        return;
                    }

                    // Imposta il nonce nel form
                    document.querySelector('#nonce').value = payload.nonce;

                    // Mostra il messaggio di successo
                    successMessage.style.display = 'block';

                    // Attendi 5 secondi prima di inviare il modulo
                    setTimeout(function() {
                        form.submit();
                    }, 5000);
                });
            });
        });
    </script>
@endsection
