@extends('layout.template')

@section('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        :root {
            --putih-lembut: #F6F6F6;
            --biru-pastel: #D6E4F0;
            --biru-utama: #1E56A0;
            --biru-gelap: #163172;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--putih-lembut);
            color: var(--biru-gelap);
        }

        a {
            color: var(--biru-utama);
            text-decoration: none;
        }

        a:hover {
            color: var(--biru-gelap);
        }

        h1,
        h2,
        {
        color: var(--putih-lembut);
        }

        h3,
        h4,
        h5 {
            color: var(--biru-utama);
        }

        section {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .card,
        .p-4,
        .border {
            border-radius: 1.5rem !important;
            background-color: var(--biru-pastel);
            border: none;
            transition: all 0.5s ease;
        }

        .p-4:hover,
        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(30, 86, 160, 0.2);
            background-color: white;
        }

        .card-title {
            color: var(--biru-gelap);
        }

        .icon-white {
            background-color: var(--biru-utama);
            color: white;
            padding: 16px;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: background-color 0.3s ease;
        }

        a.btn,
        button {
            background-color: var(--biru-utama);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 600;
            transition: 0.3s;
        }

        a.btn:hover,
        button:hover {
            background-color: var(--biru-gelap);
            transform: scale(1.05);
        }

        img.rounded {
            border: 5px solid var(--biru-pastel);
            transition: all 0.3s ease-in-out;
        }

        img.rounded:hover {
            transform: scale(1.05);
            border-color: var(--biru-utama);
        }

        footer.bg-dark {
            background-color: var(--biru-gelap) !important;
            color: #e8f1ff;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--putih-lembut);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--biru-utama);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--biru-gelap);
        }

        /* Apply Anton to Hero Title */
        .hero h1 {
            font-family: 'Anton', sans-serif;
            font-size: 5rem;
            letter-spacing: 2px;
            text-shadow: 4px 4px 0 rgba(0, 0, 0, 0.4);
        }
    </style>
@endsection

