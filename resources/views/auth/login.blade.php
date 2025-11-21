@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #ebf3ff 0%, #f7f9fc 100%);
        overflow-x: hidden;
    }

    /* Floating animated background elements */
    .float-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.18;
        animation: floating 8s infinite ease-in-out;
        filter: blur(40px);
    }

    .shape1 {
        width: 180px;
        height: 180px;
        background: #8bb6ff;
        top: -40px;
        left: -40px;
    }

    .shape2 {
        width: 240px;
        height: 240px;
        background: #6fa8ff;
        bottom: -50px;
        right: -40px;
        animation-duration: 10s;
    }

    @keyframes floating {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(25px) rotate(15deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }

    /* Wrapper */
    .login-wrapper {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Card */
    .login-card {
        width: 100%;
        max-width: 900px;
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        display: flex;
        flex-wrap: wrap;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Left */
    .login-left {
        flex: 1;
        min-width: 300px;
        background: linear-gradient(135deg, #0d6efd 0%, #65a3ff 100%);
        padding: 45px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-align: center;
        animation: fadeLeft 1s ease-out;
    }

    @keyframes fadeLeft {
        from { opacity: 0; transform: translateX(-40px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .login-left h1 {
        font-size: 34px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .login-left p {
        font-size: 15px;
        opacity: 0.92;
        max-width: 300px;
        margin: auto;
    }

    /* Right */
    .login-right {
        flex: 1;
        min-width: 300px;
        padding: 45px 35px;
        animation: fadeRight 1s ease-out;
    }

    @keyframes fadeRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .login-right h2 {
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #2d2d2d;
    }

    .login-right p.lead {
        color: #6c757d;
        margin-bottom: 22px;
    }

    .form-control {
        height: 46px;
        border-radius: 12px;
        border-color: #d4d7dd;
        font-size: 14px;
        padding-left: 14px;
        transition: all .25s ease;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.18rem rgba(13,110,253,0.22);
        transform: scale(1.02);
    }

    .btn-primary {
        height: 46px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13,110,253,0.26);
    }

    .small-link {
        font-size: 0.9rem;
        transition: .2s;
    }
    .small-link:hover {
        color: #0d6efd;
    }

    @media(max-width: 768px) {
        .login-left {
            display: none;
        }
        .login-card {
            max-width: 420px;
        }
    }
</style>

<div class="float-shape shape1"></div>
<div class="float-shape shape2"></div>

<div class="login-wrapper">
    <div class="login-card">

        {{-- Left --}}
        <div class="login-left">
            <div>
                <h1>{{ config('app.name') }}</h1>
                <p>Sistem kasir modern dengan tampilan elegan & animasi halus.</p>
            </div>
        </div>

        {{-- Right: Form --}}
        <div class="login-right">
            <h2>Selamat Datang</h2>
            <p class="lead">Silakan login ke dashboard kasir Anda</p>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label small" for="remember">Ingat saya</label>
                    </div>
                    <a href="#" class="small-link">Lupa password?</a>
                </div>

                <button class="btn btn-primary w-100 mb-3">Masuk</button>

                <div class="text-center small text-muted">
                    Belum punya akun?  
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
