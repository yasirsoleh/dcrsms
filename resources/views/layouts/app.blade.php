<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/jq-3.3.1/dt-1.10.25/r-2.2.9/datatables.min.css"/>
 
        <script type="text/javascript" src="https://cdn.datatables.net/v/zf/jq-3.3.1/dt-1.10.25/r-2.2.9/datatables.min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable({
                    "paging": false,
                    "bInfo": false, // hide showing entries
                });
            } );
            $(document).ready( function () {
                $('#myTable2').DataTable({
                    "paging": false,
                    "bInfo": false, // hide showing entries
                });
            } );
        </script>
    </body>
</html>
