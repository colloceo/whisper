@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex flex-column align-items-center justify-content-center px-3 py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);">
    <div class="container-whispr" style="max-width: 400px;">
        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-center mb-4">
            <svg class="me-2" width="40" height="40" fill="#0ea5e9" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <span class="fs-1 fw-semibold text-dark">Whispr</span>
        </div>

        <!-- Tagline -->
        <p class="text-center text-muted mb-5">Speak freely. Heal together.</p>

        <!-- Onboarding Cards -->
        <div id="onboarding-cards">
            <!-- Card 1: Journal -->
            <div class="onboarding-card whispr-card p-4 mb-4" style="min-height: 320px; background: rgba(240, 249, 255, 0.8); box-shadow: 0 8px 32px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);" data-card="0">
                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                    <div class="mb-4" style="color: #0ea5e9;">
                        <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                    </div>
                    <h2 class="h4 text-dark mb-3">Journal your emotions safely</h2>
                    <p class="text-muted">Express yourself freely in a private, judgment-free space where your thoughts are heard and valued.</p>
                </div>
            </div>

            <!-- Card 2: AI Support -->
            <div class="onboarding-card whispr-card p-4 mb-4 d-none" style="min-height: 320px; background: rgba(240, 249, 255, 0.8); box-shadow: 0 8px 32px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);" data-card="1">
                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                    <div class="mb-4" style="color: #0ea5e9;">
                        <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h2 class="h4 text-dark mb-3">AI-powered insights</h2>
                    <p class="text-muted">Transform your thoughts into positive affirmations with our caring AI companion that understands your journey.</p>
                </div>
            </div>

            <!-- Card 3: Community -->
            <div class="onboarding-card whispr-card p-4 mb-4 d-none" style="min-height: 320px; background: rgba(240, 249, 255, 0.8); box-shadow: 0 8px 32px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);" data-card="2">
                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                    <div class="mb-4" style="color: #0ea5e9;">
                        <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12,3C6.5,3 2,6.58 2,11A7.18,7.18 0 0,0 2.64,14.25L1,22L8.75,20.36C9.81,20.75 10.87,21 12,21C17.5,21 22,17.42 22,13C22,8.58 17.5,5 12,5M12,3Z"/>
                        </svg>
                    </div>
                    <h2 class="h4 text-dark mb-3">Connect with others</h2>
                    <p class="text-muted">Join supportive communities where you can share experiences and find understanding in a safe, anonymous environment.</p>
                </div>
            </div>

            <!-- Card 4: Donation -->
            <div class="onboarding-card whispr-card p-4 mb-4 d-none" style="min-height: 320px; background: rgba(240, 249, 255, 0.8); box-shadow: 0 8px 32px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);" data-card="3">
                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                    <div class="mb-4" style="color: #0ea5e9;">
                        <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                        </svg>
                    </div>
                    <h2 class="h4 text-dark mb-3">Support our mission</h2>
                    <p class="text-muted">Help us keep Whispr free and accessible. Your donation supports our servers, AI services, and continued development.</p>
                    <button class="btn btn-whispr-blue whispr-btn mt-3" data-bs-toggle="modal" data-bs-target="#donationModal">
                        Donate
                    </button>
                </div>
            </div>
        </div>

        <!-- Progress Dots -->
        <div class="d-flex justify-content-center gap-2 mb-4">
            <div class="progress-dot active" data-dot="0"></div>
            <div class="progress-dot" data-dot="1"></div>
            <div class="progress-dot" data-dot="2"></div>
            <div class="progress-dot" data-dot="3"></div>
        </div>

        <!-- Navigation Buttons -->
        <div id="onboarding-nav">
            <button id="next-btn" class="btn btn-whispr-blue whispr-btn w-100 mb-3" onclick="nextCard()">
                Next
            </button>
            <button id="start-btn" class="btn btn-whispr-blue whispr-btn w-100 mb-3 d-none" onclick="startApp()">
                Get Started
            </button>
        </div>

        <!-- Secondary Actions -->
        <div class="d-flex gap-2 mb-3">
            <a href="{{ route('signin') }}" class="btn btn-outline-primary whispr-btn flex-grow-1">
                Sign In
            </a>
            <a href="{{ route('signup') }}" class="btn btn-outline-primary whispr-btn flex-grow-1">
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

<!-- Donation Modal -->
<div class="modal fade" id="donationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: rgba(240, 249, 255, 0.95); backdrop-filter: blur(12px); border: 1px solid rgba(186, 230, 253, 0.3);">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark fw-bold">Support Whispr</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4" style="color: #0ea5e9;">
                    <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <p class="text-muted mb-4">Your donation helps us keep Whispr free and accessible for everyone who needs mental health support.</p>
                
                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                        <svg width="24" height="24" fill="#00A651" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                        <span class="fw-semibold text-dark">M-Pesa Payment</span>
                    </div>
                    <input type="tel" class="form-control mb-3" placeholder="Enter M-Pesa number (254...)" id="mpesaNumber" maxlength="12">
                </div>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-whispr-blue whispr-btn" onclick="initiateMpesa(100)">Donate KSh 100</button>
                    <button class="btn btn-whispr-blue whispr-btn" onclick="initiateMpesa(500)">Donate KSh 500</button>
                    <button class="btn btn-whispr-blue whispr-btn" onclick="initiateMpesa(1000)">Donate KSh 1,000</button>
                    <button class="btn btn-outline-primary whispr-btn" onclick="showCustomAmount()">Custom Amount</button>
                </div>
                
                <div id="customAmountDiv" class="d-none mt-3">
                    <input type="number" class="form-control mb-2" placeholder="Enter amount (KSh)" id="customAmount" min="10">
                    <button class="btn btn-whispr-blue whispr-btn w-100" onclick="initiateCustomMpesa()">Donate Custom Amount</button>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary whispr-btn" data-bs-dismiss="modal">Maybe Later</button>
            </div>
        </div>
    </div>
</div>

<!-- STK Push Modal -->
<div class="modal fade" id="stkPushModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: rgba(240, 249, 255, 0.95); backdrop-filter: blur(12px); border: 1px solid rgba(186, 230, 253, 0.3);">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark fw-bold">Complete Payment</h5>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4" style="color: #00A651;">
                    <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                </div>
                <h6 class="fw-bold mb-3">Check your phone</h6>
                <p class="text-muted mb-3">We've sent a payment request to <strong id="stkPhone"></strong></p>
                <p class="text-muted mb-4">Enter your M-Pesa PIN to complete the donation of <strong id="stkAmount"></strong></p>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="small text-muted mt-3">Waiting for payment confirmation...</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: rgba(240, 249, 255, 0.95); backdrop-filter: blur(12px); border: 1px solid rgba(186, 230, 253, 0.3);">
            <div class="modal-header border-0">
                <h5 class="modal-title text-dark fw-bold">Thank You!</h5>
                <button type="button" class="btn-close" onclick="closeSuccessModal()"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4" style="color: #10b981;">
                    <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <h6 class="fw-bold mb-3">Payment Successful!</h6>
                <p class="text-muted mb-3">Your donation of <strong id="successAmount"></strong> has been received.</p>
                <p class="text-muted mb-4">Thank you for supporting mental health resources. You'll receive an appreciation email shortly.</p>
                <button onclick="closeSuccessModal()" class="btn btn-whispr-blue whispr-btn">Continue</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentCard = 0;
const totalCards = 4;

function nextCard() {
    if (currentCard < totalCards - 1) {
        // Hide current card
        document.querySelector(`[data-card="${currentCard}"]`).classList.add('d-none');
        document.querySelector(`[data-dot="${currentCard}"]`).classList.remove('active');
        
        // Show next card
        currentCard++;
        document.querySelector(`[data-card="${currentCard}"]`).classList.remove('d-none');
        document.querySelector(`[data-dot="${currentCard}"]`).classList.add('active');
        
        // Update button on last card (card 3, which is index 3)
        if (currentCard === 3) {
            document.getElementById('next-btn').classList.add('d-none');
            document.getElementById('start-btn').classList.remove('d-none');
        }
    }
}

function startApp() {
    window.location.href = '{{ route('home') }}';
}

function initiateMpesa(amount) {
    const phoneNumber = document.getElementById('mpesaNumber').value;
    if (!phoneNumber || phoneNumber.length < 12) {
        alert('Please enter a valid M-Pesa number (254XXXXXXXXX)');
        return;
    }
    
    // Show loading state
    const btn = event.target;
    btn.disabled = true;
    btn.innerHTML = 'Processing...';
    
    // Call M-Pesa STK Push API
    fetch('/api/mpesa/donate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            phone: phoneNumber,
            amount: amount
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showStkPushModal(data.transaction_id, amount, phoneNumber);
        } else {
            alert('Payment failed: ' + data.message);
        }
        btn.disabled = false;
        btn.innerHTML = `Donate KSh ${amount.toLocaleString()}`;
    })
    .catch(error => {
        alert('Payment failed. Please try again.');
        btn.disabled = false;
        btn.innerHTML = `Donate KSh ${amount.toLocaleString()}`;
    });
}

function showCustomAmount() {
    document.getElementById('customAmountDiv').classList.remove('d-none');
}

function initiateCustomMpesa() {
    const amount = parseInt(document.getElementById('customAmount').value);
    if (!amount || amount < 10) {
        alert('Please enter a valid amount (minimum KSh 10)');
        return;
    }
    initiateMpesa(amount);
}

function showStkPushModal(transactionId, amount, phone) {
    document.getElementById('donationModal').style.display = 'none';
    document.getElementById('stkPushModal').style.display = 'block';
    document.getElementById('stkAmount').textContent = `KSh ${amount.toLocaleString()}`;
    document.getElementById('stkPhone').textContent = phone;
    
    // Start checking payment status
    checkPaymentStatus(transactionId, amount, phone);
}

function checkPaymentStatus(transactionId, amount, phone) {
    const checkInterval = setInterval(() => {
        fetch(`/api/mpesa/status/${transactionId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'completed') {
                clearInterval(checkInterval);
                showSuccessModal(amount, phone);
            } else if (data.status === 'failed') {
                clearInterval(checkInterval);
                showFailureModal();
            }
        })
        .catch(error => {
            console.error('Error checking payment status:', error);
        });
    }, 3000); // Check every 3 seconds
    
    // Stop checking after 2 minutes
    setTimeout(() => {
        clearInterval(checkInterval);
    }, 120000);
}

function showSuccessModal(amount, phone) {
    document.getElementById('stkPushModal').style.display = 'none';
    document.getElementById('successModal').style.display = 'block';
    document.getElementById('successAmount').textContent = `KSh ${amount.toLocaleString()}`;
}

function showFailureModal() {
    document.getElementById('stkPushModal').style.display = 'none';
    alert('Payment was cancelled or failed. Please try again.');
}

function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
    document.querySelector('.modal-backdrop').remove();
    document.body.classList.remove('modal-open');
}
</script>

@endsection