<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
</head>
<body>
    <div class="py-12">
        @csrf
        <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
        <div style="display: flex;justify-content: center;align-items: center; color: white">
            <a href="{{ route('admin.index') }}"><button class="btn btn-success">Submit payment</button></a>
        </div>
        <script>
            var button = document.querySelector('#submit-button');
            braintree.dropin.create({
                authorization: '{{$token}}',
                container: '#dropin-container',
            }, 
            function (createErr, instance) {
                button.addEventListener('click', function () {
    instance.requestPaymentMethod(function (err, payload) {
        (function($) {
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('token')}}",
                    data: {nonce : payload.nonce},
                    success: function (data) {
                        console.log('success',payload.nonce)
                    },
                    error: function (data) {
                        console.log('error',payload.nonce)
                    }
                });
            });
        })(jQuery);
    });
});
            }
        );
        </script>
    </div>
</body>
</html>