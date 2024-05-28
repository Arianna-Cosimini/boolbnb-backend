@extends('layouts.app')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    @endsection



@section('content')
    <div id="payment_container" class="container-fluid my-5">
    

        <div class="row row-cols-1 mb-5">
            <div class="col">
                <h1>
                    <span class="icon-section me-2">
                        <i class="fa-solid fa-building fa-sm"></i>
                    </span>
                    Pagamento
                </h1>

            </div>
            <div class="col">
                <a href="{{ route('admin.index') }}" class="back">
                    Torna Indietro
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </div>




        <div class="row">
            <div class="col-6 offset-3">
                @csrf
                {{-- Stile fornito da Braintree --}}
                <div id="dropin-container">

                </div>
              
                <div class="info-payment text-center">
                    <a id="submit-button" class="btn btn-sm btn-success">
                        Procedi al pagamento
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('javascript')
    <script>
        // prendiamo il button
        // var buttonCarta = document.querySelector('#submit-carta');
        var button = document.querySelector('#submit-button');

        var instance; // define instance variable outside the function
        const urlParams = new URLSearchParams(window.location.search);
        let sponsor = urlParams.get('sponsor_id');
        let apartment = urlParams.get('apartment_id');

        // controllo carta
        braintree.dropin.create({
            authorization: '{{ $token }}',
            container: '#dropin-container'
        }, function(createErr, dropinInstance) {
            if (createErr) {
                console.error(createErr);
                return;
            }
            instance = dropinInstance; // assign dropinInstance to instance variable
            console.log(sponsor)
            console.log(apartment)
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(function(err, payload) {
                    $.ajax({
                        type: 'POST',
                        url: `{{ route('admin.payment.process') }}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            payload: payload,
                            sponsor: sponsor,
                            apartment: apartment
                        },
                        success: function(response) {
                            console.log('Risposta dal server:', response);


                            // Reindirizza l'utente dopo 5 secondi
                            setTimeout(function() {
                                window.location.replace('/admin/index');
                            }, 5000);
                        },
                        error: function(xhr, status, error) {
                            console.error('Errore durante la chiamata AJAX:', error);
                            // Gestisci gli errori in base alle tue esigenze
                        }
                    });
                });
            });
        });
    </script>
@endsection
