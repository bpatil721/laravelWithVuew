<x-frontend>
    <div id="app" data-component="HomePage" data-props='@json(["user"=>Auth::user(),"login"=>Auth::check()])'></div>
    <script src="{{ mix('js/app.js') }}"></script>
</x-frontend>
