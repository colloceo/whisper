@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="padding-bottom: 100px;">
    <div class="container-whisper mx-auto px-3 py-4" style="max-width: 500px;">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('home') }}" class="btn btn-light rounded-circle p-2">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="h5 fw-semibold text-dark mb-0">Profile</h1>
            <div style="width: 40px;"></div>
        </div>

        <!-- Profile Card -->
        <div class="whisper-card p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-whisper-blue" style="width: 64px; height: 64px;">
                    <span class="text-white h4 fw-semibold mb-0">
                        {{ session('is_anonymous', true) ? 'A' : substr(session('username', 'W'), 0, 1) }}
                    </span>
                </div>
                <div>
                    <h2 class="h5 fw-semibold text-dark mb-1">
                        {{ session('is_anonymous', true) ? 'Anonymous User' : session('username', 'Whisperer') }}
                    </h2>
                    <p class="text-muted small mb-0">
                        {{ session('is_anonymous', true) ? 'Browsing privately' : 'Member since ' . date('M Y') }}
                    </p>
                </div>
            </div>
            
            @if(session('is_anonymous', true))
            <div class="alert alert-info rounded-4 mb-0">
                <p class="small mb-3">Create an account to save your progress and access more features.</p>
                <a href="{{ route('signup') }}" class="btn btn-whisper-blue whisper-btn btn-sm">
                    Create Account
                </a>
            </div>
            @endif
        </div>

        <!-- Stats -->
        <div class="whisper-card p-4 mb-4">
            <h3 class="h6 text-dark fw-semibold mb-3">Your Journey</h3>
            <div class="row text-center">
                <div class="col-4">
                    <div class="h3 fw-bold text-whisper-blue mb-1">7</div>
                    <div class="small text-muted">Days Active</div>
                </div>
                <div class="col-4">
                    <div class="h3 fw-bold text-whisper-warm mb-1">12</div>
                    <div class="small text-muted">Journal Entries</div>
                </div>
                <div class="col-4">
                    <div class="h3 fw-bold text-whisper-purple mb-1">5</div>
                    <div class="small text-muted">Affirmations</div>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="whisper-card p-4 mb-4">
            <h3 class="h6 text-dark fw-semibold mb-3">Settings</h3>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-dark">Daily Reminders</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="dailyReminders" checked>
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-dark">Crisis Alerts</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="crisisAlerts" checked>
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-dark">Anonymous Mode</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="anonymousMode" {{ session('is_anonymous', true) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="whisper-card p-4 mb-4">
            <h3 class="h6 text-dark fw-semibold mb-3">Support & Resources</h3>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-4 mb-2">
                    <span>Help Center</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-4 mb-2">
                    <span>Privacy Policy</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-4 mb-2">
                    <span>Terms of Service</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-4">
                    <span>Contact Support</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Logout -->
        <div class="whisper-card p-4">
            <button onclick="confirmLogout()" class="btn btn-outline-danger whisper-btn w-100">
                {{ session('user_email') ? 'Sign Out' : 'Reset Session' }}
            </button>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'profile'])
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logout-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content whisper-card border-0">
            <div class="modal-body p-4">
                <h3 class="h6 fw-semibold text-dark mb-3">Sign Out</h3>
                <p class="text-muted mb-4">Are you sure you want to sign out? Your data will be saved.</p>
                <div class="d-flex gap-2">
                    <button onclick="logout()" class="btn btn-danger whisper-btn flex-grow-1">
                        Sign Out
                    </button>
                    <button onclick="closeLogoutModal()" class="btn btn-outline-secondary whisper-btn">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let logoutModal = null;

function confirmLogout() {
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        if (!logoutModal) {
            logoutModal = new bootstrap.Modal(document.getElementById('logout-modal'));
        }
        logoutModal.show();
    } else {
        // Fallback: direct confirmation without modal
        if (confirm('Are you sure you want to sign out? Your data will be saved.')) {
            logout();
        }
    }
}

function closeLogoutModal() {
    if (logoutModal) {
        logoutModal.hide();
    }
}

function logout() {
    // Create a form and submit it to logout route
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('logout') }}';
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    form.appendChild(csrfToken);
    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection