@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: #fafbfc; padding-bottom: 100px;">
    <div class="container mx-auto px-3 py-4" style="max-width: 480px;">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-5">
            <a href="{{ route('profile') }}" class="btn btn-light rounded-circle p-2 border-0" style="box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="text-center">
                <h1 class="h5 fw-bold text-dark mb-0">Terms of Service</h1>
                <p class="small text-muted mb-0">Platform usage guidelines</p>
            </div>
            <div style="width: 42px;"></div>
        </div>

        <!-- Terms Content -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Acceptance of Terms</h3>
            <p class="text-muted mb-4">By using Whisper, you agree to these terms of service. If you don't agree, please don't use our platform.</p>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Platform Purpose</h3>
            <p class="text-muted mb-4">Whisper is a mental health support platform designed to:</p>
            <ul class="text-muted mb-4">
                <li>Provide a safe space for emotional expression</li>
                <li>Connect users with peer support communities</li>
                <li>Offer AI-powered insights and affirmations</li>
                <li>Share crisis support resources</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Community Guidelines</h3>
            <p class="text-muted mb-4">To maintain a safe and supportive environment:</p>
            <ul class="text-muted mb-4">
                <li>Be respectful and kind to all community members</li>
                <li>No harassment, bullying, or discriminatory language</li>
                <li>Respect privacy and confidentiality</li>
                <li>No sharing of personal contact information</li>
                <li>Report inappropriate behavior to moderators</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Medical Disclaimer</h3>
            <div class="alert alert-warning rounded-3 mb-4">
                <strong>Important:</strong> Whisper is not a substitute for professional medical care or therapy.
            </div>
            <ul class="text-muted mb-4">
                <li>Our platform provides peer support, not medical advice</li>
                <li>AI insights are for reflection, not diagnosis</li>
                <li>Always consult healthcare professionals for medical concerns</li>
                <li>In emergencies, contact local emergency services</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">User Responsibilities</h3>
            <p class="text-muted mb-4">As a user, you agree to:</p>
            <ul class="text-muted mb-4">
                <li>Use the platform responsibly and ethically</li>
                <li>Keep your account information secure</li>
                <li>Not misuse or abuse platform features</li>
                <li>Respect intellectual property rights</li>
                <li>Follow all applicable laws and regulations</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Questions?</h3>
            <p class="text-muted mb-3">Need clarification on our terms? Contact our support team.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary rounded-3 w-100">Contact Support</a>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'profile'])
</div>
@endsection