<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">



        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: white;
            }
                    .error-container {
            text-align: center;
            padding: 40px;
        }
        .error-code {
            font-size: 72px;
            color: #e74c3c;
        }
        </style>
        @routes
        @inertiaHead
        
        <link rel="icon" href="/img/kirby.jpeg" sizes="any">
        <link rel="icon" href="/img/kirby.jpeg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        
        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        
        @inertia
    </body>
</html>
