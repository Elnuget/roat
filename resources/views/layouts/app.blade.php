<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Test</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />
    

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- ...existing menu items... -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('historiales_clinicos.index') }}">Historiales Clínicos</a>
        </li>
        <!-- ...existing menu items... -->
    </ul>

    <ul class="sidebar-menu" data-widget="tree">
        <!-- ...existing menu items... -->
        <li class="nav-item">
            <a href="{{ route('historiales_clinicos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-file-medical"></i>
                <p>Historiales Clínicos</p>
            </a>
        </li>
        <!-- ...existing menu items... -->
    </ul>
</body>

</html>