<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
        
        {{-- User must close cash register message --}}
        @php
            $lastCashHistory = \App\Models\CashHistory::latest()->first();
            $lastUser = $lastCashHistory ? $lastCashHistory->user->name : 'Usuario';
        @endphp
        
        @if($lastCashHistory && $lastCashHistory->estado === 'Apertura')
        <li class="nav-item">
            <span class="nav-link text-danger d-flex align-items-center">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                <span class="d-none d-sm-inline">{{ $lastUser }} debe cerrar caja antes de cerrar sesión</span>
                <span class="d-inline d-sm-none">{{ $lastUser }} debe cerrar caja</span>
            </span>
        </li>
        @endif
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- AQUÍ AGREGAMOS EL ESTADO DE LA CAJA --}}
        @php
            $statusColor = $lastCashHistory && $lastCashHistory->estado === 'Apertura' ? 'success' : 'danger';
            $statusText = $lastCashHistory ? $lastCashHistory->estado : 'Sin registro';
        @endphp
        
        <li class="nav-item">
            <span class="nav-link">
                <i class="fas fa-cash-register"></i>
                Caja: <span class="badge badge-{{ $statusColor }}">{{ $statusText }}</span>
            </span>
        </li>

        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