@section('content')
    {{-- resources/views/components/hero.blade.php --}}
    <section class="hero position-relative text-white">
        {{-- Overlay gelap --}}
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>
        <div class="container h-100 d-flex flex-column justify-content-center text-center position-relative">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-4 fw-bold mb-3">TJAPTRANS</h1>
                    <p class="lead mb-4">Daerah Istimewa Yogyakarta</p>
                </div>
            </div>
        </div>

        {{-- Kurva putih SVG --}}
        <div class="hero-bottom-curve">
            <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="w-100 h-100">
                <path fill="#ffffff" fill-opacity="1" d="M0,160 C480,320 960,0 1440,160 L1440,320 L0,320 Z">
                </path>
            </svg>
        </div>
    </section>

    <style>
        .hero {
            height: 92vh;
            background-image: url("{{ asset('storage/images/trans-jogja.png') }}");
            background-size: cover;
            /* agar tidak zoom */
            background-position: center bottom;
            background-repeat: no-repeat;
            position: relative;
        }

        .hero-overlay {
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
            pointer-events: none;
        }

        .hero .container {
            z-index: 2;
        }

        .hero-bottom-curve {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
            overflow: hidden;
            line-height: 0;
            z-index: 2;
            filter: drop-shadow(0 -8px 10px rgb(255, 254, 254));
            /* bayangan di atas kurva */
        }

        .hero-bottom-curve svg {
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>

    <!-- Fitur Utama -->
    <section class="bg-white" id="fitur">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Apa ada di TjapTrans?</h2>
            <div class="row g-4">
                <!-- Map -->
                <div class="col-md-4" id="map-feature">
                    <a class="text-decoration-none text-dark" href="{{ route('map') }}">
                        <div class="p-4 border shadow-sm h-100">
                            <i class="fa-solid fa-map-location-dot fa-2x icon-white mb-3"></i>
                            <h5>Peta Interaktif</h5>
                            <p>Tampilkan titik, garis, dan poligon dengan berbagai basemaps.</p>
                        </div>
                    </a>
                </div>
                <!-- Table -->
                <div class="col-md-4" id="table-feature">
                    <a class="text-decoration-none text-dark" href="{{ route('table') }}">
                        <div class="p-4 border shadow-sm h-100">
                            <i class="fa-solid fa-table fa-2x icon-white mb-3"></i>
                            <h5>Tabel Data</h5>
                            <p>Data spasial halte, rute dan titik kumpul Trans Jogja.</p>
                        </div>
                    </a>
                </div>
                <!-- WMS -->
                <div class="col-md-4" id="wms-feature">
                    <a href="{{ url('/wms-transjogja') }}" class="text-decoration-none text-dark">
                        <div class="p-4 border shadow-sm h-100">
                            <i class="fa-solid fa-route fa-2x icon-white mb-3"></i>
                            <h5>WMS Rute</h5>
                            <p>Rute Trans Jogja dengan visualisasi WMS pada basemad Open Strees Maps.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <style>
        #fitur {
            min-height: 70vh;
            display: flex;
            align-items: center;
            padding-top: 4rem;
            padding-bottom: 4rem;
        }
    </style>

    <!-- Tentang Aplikasi -->
    <section class="bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">TjapTrans</h2>
            <p class="fs-5 mx-auto" style="max-width: 700px;">
                <strong>WebGIS TjapTrans</strong> adalah platform pemetaan interaktif yang dirancang untuk penyajian data
                spasial secara real-time. Dibangun dengan Laravel dan LeafletJS, aplikasi ini memungkinkan
                dengan menampilkan berbagai elemen spasial seperti <em>halte Trans Jogja</em>, <em>rute Trans Jogja</em>,
                hingga <em>titik kumpul Trans Jogja.</em>
            </p>
        </div>
    </section>

    <!-- Galeri -->
    <<section class="bg-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Galeri</h2>
            <div class="card shadow-sm p-3">
                <div class="row justify-content-center g-4">
                    <div class="col-md-4">
                        <a href="https://dishub.jogjaprov.go.id/layanan/trans-jogja" target="_blank">
                            <img src="{{ asset('storage/images/dishub.png') }}" class="img-fluid rounded"
                                style="width: 29%; height: auto;" alt="Map 1">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="https://transjogja.jogjaprov.go.id/" target="_blank">
                            <img src="{{ asset('storage/images/trans-jogja.png') }}" class="img-fluid rounded"
                                style="width: 120%; height: auto;" alt="Map 2">
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="https://jogjaprov.go.id/" target="_blank">
                            <img src="{{ asset('storage/images/diy.png') }}" class="img-fluid rounded"
                                style="width: 30%; height: auto;" alt="Map 3">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </section>


        <!-- Footer -->
        <section class="wave-footer">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" class="wave">
                <path d="M0,64 C360,0 1080,96 1440,32 L1440,120 L0,120 Z" fill="#0d2c6e"></path>
            </svg>
            <footer class="py-4 text-white" style="background-color: #0d2c6e;">
                <div
                    class="container d-flex justify-content-center align-items-center flex-wrap text-center custom-footer-container">
                    <img src="{{ asset('storage/images/ugm.png') }}" alt="Logo" width="30" height="30"
                        class="me-2 mb-0">
                    <p class="mb-0"> {{ date('Y') }} | Developed by Arum Pradana - 23/514595/SV/22387</p>
                </div>
            </footer>
        </section>

        <style>
            .wave-footer {
                position: relative;
                width: 100%;
                overflow: hidden;
                margin: 0;
                padding: 0;

            }

            .wave-footer .wave {
                display: block;
                width: 100%;
                height: 100px;
                line-height: 0;
                margin-bottom: -1px;
            }

            .custom-footer-container {
                max-width: 100%;
                gap: 0px;
                flex-direction: row;
            }
        </style>
    @endsection
