@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: #fafbfc; padding-bottom: 100px;">
    <div class="container mx-auto px-3 py-4" style="max-width: 480px;">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-5">
            <a href="{{ route('home') }}" class="btn btn-light rounded-circle p-2 border-0" style="box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="text-center">
                <h1 class="h5 fw-bold text-dark mb-0">Profile</h1>
                <p class="small text-muted mb-0">Your wellness journey</p>
            </div>
            <div style="width: 42px;"></div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                    <span class="text-white h4 fw-bold mb-0">
                        {{ $isAnonymous ? 'A' : substr($userName, 0, 1) }}
                    </span>
                </div>
                <div>
                    <h2 class="h5 fw-bold text-dark mb-1">{{ $userName }}</h2>
                    <p class="text-muted small mb-0">{{ $memberSince }}</p>
                </div>
            </div>
            
            @if($isAnonymous)
            <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border: 1px solid #3b82f6;">
                <p class="small mb-3 text-dark">Create an account to save your progress and access more features.</p>
                <a href="{{ route('signup') }}" class="btn rounded-3 px-4 py-2" style="background: #2563eb; color: white; font-size: 14px;">
                    Create Account
                </a>
            </div>
            @endif
        </div>

        <!-- Stats -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Your Journey</h3>
            <div class="row text-center">
                <div class="col-4">
                    <div class="rounded-3 p-3 mb-2" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);">
                        <div class="h3 fw-bold mb-1" style="color: #0ea5e9;">{{ $daysActive }}</div>
                        <div class="small text-muted">Days Active</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="rounded-3 p-3 mb-2" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);">
                        <div class="h3 fw-bold mb-1" style="color: #d97706;">{{ $journalCount }}</div>
                        <div class="small text-muted">Journal Entries</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="rounded-3 p-3 mb-2" style="background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 100%);">
                        <div class="h3 fw-bold mb-1" style="color: #9333ea;">{{ $affirmationCount }}</div>
                        <div class="small text-muted">Saved Insights</div>
                    </div>
                </div>
            </div>
            <div class="row text-center mt-2">
                <div class="col-6">
                    <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);">
                        <div class="h3 fw-bold mb-1" style="color: #16a34a;">{{ $moodCount }}</div>
                        <div class="small text-muted">Mood Check-ins</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="rounded-3 p-3" style="background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);">
                        <div class="h3 fw-bold mb-1" style="color: #ec4899;">{{ $chatCount }}</div>
                        <div class="small text-muted">Chat Messages</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Settings</h3>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: #f8fafc;">
                    <div>
                        <div class="fw-semibold text-dark">Daily Reminders</div>
                        <small class="text-muted">Get gentle reminders to check in</small>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="dailyReminders" {{ $settings->daily_reminders ? 'checked' : '' }} onchange="updateSetting('daily_reminders', this.checked)">
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: #f8fafc;">
                    <div>
                        <div class="fw-semibold text-dark">Crisis Alerts</div>
                        <small class="text-muted">Emergency support notifications</small>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="crisisAlerts" {{ $settings->crisis_alerts ? 'checked' : '' }} onchange="updateSetting('crisis_alerts', this.checked)">
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: #f8fafc;">
                    <div>
                        <div class="fw-semibold text-dark">Anonymous Mode</div>
                        <small class="text-muted">Browse without saving data</small>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="anonymousMode" {{ $settings->anonymous_mode ? 'checked' : '' }} onchange="updateSetting('anonymous_mode', this.checked)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="bg-white rounded-4 mb-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <h3 class="h6 fw-bold text-dark mb-4">Support & Resources</h3>
            <div class="d-flex flex-column gap-2">
                <a href="#" class="btn btn-outline-secondary rounded-3 p-3 d-flex align-items-center justify-content-between text-start">
                    <div>
                        <div class="fw-semibold">Help Center</div>
                        <small class="text-muted">Get answers to common questions</small>
                    </div>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="#" class="btn btn-outline-secondary rounded-3 p-3 d-flex align-items-center justify-content-between text-start">
                    <div>
                        <div class="fw-semibold">Privacy Policy</div>
                        <small class="text-muted">How we protect your data</small>
                    </div>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="#" class="btn btn-outline-secondary rounded-3 p-3 d-flex align-items-center justify-content-between text-start">
                    <div>
                        <div class="fw-semibold">Terms of Service</div>
                        <small class="text-muted">Platform usage guidelines</small>
                    </div>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                
                <a href="#" class="btn btn-outline-secondary rounded-3 p-3 d-flex align-items-center justify-content-between text-start">
                    <div>
                        <div class="fw-semibold">Contact Support</div>
                        <small class="text-muted">Reach out for help</small>
                    </div>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Logout -->
        <div class="bg-white rounded-4 p-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <button onclick="confirmLogout()" class="btn btn-outline-danger rounded-3 w-100 p-3">
                <div class="fw-semibold">{{ $isAnonymous ? 'Reset Session' : 'Sign Out' }}</div>
                <small class="text-muted d-block">{{ $isAnonymous ? 'Clear all session data' : 'Your data will be saved' }}</small>
            </button>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'profile'])
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logout-modal" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-body p-4">
                <h3 class="h6 fw-bold text-dark mb-3">{{ $isAnonymous ? 'Reset Session' : 'Sign Out' }}</h3>
                <p class="text-muted mb-4">{{ $isAnonymous ? 'Are you sure you want to reset your session? All data will be cleared.' : 'Are you sure you want to sign out? Your data will be saved.' }}</p>
                <div class="d-flex gap-2">
                    <button onclick="logout()" class="btn btn-danger rounded-3 flex-grow-1">
                        {{ $isAnonymous ? 'Reset' : 'Sign Out' }}
                    </button>
                    <button onclick="closeLogoutModal()" class="btn btn-outline-secondary rounded-3">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmLogout() {
    const modal = document.getElementById('logout-modal');
    modal.classList.add('show');
    modal.style.display = 'block';
    modal.removeAttribute('aria-hidden');
    document.body.classList.add('modal-open');
    
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'logout-backdrop';
    document.body.appendChild(backdrop);
}

function closeLogoutModal() {
    const modal = document.getElementById('logout-modal');
    const backdrop = document.getElementById('logout-backdrop');
    
    modal.classList.remove('show');
    modal.style.display = 'none';
    document.body.classList.remove('modal-open');
    
    if (backdrop) backdrop.remove();
}

function updateSetting(setting, value) {
    fetch('/api/settings/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            setting: setting,
            value: value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message || 'Setting updated successfully', 'success');
            
            // Handle anonymous mode toggle
            if (setting === 'anonymous_mode') {
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }
        }
    })
    .catch(error => {
        console.error('Error updating setting:', error);
        showNotification('Error updating setting', 'danger');
    });
}

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

function logout() {
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