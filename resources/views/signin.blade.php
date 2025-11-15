@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex flex-column align-items-center justify-content-center px-3 py-5">
    <div class="container-whisper" style="max-width: 400px;">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('onboarding') }}" class="btn btn-light rounded-circle p-2">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="h3 fw-semibold text-dark mb-0">Welcome Back</h1>
            <div style="width: 40px;"></div>
        </div>

        <!-- Welcome Message -->
        <div class="text-center mb-4">
            <p class="text-muted">Welcome back to our community</p>
        </div>

        <!-- Sign In Form -->
        <div class="whisper-card p-4 mb-3">
            <form action="{{ route('signin.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-end-0 rounded-start-4">
                            <svg width="20" height="20" fill="currentColor" class="text-muted" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </span>
                        <input 
                            type="email" 
                            name="email"
                            class="form-control border-start-0 rounded-end-4"
                            placeholder="Enter your email"
                            required
                        >
                    </div>
                </div>
                
                <div class="mb-4">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-end-0 rounded-start-4">
                            <svg width="20" height="20" fill="currentColor" class="text-muted" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                        </span>
                        <input 
                            type="password" 
                            name="password"
                            class="form-control border-start-0 rounded-end-4"
                            placeholder="Enter your password"
                            required
                        >
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Remember me</label>
                    </div>
                    <a href="#" class="small text-whisper-blue text-decoration-none fw-medium">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn btn-whisper-blue whisper-btn w-100 py-3 mb-3">
                    <span class="fw-semibold">Sign In</span>
                </button>
            </form>
        </div>

        <!-- Alternative Options -->
        <div class="text-center mb-3">
            <div class="d-flex align-items-center gap-3 mb-3">
                <hr class="flex-grow-1">
                <span class="text-muted small">or</span>
                <hr class="flex-grow-1">
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary whisper-btn w-100 py-2">
                Continue Anonymously
            </a>
        </div>

        <!-- Switch to Sign Up -->
        <div class="text-center">
            <span class="text-muted small">Don't have an account? </span>
            <a href="{{ route('signup') }}" class="text-whisper-blue fw-semibold text-decoration-none">Create Account</a>
        </div>
    </div>
</div>
@endsection