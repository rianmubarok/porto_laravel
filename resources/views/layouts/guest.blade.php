<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@yield('description', 'Welcome to my professional portfolio website')">
        <meta name="keywords" content="@yield('keywords', 'portfolio, web developer, projects')">
        <meta name="author" content="Your Name">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'My Portfolio')</title>
        
        <!-- Preconnect to external resources -->
        <link rel="preconnect" href="https://api.fontshare.com">
        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        
        <!-- Satoshi Font -->
        <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --font-satoshi: 'Satoshi', sans-serif;
            }
            body {
                font-family: var(--font-satoshi);
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                min-height: 100vh;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: var(--font-satoshi);
                font-weight: 700;
            }
            .lead {
                font-family: var(--font-satoshi);
                font-weight: 500;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="text-center mb-4">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <h2 class="fw-bold text-primary">My Portfolio</h2>
                            </a>
                        </div>
                        
                        <div class="card shadow-lg border-0 rounded-3">
                            <div class="card-body p-5">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery (required for some Bootstrap features) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
        @yield('scripts')
    </body>
</html>
