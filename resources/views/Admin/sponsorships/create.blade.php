@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.sponsorships.store') }}" method="POST" id="payment-form">
        @csrf
        <div class="mt-5">
            <label class="mb-4 fw-medium fs-3" for="">Vuoi Sponsorizzare il tuo BnB?</label>
            <div class="d-flex gap-4 mb-5">
                @foreach ($sponsorships as $sponsorship)
                    <div class="form-check">
                        <input type="radio" name="sponsorships[]" value="{{ $sponsorship->id }}" class="form-check-input"
                            id="sponsorship-{{ $sponsorship->id }}"
                            {{ in_array($sponsorship->id, old('sponsorships', [])) ? 'checked' : '' }}>

                        <label for="sponsorship-{{ $sponsorship->id }}"
                            class="form-check-label">{{ $sponsorship->title }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex gap-4">
            @foreach ($apartments as $apartment)
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="apartment_id" value="{{ $apartment->id }}">
                    <label for="apartment-{{ $apartment->id }}" class="form-check-label">{{ $apartment->name }}</label>
                </div>
            @endforeach
        </div>

        <div id="dropin-container"></div>
        <input type="hidden" name="payment_method_nonce" id="nonce">

        <div class="text-center my-3">
            <button type="submit" class="btn btn-primary">Procedi al pagamento</button>
        </div>
    </form>

    @endsection

    @section('javascript')

    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
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
