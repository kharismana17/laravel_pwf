@extends('layouts.app')

@section('content')

<style>
    .profile-wrapper {
        max-width: 520px;
        margin: auto;
        margin-top: 25px;
    }

    .profile-card {
        background: #fff;
        border-radius: 14px;
        padding: 32px;
        border: 1px solid #e8e8e8;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    }

    .profile-header {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #2d2d2d;
    }

    label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
        color: #333;
    }

    .form-control {
        height: 46px;
        border-radius: 10px;
        border: 1px solid #cfcfcf;
        font-size: 14px;
        padding-left: 14px;
    }

    .form-control:focus {
        border-color: #4a8bff;
        box-shadow: 0 0 8px rgba(74,139,255,0.25);
    }

    .btn-primary {
        height: 46px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        background: #3979f0;
        border: none;
    }

    .btn-primary:hover {
        background: #2f68d4;
    }

    .alert {
        border-radius: 10px;
    }
</style>

<div class="profile-wrapper">
    <div class="profile-card">

        <div class="profile-header">Edit Profile</div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    class="form-control" 
                    required
                >
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}" 
                    class="form-control" 
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2">
                Simpan Perubahan
            </button>
        </form>

    </div>
</div>

@endsection
