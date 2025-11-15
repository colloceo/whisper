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
                <h1 class="h5 fw-bold text-dark mb-0">Contact Support</h1>
                <p class="small text-muted mb-0">Reach out for help</p>
            </div>
            <div style="width: 42px;"></div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Send us a message</h3>
            <form id="contactForm">
                <div class="mb-3">
                    <label for="subject" class="form-label fw-semibold">Subject</label>
                    <select class="form-select rounded-3" id="subject" required>
                        <option value="">Choose a topic...</option>
                        <option value="technical">Technical Issue</option>
                        <option value="account">Account Help</option>
                        <option value="privacy">Privacy Question</option>
                        <option value="feedback">Feedback</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email (optional)</label>
                    <input type="email" class="form-control rounded-3" id="email" placeholder="your@email.com">
                    <small class="text-muted">Leave blank to remain anonymous</small>
                </div>
                
                <div class="mb-4">
                    <label for="message" class="form-label fw-semibold">Message</label>
                    <textarea class="form-control rounded-3" id="message" rows="5" placeholder="Describe your question or issue..." required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary rounded-3 w-100">Send Message</button>
            </form>
        </div>

        <!-- Quick Help -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Quick Help</h3>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('help') }}" class="btn btn-outline-secondary rounded-3 p-3 d-flex align-items-center justify-content-between text-start">
                    <div>
                        <div class="fw-semibold">FAQ</div>
                        <small class="text-muted">Common questions and answers</small>
                    </div>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="{{ route('crisis') }}" class="btn btn-outline-danger rounded-3 p-3 d-flex align-items-center justify-content-between text-start">
                    <div>
                        <div class="fw-semibold">Crisis Support</div>
                        <small class="text-muted">Emergency resources and contacts</small>
                    </div>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Response Time -->
        <div class="bg-white rounded-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: #dbeafe;">
                    <svg width="24" height="24" fill="none" stroke="#2563eb" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                </div>
                <div>
                    <h3 class="h6 fw-bold text-dark mb-1">Response Time</h3>
                    <p class="text-muted small mb-0">We typically respond within 24-48 hours</p>
                </div>
            </div>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'profile'])
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const subject = document.getElementById('subject').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    
    if (!subject || !message) {
        showNotification('Please fill in all required fields', 'danger');
        return;
    }
    
    // Simulate form submission
    showNotification('Message sent successfully! We\'ll get back to you soon.', 'success');
    
    // Reset form
    this.reset();
});

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg rounded-3`;
    notification.style.zIndex = '9999';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection