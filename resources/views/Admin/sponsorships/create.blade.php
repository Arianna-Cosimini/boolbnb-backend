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

    <div class="container py-5">
    <nav aria-label="breadcrumb" class="d-none d-md-block">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.apartments.index') }}" class="text-black">Le tue strutture</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sponsorizza struttura</li>
        </ol>
    </nav>
    <nav class="d-block d-md-none mb-3">
        <a href="{{ route('admin.apartments.index') }}" class="text-decoration-none text-black"><i class="fa-solid fa-chevron-left me-2"></i>Indietro</a>
    </nav>

    @if ($apartments->isEmpty())
        <div class="alert alert-warning">Non ci sono appartamenti disponibili per la sponsorizzazione al momento.</div>
    @else
        <form action="{{ route('admin.sponsorships.store') }}" method="POST" id="payment-form">
            @csrf

            <div>
                <h1 class="mb-5 fs-2">Sponsorizza struttura</h1>
                <h5 class="mb-4 fw-medium fs-5">Quale struttura vuoi promuovere?</h5> 
                <div class="mb-4">
                    <select name="apartment_id" id="apartment-select" class="form-select">
                        @foreach ($apartments as $apartment)
                            <option value="{{ $apartment->id }}">{{ $apartment->name }} - {{ $apartment->address }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-5">
                <h5 class="mb-4 fw-medium fs-5">Seleziona piano</h5> 
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    @foreach ($sponsorships as $sponsorship)
                        <div class="col">
                            <div class="card px-3 h-100 text-center card-selectable sponsorship-card">
                                <div class="card-body">
                                    <input type="radio" name="sponsorships[]" value="{{ $sponsorship->id }}"
                                        class="form-check-input d-none" id="sponsorship-{{ $sponsorship->id }}"
                                        {{ in_array($sponsorship->id, old('sponsorships', [])) ? 'checked' : '' }}>
                                    <label for="sponsorship-{{ $sponsorship->id }}" class="form-check-label d-block">
                                        <h5 class="card-title">{{ $sponsorship->title }}</h5>
                                        <p class="card-text fw-light">{{ $sponsorship->description }}</p>
                                        <p class="card-text fs-1">€ {{ $sponsorship->price }}</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Trigger for Modal -->
            <div class="text-center my-3">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#paymentModal" disabled>
                    Procedi al pagamento
                </button>
            </div>

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
                                <button type="submit" id="submit-button" class="btn btn-dark">Paga</button>
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

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .card-selectable {
            cursor: pointer;
            border: 1px solid transparent;
            transition: border 0.3s ease;
            border: 1px solid #222;

        }

        .card-selectable:hover {
            background-color: #f7f7f7;
        }

        .card-selectable.selected {
            border: 1px solid #222; /* colore di selezione */
            background-color: #222;
            color: white;
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
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    const sponsorshipCards = document.querySelectorAll('.sponsorship-card');
    const proceedButton = document.querySelector('button[data-bs-toggle="modal"]');

    function handleSelection(cards, inputName) {
        cards.forEach(card => {
            card.addEventListener('click', function() {
                // Deseleziona tutte le card
                cards.forEach(c => c.classList.remove('selected'));
                // Seleziona la card cliccata
                this.classList.add('selected');
                // Seleziona il radio button associato
                const radioButton = this.querySelector(`input[name="${inputName}"]`);
                if (radioButton) {
                    radioButton.checked = true;
                }
                // Abilita il pulsante solo se un radio button è selezionato
                if (document.querySelector('input[name="sponsorships[]"]:checked')) {
                    proceedButton.disabled = false;
                }
            });
        });
    }

    handleSelection(sponsorshipCards, 'sponsorships[]');
});
    </script>
@endsection
