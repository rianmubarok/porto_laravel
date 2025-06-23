@extends('layouts.guest')

@section('title', 'Login - My Portfolio')

@section('content')
    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #6b5ce5; letter-spacing: -1px;">Login</h2>
        <p class="text-muted">Masuk ke akun Anda</p>
    </div>

    @if (session('status'))
        <div class="alert alert-info mb-4">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
            @endif
            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 10px; background: #6b5ce5; border: none; font-weight: 500;">
                <i class="bi bi-box-arrow-in-right me-2"></i>Log in
            </button>
        </div>
    </form>
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
        </a>
    </div>
    <div class="card mt-4 border-0 shadow-sm" style="border-radius: 16px; background: linear-gradient(135deg, #e3f2fd 0%, #ede7f6 100%);">
        <div class="card-body">
            <h6 class="card-title mb-2" style="color: #6b5ce5; font-weight: 600;">
                <i class="bi bi-info-circle me-1"></i>Demo Credentials
            </h6>
            <div class="row">
                <div class="col-6">
                    <small class="text-muted"><strong>Admin:</strong><br>Email: admin@example.com<br>Password: password</small>
                </div>
                <div class="col-6">
                    <small class="text-muted"><strong>User:</strong><br>Email: user@example.com<br>Password: password</small>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn-primary {
            background: #6b5ce5;
            border: none;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: #5746c6;
        }
    </style>
@endsection
