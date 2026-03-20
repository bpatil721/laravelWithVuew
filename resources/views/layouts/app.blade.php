<html lang="en">
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <x-header />
        <div style="display: flex;">
            <x-sidebar />
            <div style="flex: 1;">
                @yield('content')
            </div>
        </div>
        <x-footer />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>