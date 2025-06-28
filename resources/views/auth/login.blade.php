@extends('layouts.guest')

@section('title', 'Login - My Portfolio')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background: none;">
    <div class="login-card p-4 p-md-5 w-100" style="max-width: 420px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2 login-title">Login</h2>
            <p class="text-muted mb-0">Masuk ke akun Anda</p>
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
        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group login-input-group">
                    <span class="input-group-text bg-transparent border-0 pe-1"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control login-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group login-input-group">
                    <span class="input-group-text bg-transparent border-0 pe-1"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control login-input @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan password Anda">
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">Ingat saya</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="login-link">Lupa password?</a>
                @endif
            </div>
            <button type="submit" class="btn login-btn w-100 py-2 mb-2">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="login-link">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </div>
        <div class="text-center mt-3">
            <p class="text-muted mb-0">Belum punya akun? 
                <a href="{{ route('register') }}" class="login-link">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
<style>
.login-card {
    border-radius: 28px;
    background: linear-gradient(135deg, #e3f2fd 0%, #ede7f6 100%);
    box-shadow: none;
    margin: 32px auto;
    transition: background 0.2s;
}
.login-card:hover {
    /* efek hover scale dihilangkan */
}
.login-title {
    color: #6b5ce5;
    letter-spacing: -1px;
    font-size: 2.1rem;
}
.login-input-group {
    border-radius: 14px;
    background: #f8f9fa;
    border: 1.5px solid #e0e0e0;
    transition: border-color 0.2s;
}
.login-input:focus {
    border-color: #6b5ce5;
    box-shadow: none;
    background: #f3f6fd;
}
.login-input {
    border-radius: 14px;
    background: transparent;
    border: none;
    font-size: 1rem;
    padding-left: 0;
}
.input-group-text {
    color: #6b5ce5;
    font-size: 1.1rem;
}
.login-btn {
    background: linear-gradient(90deg, #6b5ce5 60%, #5746c6 100%);
    border: none;
    border-radius: 14px;
    font-weight: 600;
    font-size: 1.1rem;
    color: #fff;
    transition: background 0.2s;
    box-shadow: none;
}
.login-btn:hover, .login-btn:focus {
    background: linear-gradient(90deg, #5746c6 60%, #6b5ce5 100%);
    color: #fff;
}
.login-link {
    color: #6b5ce5;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}
.login-link:hover, .login-link:focus {
    color: #5746c6;
    text-decoration: underline;
}
@media (max-width: 576px) {
    .login-card {
        padding: 1.5rem 0.5rem;
    }
}
</style>
@endsection
