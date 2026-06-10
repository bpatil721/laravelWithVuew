<x-frontend::frontend>
    <div id="app" data-component="Checkout" data-props='@json(["cartItems" => $cartItems, "total" => $total])'></div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.stripeKey = "{{ config('services.stripe.key') }}";
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-frontend::frontend>
