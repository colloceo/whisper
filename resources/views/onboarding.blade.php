@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex flex-column align-items-center justify-content-center px-3 py-5">
    <div class="container-whisper" style="max-width: 400px;">
        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-center mb-4">
            <svg class="me-2 text-whisper-blue" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <span class="fs-1 fw-semibold text-dark">Whisper</span>
        </div>

        <!-- Tagline -->
        <p class="text-center text-muted mb-5">Speak freely. Heal together.</p>

        <!-- Onboarding Card -->
        <div class="whisper-card p-4 mb-4" style="min-height: 320px;">
            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                <div class="text-whisper-blue mb-4">
                    <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h2 class="h4 text-dark mb-3">Journal your emotions safely</h2>
                <p class="text-muted">Express yourself freely in a private, judgment-free space where your thoughts are heard and valued.</p>
            </div>
        </div>

        <!-- Progress Dots -->
        <div class="d-flex justify-content-center gap-2 mb-4">
            <div class="progress-dot active"></div>
            <div class="progress-dot"></div>
            <div class="progress-dot"></div>
        </div>

        <!-- Primary Action -->
        <a href="{{ route('home') }}" class="btn btn-whisper-blue whisper-btn w-100 mb-3">
            Get Started
        </a>

        <!-- Secondary Actions -->
        <div class="d-flex gap-2 mb-3">
            <a href="{{ route('signin') }}" class="btn btn-outline-primary whisper-btn flex-grow-1">
                Sign In
            </a>
            <a href="{{ route('signup') }}" class="btn btn-outline-primary whisper-btn flex-grow-1">
                Sign Up
            </a>
        </div>

        <!-- Tertiary Action -->
        <div class="text-center">
            <small class="text-muted">or</small>
        </div>
        <div class="text-center mt-2">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                Continue as guest
            </a>
        </div>
    </div>

</div>


@endsection