<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MovieFlix</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- External Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="min-vh-100 d-flex flex-column">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white border-bottom py-4">
                <div class="container">
                    <div class="text-dark fs-4 fw-bold">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-grow-1 py-5">
            <div class="container">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-top py-4 mt-auto">
            <div class="container text-center">
                <p class="mb-0 text-muted small">&copy; {{ date('Y') }} MovieFlix. Crafted with Laravel & Bootstrap.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/rating.js') }}"></script>
    <script src="{{ asset('js/filter.js') }}"></script>
</body>
</html>