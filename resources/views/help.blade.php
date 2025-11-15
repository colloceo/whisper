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
                <h1 class="h5 fw-bold text-dark mb-0">Help Center</h1>
                <p class="small text-muted mb-0">Get answers to common questions</p>
            </div>
            <div style="width: 42px;"></div>
        </div>

        <!-- FAQ Sections -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Getting Started</h3>
            <div class="accordion" id="gettingStarted">
                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            How do I start using Whisper?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#gettingStarted">
                        <div class="accordion-body">
                            You can start using Whisper immediately as a guest, or create an account to save your progress. Simply tap "Get Started" from the welcome screen.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Is my data safe and private?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#gettingStarted">
                        <div class="accordion-body">
                            Yes, your privacy is our priority. All journal entries and personal data are encrypted and stored securely. You can also use anonymous mode for extra privacy.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Features</h3>
            <div class="accordion" id="features">
                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            How does the AI journal work?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#features">
                        <div class="accordion-body">
                            Our AI companion analyzes your journal entries and provides personalized insights and affirmations to help you process your thoughts and emotions.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Can I chat with others anonymously?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#features">
                        <div class="accordion-body">
                            Yes, our peer support chatrooms allow anonymous participation. You can connect with others facing similar challenges in a safe, moderated environment.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Crisis Support</h3>
            <div class="accordion" id="crisis">
                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            What should I do in a mental health emergency?
                        </button>
                    </h2>
                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#crisis">
                        <div class="accordion-body">
                            If you're in immediate danger, call 999. For mental health support, contact Befrienders Kenya at +254 722 178 177. Visit our Crisis page for more resources.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="bg-white rounded-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-3">Still need help?</h3>
            <p class="text-muted mb-3">Can't find what you're looking for? Our support team is here to help.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary rounded-3 w-100">Contact Support</a>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'profile'])
</div>
@endsection