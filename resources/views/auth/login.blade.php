<html>
    <head>
        <title>Login</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>  
        
        <div id="app" data-component="LoginForm">
            <login-form></login-form>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>