@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%); padding-bottom: 100px;">
    <div class="container mx-auto px-3 py-4" style="max-width: 480px;">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="h4 fw-bold text-dark mb-1">Profile</h1>
            <p class="text-muted mb-0">Your wellness journey</p>
        </div>

        <!-- Profile Card -->
        <div class="rounded-4 mb-4 p-4 position-relative overflow-hidden" style="background: rgba(240, 249, 255, 0.8); box-shadow: 0 8px 32px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);">
            <div class="position-absolute top-0 end-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(125, 211, 252, 0.1) 0%, rgba(186, 230, 253, 0.1) 100%); z-index: 0;"></div>
            <div class="position-relative" style="z-index: 1;">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);">
                        <span class="text-white" style="font-size: 32px; font-weight: 600;">
                            {{ $isAnonymous ? 'A' : substr($userName, 0, 1) }}
                        </span>
                    </div>
                    <h2 class="h5 fw-bold text-dark mb-1">{{ $userName }}</h2>
                    <p class="text-muted small mb-0">{{ $memberSince }}</p>
                </div>
                
                @if($isAnonymous)
                <div class="text-center p-4 rounded-3" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(147, 197, 253, 0.1) 100%); border: 1px solid rgba(59, 130, 246, 0.2);">
                    <p class="mb-3 text-dark">Create an account to save your progress and access more features.</p>
                    <a href="{{ route('signup') }}" class="btn btn-primary rounded-pill px-4 py-2">
                        Create Account
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="row g-3 mb-4">
            <div class="col-6">
                <div class="rounded-3 p-3 text-center h-100" style="background: rgba(240, 249, 255, 0.6); box-shadow: 0 4px 16px rgba(14, 165, 233, 0.06); border: 1px solid rgba(186, 230, 253, 0.2);">
                    <div class="h2 fw-bold mb-1" style="color: #0ea5e9;">{{ $daysActive }}</div>
                    <div class="small text-muted">Days Active</div>
                </div>
            </div>
            <div class="col-6">
                <div class="rounded-3 p-3 text-center h-100" style="background: rgba(240, 249, 255, 0.6); box-shadow: 0 4px 16px rgba(14, 165, 233, 0.06); border: 1px solid rgba(186, 230, 253, 0.2);">
                    <div class="h2 fw-bold mb-1" style="color: #0284c7;">{{ $journalCount }}</div>
                    <div class="small text-muted">Journal Entries</div>
                </div>
            </div>
            <div class="col-6">
                <div class="rounded-3 p-3 text-center h-100" style="background: rgba(240, 249, 255, 0.6); box-shadow: 0 4px 16px rgba(14, 165, 233, 0.06); border: 1px solid rgba(186, 230, 253, 0.2);">
                    <div class="h2 fw-bold mb-1" style="color: #0369a1;">{{ $affirmationCount }}</div>
                    <div class="small text-muted">Saved Insights</div>
                </div>
            </div>
            <div class="col-6">
                <div class="rounded-3 p-3 text-center h-100" style="background: rgba(240, 249, 255, 0.6); box-shadow: 0 4px 16px rgba(14, 165, 233, 0.06); border: 1px solid rgba(186, 230, 253, 0.2);">
                    <div class="h2 fw-bold mb-1" style="color: #0c4a6e;">{{ $moodCount }}</div>
                    <div class="small text-muted">Mood Check-ins</div>
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="rounded-4 mb-4 p-4" style="background: rgba(240, 249, 255, 0.8); box-shadow: 0 8px 32px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);">
            <h3 class="h6 fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 15.5A3.5 3.5 0 0 1 8.5 12A3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5 3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97c0-.33-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.39-1.06-.73-1.69-.98l-.37-2.65A.506.506 0 0 0 14 2h-4c-.25 0-.46.18-.5.42l-.37 2.65c-.63.25-1.17.59-1.69.98l-2.49-1c-.22-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1c0 .33.03.65.07.97l-2.11 1.66c-.19.15-.25.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.06.74 1.69.99l.37 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.37-2.65c.63-.26 1.17-.59 1.69-.99l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.66Z"/>
                </svg>
                Settings
            </h3>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: #dbeafe;">
                            <svg width="16" height="16" fill="#3b82f6" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="fw-semibold text-dark">Daily Reminders</div>
                            <small class="text-muted">Get gentle reminders to check in</small>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="dailyReminders" {{ $settings->daily_reminders ? 'checked' : '' }} onchange="updateSetting('daily_reminders', this.checked)">
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: #fecaca;">
                            <svg width="16" height="16" fill="#dc2626" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="fw-semibold text-dark">Crisis Alerts</div>
                            <small class="text-muted">Emergency support notifications</small>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="crisisAlerts" {{ $settings->crisis_alerts ? 'checked' : '' }} onchange="updateSetting('crisis_alerts', this.checked)">
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 36px; height: 36px; background: #e5e7eb;">
                            <svg width="16" height="16" fill="#6b7280" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="fw-semibold text-dark">Anonymous Mode</div>
                            <small class="text-muted">Browse without saving data</small>
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="anonymousMode" {{ $settings->anonymous_mode ? 'checked' : '' }} onchange="updateSetting('anonymous_mode', this.checked)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Support & Resources -->
        <div class="rounded-4 mb-4 p-4" style="background: rgba(240, 249, 255, 0.8); box-shadow: 0 8px 32px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);">
            <h3 class="h6 fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Support & Resources
            </h3>
            <div class="row g-2">
                <div class="col-6">
                    <a href="{{ route('help') }}" class="btn btn-light rounded-3 p-3 w-100 h-100 d-flex flex-column align-items-center text-center" style="border: 1px solid #e2e8f0;">
                        <svg width="24" height="24" fill="#6366f1" viewBox="0 0 24 24" class="mb-2">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                        </svg>
                        <div class="fw-semibold small">Help Center</div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('privacy') }}" class="btn btn-light rounded-3 p-3 w-100 h-100 d-flex flex-column align-items-center text-center" style="border: 1px solid #e2e8f0;">
                        <svg width="24" height="24" fill="#10b981" viewBox="0 0 24 24" class="mb-2">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                        </svg>
                        <div class="fw-semibold small">Privacy Policy</div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('terms') }}" class="btn btn-light rounded-3 p-3 w-100 h-100 d-flex flex-column align-items-center text-center" style="border: 1px solid #e2e8f0;">
                        <svg width="24" height="24" fill="#f59e0b" viewBox="0 0 24 24" class="mb-2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
                        </svg>
                        <div class="fw-semibold small">Terms of Service</div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ route('contact') }}" class="btn btn-light rounded-3 p-3 w-100 h-100 d-flex flex-column align-items-center text-center" style="border: 1px solid #e2e8f0;">
                        <svg width="24" height="24" fill="#8b5cf6" viewBox="0 0 24 24" class="mb-2">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <div class="fw-semibold small">Contact Support</div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sign Out -->
        <div class="text-center">
            <button onclick="confirmLogout()" class="btn btn-outline-danger rounded-pill px-4 py-2">
                {{ $isAnonymous ? 'Reset Session' : 'Sign Out' }}
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