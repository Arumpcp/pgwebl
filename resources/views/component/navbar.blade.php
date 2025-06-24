<!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top py-4 px-5 {{ Route::currentRouteName() === 'home' ? 'bg-transparent' : 'bg-white shadow-sm' }}">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase" href="#">
            <i class="fa-solid fa-bus me-2"></i>{{ $title }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center">
                {{-- Home --}}
                <li class="nav-item">
                    <a class="nav-link rounded-pill {{ request()->routeIs('home') ? 'scroll-home active' : '' }}"
                        href="{{ request()->routeIs('home') ? '#top' : route('home') }}">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>

                {{-- Links only on Home --}}
                @if (Route::currentRouteName() === 'home')
                    <li class="nav-item">
                        <a class="nav-link rounded-pill" href="#map-feature">
                            <i class="fa-solid fa-map-location-dot"></i> Map
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill" href="#table-feature">
                            <i class="fa-solid fa-table"></i> Table
                        </a>
                    </li>
                @endif

                {{-- Dropdown only on map --}}
                @auth
                    @if (Route::currentRouteName() === 'map')
                        <li class="nav-item dropdown">
                            <a class="nav-link rounded-pill dropdown-toggle" href="#" id="dataDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-database"></i> Data
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dataDropdown">
                                <li><a class="dropdown-item" href="{{ route('api.points') }}" target="_blank">
                                    <i class="fa-solid fa-location-dot"></i> Points</a></li>
                                <li><a class="dropdown-item" href="{{ route('api.polylines') }}" target="_blank">
                                    <i class="fa-solid fa-minus"></i> Polylines</a></li>
                                <li><a class="dropdown-item" href="{{ route('api.polygons') }}" target="_blank">
                                    <i class="fa-solid fa-draw-polygon"></i> Polygons</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth

                {{-- Logout only on home --}}
                @auth
                    @if (Route::currentRouteName() === 'home')
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="nav-link btn btn-link text-danger rounded-pill" type="submit">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endif
                @endauth

                {{-- Login for guests --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white bg-primary rounded-pill px-3 py-2" href="{{ route('login') }}">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Tambahkan di @section('styles') atau langsung di <style> -->
<style>
    :root {
        --biru-utama: #1E56A0;
        --biru-gelap: #163172;
    }

    html {
        scroll-behavior: smooth;
        scroll-padding-top: 450px; /* Sesuaikan dengan tinggi navbar */
    }

    .nav-link {
        border-radius: 50px !important;
        padding: 8px 16px !important;
        margin: 0 4px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .nav-link:hover {
        background-color: #f0f4ff;
        transform: scale(1.05);
    }

    .nav-link.active {
        background-color: #d6e4f0;
        font-weight: bold;
        color: var(--biru-utama) !important;
    }

    .feature-highlight {
        animation: pulseHighlight 3s ease-in-out;
        box-shadow: 0 0 0 6px rgba(30, 86, 160, 0.2);
        border-radius: 1.5rem;
    }

    @keyframes pulseHighlight {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(30, 86, 160, 0.2); }
        25% { transform: scale(1.01); box-shadow: 0 0 15px 8px rgba(30, 86, 160, 0.2); }
        50% { transform: scale(1.03); box-shadow: 0 0 20px 10px rgba(30, 86, 160, 0.3); }
        75% { transform: scale(1.01); box-shadow: 0 0 10px 5px rgba(30, 86, 160, 0.25); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(30, 86, 160, 0); }
    }

    .btn-link.text-danger {
        background-color: #f8d7da;
        font-weight: bold;
        color: #dc3545 !important;
        padding: 8px 16px;
        transition: background-color 0.3s;
    }

    .btn-link.text-danger:hover {
        background-color: #f5c6cb;
    }
</style>
