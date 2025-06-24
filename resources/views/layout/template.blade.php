<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Global Styles -->
    <style>
        :root {
            --biru-utama: #1E56A0;
            --biru-muda: #D6E4F0;
            --biru-gelap: #163172;
        }

        html {
            scroll-behavior: smooth;
        }

        .navbar {
            transition: background-color 0.4s ease;
        }

        .navbar.scrolled {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand,
        .nav-link {
            color: var(--biru-utama) !important;
            transition: background-color 0.3s, transform 0.3s;
            border-radius: 8px;
        }

        .nav-link:hover {
            background-color: #f0f4ff;
            transform: scale(1.05);
        }

        .nav-link.active {
            font-weight: bold;
            color: var(--biru-gelap) !important;
        }

        .feature-highlight {
            animation: pulseHighlight 3s ease-in-out;
            box-shadow: 0 0 0 6px rgba(30, 86, 160, 0.2);
            border-radius: 1.5rem;
        }

        @keyframes pulseHighlight {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(30, 86, 160, 0.2);
            }

            25% {
                transform: scale(1.01);
                box-shadow: 0 0 15px 8px rgba(30, 86, 160, 0.2);
            }

            50% {
                transform: scale(1.03);
                box-shadow: 0 0 20px 10px rgba(30, 86, 160, 0.3);
            }

            75% {
                transform: scale(1.01);
                box-shadow: 0 0 10px 5px rgba(30, 86, 160, 0.25);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(30, 86, 160, 0);
            }
        }

        .fitur-icon i {
            color: white !important;
        }

        .fitur-box {
            background-color: var(--biru-utama);
            color: white;
            transition: 0.3s ease;
        }

        .fitur-box:hover {
            background-color: var(--biru-gelap);
        }
    </style>

    @yield('styles')
</head>

<body>
    @include('component.navbar')

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Global Interactive Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Smooth scroll ke ID
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({ behavior: 'smooth' });
                        target.classList.add('feature-highlight');
                        setTimeout(() => target.classList.remove('feature-highlight'), 3000);
                    }
                });
            });

            // Scroll to top on home
            document.querySelectorAll('.scroll-home').forEach(link => {
                link.addEventListener('click', function (e) {
                    if (this.getAttribute('href') === '#top') {
                        e.preventDefault();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });
            });

            // Toggle active nav-link
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function () {
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Navbar shadow on scroll
            window.addEventListener('scroll', function () {
                const navbar = document.querySelector('.navbar');
                navbar.classList.toggle('scrolled', window.scrollY > 10);
            });
        });
    </script>

    @yield('scripts')
    @include('components.toast')
</body>

</html>
