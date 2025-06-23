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
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: var(--font-satoshi);
                font-weight: 700;
            }
            .lead {
                font-family: var(--font-satoshi);
                font-weight: 500;
            }

            /* SweetAlert2 Animations */
            .animated {
                animation-duration: 0.3s;
                animation-fill-mode: both;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translate3d(0, -20px, 0);
                }
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }

            .fadeInDown {
                animation-name: fadeInDown;
            }

            @keyframes fadeOutUp {
                from {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
                to {
                    opacity: 0;
                    transform: translate3d(0, -20px, 0);
                }
            }

            .fadeOutUp {
                animation-name: fadeOutUp;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <!-- Header & Navigation -->
        @include('layouts.partials.header')

        <!-- Flash Messages -->
        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')

        <!-- jQuery (required for some Bootstrap features) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

        <!-- Initialize SweetAlert2 -->
        <script>
            // Set default options for SweetAlert2
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Set default options for all SweetAlert2 popups
            Swal.mixin({
                customClass: {
                    popup: 'animated fadeInDown',
                    title: 'swal2-title-custom',
                    htmlContainer: 'swal2-html-container-custom',
                    confirmButton: 'swal2-confirm-custom',
                    cancelButton: 'swal2-cancel-custom'
                },
                buttonsStyling: false,
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                showClass: {
                    popup: 'animated fadeInDown'
                },
                hideClass: {
                    popup: 'animated fadeOutUp'
                }
            });

            // Global error handler for SweetAlert2
            window.addEventListener('error', function(e) {
                if (e.message.includes('SweetAlert2')) {
                    console.error('SweetAlert2 Error:', e);
                }
            });

            // Verify SweetAlert2 is loaded
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Swal === 'undefined') {
                    console.error('SweetAlert2 failed to load');
                } else {
                    console.log('SweetAlert2 loaded successfully');
                }
            });
        </script>
        
        @yield('scripts')

    </body>
</html>
