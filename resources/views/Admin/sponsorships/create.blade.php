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
                                        class="form-check-input" id="sponsorship-{{ $sponsorship->id }}"
                                        {{ in_array($sponsorship->id, old('sponsorships', [])) ? 'checked' : '' }}>
                                    <label for="sponsorship-{{ $sponsorship->id }}" class="form-check-label d-block">
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
            <div class="mt-5">
                <label class="mb-4 fw-medium fs-3" for="">Seleziona il tuo appartamento</label>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($apartments as $apartment)
                        <div class="col">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <input type="radio" class="form-check-input" name="apartment_id"
                                        id="apartment-{{ $apartment->id }}" value="{{ $apartment->id }}">
                                    <label for="apartment-{{ $apartment->id }}" class="form-check-label d-block">
                                        <h5 class="card-title">{{ $apartment->name }}</h5>
                                        <p class="card-text">{{ $apartment->location }}</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Trigger for Modal -->
            <div class="text-center my-3">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#paymentModal">
                    Procedi al pagamento
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Procedi al pagamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="dropin-container" class="mt-5"></div>
                            <input type="hidden" name="payment_method_nonce" id="nonce">
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" id="submit-button" class="btn btn-dark">Procedi al pagamento</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Loader Overlay -->
        <div id="loader-overlay"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.5); z-index: 9999;">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                <div class="spinner"></div>
                <div id="success-message"
                    style="display: none; font-size: 1.2rem; color: green; position: absolute; bottom: 150%; left: 50%; transform: translate(-50%, 0);">
                    Transazione effettuata con successo!</div>
            </div>
        </div>
    @endif
@endsection

@section('style')
    <style>
        .spinner {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid ;
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

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 10px;
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
