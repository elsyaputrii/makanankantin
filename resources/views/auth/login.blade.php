@extends('layouts.guest')

@section('content')
<div class="auth-card">
    <div class="auth-logo">
        <i class="fa-solid fa-utensils"></i> Kantin App
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div style="margin-bottom: 1rem; font-size: 0.9rem; color: #28a745;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            @error('email')
                <div style="color: #dc3545; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
             @error('password')
                <div style="color: #dc3545; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; font-size: 0.9rem;">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember">
                <span style="margin-left: 0.5rem;">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color: var(--primary-color); text-decoration: none;">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Masuk
            </button>
        </div>
    </form>
</div>
@endsection
