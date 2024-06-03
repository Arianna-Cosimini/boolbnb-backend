@extends('layouts.app')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection



@section('content')
    <form method="POST" action="{{ route('admin.sponsorships.store') }}">
        @csrf
        <!-- Altri campi del form -->

        <div id="dropin-container"></div>
        <input type="hidden" name="payment_method_nonce" id="nonce">

        <button type="submit">Submit Payment</button>
    </form>
@endsection



@section('javascript')
    <script>
        var form = document.querySelector('form');
        var client_token = "{{ $clientToken }}"; // Genera e passa il client token dal controller

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

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection
