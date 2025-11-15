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
                <h1 class="h5 fw-bold text-dark mb-0">Privacy Policy</h1>
                <p class="small text-muted mb-0">How we protect your data</p>
            </div>
            <div style="width: 42px;"></div>
        </div>

        <!-- Privacy Content -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Data Collection</h3>
            <p class="text-muted mb-4">We collect only the information necessary to provide our mental health support services:</p>
            <ul class="text-muted mb-4">
                <li>Journal entries and mood data (encrypted)</li>
                <li>Chat messages in support groups</li>
                <li>Usage analytics (anonymized)</li>
                <li>Account information (if you create an account)</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Data Protection</h3>
            <p class="text-muted mb-4">Your privacy and security are our top priorities:</p>
            <ul class="text-muted mb-4">
                <li>All personal data is encrypted at rest and in transit</li>
                <li>We never share your personal information with third parties</li>
                <li>Anonymous mode prevents data storage entirely</li>
                <li>You can delete your data at any time</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">AI Processing</h3>
            <p class="text-muted mb-4">Our AI features are designed with privacy in mind:</p>
            <ul class="text-muted mb-4">
                <li>Journal entries are processed securely through encrypted APIs</li>
                <li>AI providers do not store or train on your personal data</li>
                <li>Generated insights are stored locally in your account</li>
                <li>You control which entries to share with the AI</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Your Rights</h3>
            <p class="text-muted mb-4">You have full control over your data:</p>
            <ul class="text-muted mb-4">
                <li>Access and download your data</li>
                <li>Correct or update your information</li>
                <li>Delete your account and all associated data</li>
                <li>Use anonymous mode for complete privacy</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Contact Us</h3>
            <p class="text-muted mb-3">Questions about our privacy practices? We're here to help.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary rounded-3 w-100">Contact Support</a>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'profile'])
</div>
@endsection